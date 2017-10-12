<?php

namespace Hatimeria\Reagento\Api;

interface HatimeriaGuestOrderManagementInterface
{
    /**
     * @param mixed $orderId
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function getItem($orderId);
}