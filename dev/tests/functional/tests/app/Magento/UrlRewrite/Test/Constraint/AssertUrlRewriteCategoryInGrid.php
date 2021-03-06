<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\UrlRewrite\Test\Constraint;

use Magento\Catalog\Test\Fixture\Category;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\UrlRewrite\Test\Page\Adminhtml\UrlRewriteIndex;

/**
 * Class AssertUrlRewriteCategoryInGrid
 * Assert that url category in grid
 */
class AssertUrlRewriteCategoryInGrid extends AbstractConstraint
{
    /**
     * Assert that url rewrite category in grid.
     *
     * @param Category $category
     * @param UrlRewriteIndex $urlRewriteIndex
     * @param string $filterByPath
     * @return void
     */
    public function processAssert(
        Category $category,
        UrlRewriteIndex $urlRewriteIndex,
        $filterByPath = 'target_path'
    ) {
        $urlRewriteIndex->open();
        $filter = [$filterByPath => strtolower($category->getUrlKey())];
        \PHPUnit_Framework_Assert::assertTrue(
            $urlRewriteIndex->getUrlRedirectGrid()->isRowVisible($filter, true, false),
            'URL Rewrite with request path "' . $category->getUrlKey() . '" is absent in grid.'
        );
    }

    /**
     * URL rewrite category present in grid.
     *
     * @return string
     */
    public function toString()
    {
        return 'URL Rewrite is present in grid.';
    }
}
