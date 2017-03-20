<?php

namespace Hatimeria\Reagento\Api;

interface ProductRepositoryInterface extends \Magento\Catalog\Api\ProductRepositoryInterface
{
    /**
     * Get product list
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @param bool $includeSubcategories
     * @param mixed $withAttributeFilters
     * @return \Hatimeria\Reagento\Api\Data\ProductSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria, $includeSubcategories = false, $withAttributeFilters = []);
}
