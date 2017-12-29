<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerShop\Yves\ProductReviewWidget;

use Spryker\Yves\Kernel\Container;
use Spryker\Yves\ProductReview\ProductReviewDependencyProvider as SprykerProductReviewDependencyProvider;
use SprykerShop\Yves\ProductReviewWidget\Dependency\Client\ProductReviewWidgetToCustomerClientBridge;
use SprykerShop\Yves\ProductReviewWidget\Dependency\Client\ProductReviewWidgetToProductReviewClientBridge;
use SprykerShop\Yves\ProductReviewWidget\Dependency\Client\ProductReviewWidgetToProductReviewStorageClientBridge;

class ProductReviewWidgetDependencyProvider extends SprykerProductReviewDependencyProvider
{
    const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';
    const CLIENT_PRODUCT = 'CLIENT_PRODUCT';
    const CLIENT_PRODUCT_REVIEW = 'CLIENT_PRODUCT_REVIEW';
    const CLIENT_PRODUCT_REVIEW_STORAGE = 'CLIENT_PRODUCT_REVIEW_STORAGE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCustomerClient($container);
        $container = $this->addProductReviewClient($container);
        $container = $this->addProductReviewStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerClient(Container $container)
    {
        $container[static::CLIENT_CUSTOMER] = function (Container $container) {
            return new ProductReviewWidgetToCustomerClientBridge($container->getLocator()->customer()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductReviewClient(Container $container)
    {
        $container[static::CLIENT_PRODUCT_REVIEW] = function (Container $container) {
            return new ProductReviewWidgetToProductReviewClientBridge($container->getLocator()->productReview()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductReviewStorageClient(Container $container)
    {
        $container[static::CLIENT_PRODUCT_REVIEW_STORAGE] = function (Container $container) {
            return new ProductReviewWidgetToProductReviewStorageClientBridge($container->getLocator()->productReviewStorage()->client());
        };

        return $container;
    }
}
