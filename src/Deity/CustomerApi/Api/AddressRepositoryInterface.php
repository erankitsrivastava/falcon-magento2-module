<?php
declare(strict_types=1);

namespace Deity\CustomerApi\Api;

use Magento\Customer\Api\Data\AddressInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface AddressRepositoryInterface
 * @package Deity\CustomerApi\Api
 */
interface AddressRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Magento\Customer\Api\Data\AddressSearchResultsInterface
     */
    public function getCustomerAddressList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * @param int $addressId
     * @return \Magento\Customer\Api\Data\AddressInterface
     */
    public function getCustomerAddress($addressId);

    /**
     * @param \Magento\Customer\Api\Data\AddressInterface $address
     * @return \Magento\Customer\Api\Data\AddressInterface
     */
    public function createCustomerAddress(AddressInterface $address);

    /**
     * @param \Magento\Customer\Api\Data\AddressInterface $address
     * @return \Magento\Customer\Api\Data\AddressInterface
     */
    public function updateCustomerAddress(AddressInterface $address);

    /**
     * @param int $addressId
     * @return bool
     */
    public function deleteCustomerAddress($addressId);
}
