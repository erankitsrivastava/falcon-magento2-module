<?php
namespace Hatimeria\Reagento\Model\Catalog;

use Hatimeria\Reagento\Api\Catalog\AttributeManagementInterface;
use Hatimeria\Reagento\Api\Data\FilterInterface;
use Hatimeria\Reagento\Api\Data\FilterInterfaceFactory;
use Hatimeria\Reagento\Api\Data\FilterOptionInterface;
use Hatimeria\Reagento\Api\Data\FilterOptionInterfaceFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Eav\Api\Data\AttributeInterface;
use Magento\Eav\Api\Data\AttributeOptionInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class AttributeManagement implements AttributeManagementInterface
{
    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var FilterInterfaceFactory */
    private $filterFactory;

    /** @var FilterOptionInterfaceFactory */
    private $filterOptionFactory;

    /**
     * AttributeManagement constructor.
     * @param AttributeRepositoryInterface $attributeRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterInterfaceFactory $filterFactory
     * @param FilterOptionInterfaceFactory $filterOptionFactory
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterInterfaceFactory $filterFactory,
        FilterOptionInterfaceFactory $filterOptionFactory
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterFactory = $filterFactory;
        $this->filterOptionFactory = $filterOptionFactory;
    }

    public function getCategoryFilters()
    {
        $search = $this->searchCriteriaBuilder->addFilter('is_filterable', 0, 'neq');
        $attributes = $this->attributeRepository->getList(Product::ENTITY, $search->create());

        $result = [];
        foreach($attributes->getItems() as $item) { /** @var AttributeInterface $item */
            $filter = $this->filterFactory->create();
            $options = $item->usesSource() ? $item->getSource()->getAllOptions(false) : null;
            if (empty($options)) {
                continue;
            }
            $filter->setLabel($item->getDefaultFrontendLabel())
                ->setType($item->getBackendType())
                ->setAttributeId($item->getAttributeId())
                ->setCode($item->getAttributeCode())
                ->setOptions($this->prepareFilterOptions($options))
            ;
            $result[] = $filter;
        }

        return $result;
    }

    /**
     * @param array $options
     * @return FilterOptionInterface[]
     */
    protected function prepareFilterOptions($options)
    {
        $filterOptions = [];
        foreach($options as $option) { /** @var AttributeOptionInterface $option */
            /** @var FilterInterface $filterOption */
            $filterOption = $this->filterOptionFactory->create();
            $filterOption->setLabel($option['label'])
                ->setValue($option['value']);
            $filterOptions[] = $filterOption;
        }

        return $filterOptions;
    }
}