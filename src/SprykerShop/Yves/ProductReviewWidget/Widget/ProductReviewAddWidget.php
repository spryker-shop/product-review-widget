<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ProductReviewWidget\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;
use Symfony\Component\Form\FormInterface;

/**
 * @method \SprykerShop\Yves\ProductReviewWidget\ProductReviewWidgetFactory getFactory()
 */
class ProductReviewAddWidget extends AbstractWidget
{
    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ProductReviewWidget/views/review-widget-add/review-widget-add.twig';
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'ProductReviewAddWidget';
    }

    /**
     * @param int $idProductAbstract
     */
    public function __construct(int $idProductAbstract)
    {
        $form = $this->getProductReviewForm($idProductAbstract);

        $this->addParameter('form', $form->createView());
        $this->addParameter('hideForm', !$form->isSubmitted());
        $this->addParameter('idProductAbstract', $idProductAbstract);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function getProductReviewForm(int $idProductAbstract): FormInterface
    {
        $request = $this->getApplication()['request'];

        return $this->getFactory()
            ->createProductReviewForm($idProductAbstract)
            ->handleRequest($request);
    }
}
