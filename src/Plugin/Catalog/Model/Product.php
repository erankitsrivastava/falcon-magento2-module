<?php

namespace Hatimeria\Reagento\Plugin\Catalog\Model;

use Hatimeria\Reagento\Helper\Product as HatimeriaProductHelper;
use Hatimeria\Reagento\Model\Config\Source\BreadcrumbsAttribute;
use Magento\Catalog\Model\Product as MagentoProduct;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * @package Hatimeria\Reagento\Model\Plugin
 */
class Product
{
    /** @var HatimeriaProductHelper */
    protected $productHelper;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /**
     * @param HatimeriaProductHelper $productHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(HatimeriaProductHelper $productHelper, ScopeConfigInterface $scopeConfig)
    {
        $this->productHelper = $productHelper;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Add resized image information to the product's extension attributes.
     *
     * @param MagentoProduct $product
     * @return MagentoProduct
     */
    public function afterLoad(MagentoProduct $product)
    {
        $this->productHelper->ensurePriceForConfigurableProduct($product);
        $this->productHelper->ensureOptionsForConfigurableProduct($product);

        $this->productHelper->addProductImageAttribute($product);
        $this->productHelper->addProductImageAttribute($product, 'product_list_image', 'thumbnail_url');
        $this->productHelper->addMediaGallerySizes($product);
        $this->productHelper->addBreadcrumbsData($product, $this->getFilterableAttributes());

        $this->productHelper->calculateCatalogDisplayPrice($product);

        return $product;
    }

    /**
     * @return array
     */
    protected function getFilterableAttributes()
    {
        $attributes = [];
            
        if ($config = $this->scopeConfig->getValue(BreadcrumbsAttribute::BREADCRUMBS_ATTRIBUTES_CONFIG_PATH)) {
            $attributes = explode(',', $config);
        }

        return $attributes;
    }
}
