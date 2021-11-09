<?php

namespace ScaliaGroup\RemoveParentCategory\Plugin\Category;

use Magento\Catalog\Model\Category;

class RemoveParentCategoryPathPlugin {

    public function aroundGetUrlPath($subject, $proceed, $category)
    {
        if (in_array($category->getParentId(), [Category::ROOT_CATEGORY_ID, Category::TREE_ROOT_ID])) {
            return '';
        }
        $path = $category->getUrlPath();
        if ($path !== null && !$category->dataHasChangedFor('url_key') && !$category->dataHasChangedFor('parent_id')) {
            return $path;
        }
        $path = $category->getUrlKey();
        if ($path === false) {
            return $category->getUrlPath();
        }
        return $path;
    }
}
