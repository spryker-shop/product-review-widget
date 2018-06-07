<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ProductReviewWidget\Plugin\ProductWidget;

use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\ProductWidget\Dependency\Plugin\ProductReviewWidget\ProductReviewWidgetPluginInterface;

/**
 * @method \SprykerShop\Yves\ProductReviewWidget\ProductReviewWidgetFactory getFactory()
 */
class ProductReviewWidgetPlugin extends AbstractWidgetPlugin implements ProductReviewWidgetPluginInterface
{
    /**
     * @param float $rating
     *
     * @return void
     */
    public function initialize(float $rating): void
    {
        $this
            ->addParameter('rating', $rating)
            ->addParameter('maximumRating', $this->getMaximumRating());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ProductReviewWidget/views/product-review-display/product-review-display.twig';
    }

    /**
     * @return int
     */
    protected function getMaximumRating()
    {
        return $this->getFactory()
            ->getProductReviewClient()
            ->getMaximumRating();
    }
}
