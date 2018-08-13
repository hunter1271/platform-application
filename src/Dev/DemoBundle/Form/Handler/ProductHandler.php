<?php

namespace Dev\DemoBundle\Form\Handler;

use Dev\DemoBundle\Form\Type\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Dev\DemoBundle\Entity\Product;
use Oro\Bundle\FormBundle\Form\Handler\RequestHandlerTrait;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Product form handler
 */
class ProductHandler
{
    use RequestHandlerTrait;

    /**
     * Request stack
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     * Object manager
     *
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Form factory
     *
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * Form type name
     *
     * @var string
     */
    private $formType;

    /**
     * Constructor
     *
     * @param RequestStack         $requestStack
     * @param ObjectManager        $objectManager
     * @param FormFactoryInterface $formFactory
     * @param string               $formType
     */
    public function __construct(
        RequestStack $requestStack,
        ObjectManager $objectManager,
        FormFactoryInterface $formFactory,
        $formType = ProductType::class
    ) {
        $this->requestStack = $requestStack;
        $this->objectManager = $objectManager;
        $this->formFactory = $formFactory;
        $this->formType = $formType;
    }


    /**
     * Processes product
     *
     * @param Product $product
     *
     * @return bool
     */
    public function process(Product $product)
    {
        $request = $this->requestStack->getCurrentRequest();

        if (in_array($request->getMethod(), ['POST', 'PUT'], true)) {
            $form = $this->formFactory->create($this->formType, $product);
            $this->submitPostPutRequest($form, $request);
            if ($form->isValid()) {
                $this->onSuccess($product);

                return true;
            }
        }

        return false;
    }

    /**
     * Saves product to storage
     *
     * @param Product $product
     */
    protected function onSuccess(Product $product)
    {
        $this->objectManager->persist($product);
        $this->objectManager->flush();
    }
}