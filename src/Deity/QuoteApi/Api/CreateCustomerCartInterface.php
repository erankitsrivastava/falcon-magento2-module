<?php
declare(strict_types=1);

namespace Deity\QuoteApi\Api;

/**
 * Interface GetCartForCustomerInterface
 *
 * @package Deity\QuoteApi\Api
 */
interface CreateCustomerCartInterface
{

    /**
     * Get cart for customer
     *
     * @param int $customerId
     * @param string $maskedQuoteId
     * @return int
     */
    public function execute($customerId, string $maskedQuoteId = null): int;
}
