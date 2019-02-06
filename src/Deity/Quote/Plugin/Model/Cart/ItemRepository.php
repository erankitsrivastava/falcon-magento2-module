<?php
declare(strict_types=1);

namespace Deity\Quote\Plugin\Model\Cart;

use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Catalog\Model\ResourceModel\Product\Website\Link;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartItemRepositoryInterface;
use Magento\Quote\Api\Data\CartItemInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ItemRepository
 *
 * @package Deity\Quote\Plugin\Model\Cart
 */
class ItemRepository
{
    /** @var StoreManagerInterface */
    protected $storeManager;

    /** @var ProductResource */
    protected $productResource;

    /** @var Link */
    protected $productWebsiteLink;

    /**
     * ItemRepository constructor.
     * @param StoreManagerInterface $storeManager
     * @param ProductResource $productResource
     * @param Link $productWebsiteLink
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ProductResource $productResource,
        Link $productWebsiteLink
    ) {
        $this->storeManager = $storeManager;
        $this->productResource = $productResource;
        $this->productWebsiteLink = $productWebsiteLink;
    }

    /**
     * Check if requested product is available in current store
     *
     * @param CartItemRepositoryInterface $subject
     * @param CartItemInterface $cartItem
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws NoSuchEntityException
     */
    public function beforeSave(CartItemRepositoryInterface $subject, CartItemInterface $cartItem)
    {
        $cartItem->getSku();
        $productId = $this->productResource->getIdBySku($cartItem->getSku());
        $productWebsites = $this->productWebsiteLink->getWebsiteIdsByProductId($productId);
        if (!in_array($this->storeManager->getStore()->getWebsiteId(), $productWebsites)) {
            throw new NoSuchEntityException(__('Product that you are trying to add is not available.'));
        }

        return [$cartItem];
    }
}
