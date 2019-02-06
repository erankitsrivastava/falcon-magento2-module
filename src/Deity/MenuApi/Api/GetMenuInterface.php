<?php
declare(strict_types=1);

namespace Deity\MenuApi\Api;

use Deity\MenuApi\Api\Data\MenuInterface;
use Magento\Catalog\Model\Category;

/**
 * Interface GetMenuInterface
 *
 * @package Deity\MenuApi\Api
 * @api
 */
interface GetMenuInterface
{
    /**
     * Get menu
     *
     * @return \Deity\MenuApi\Api\Data\MenuInterface[]
     */
    public function execute(): array;

    /**
     * Convert Category Item to menu
     *
     * @param Category $category
     * @return MenuInterface
     */
    public function convertCategoryToMenuItem(Category $category): MenuInterface;
}
