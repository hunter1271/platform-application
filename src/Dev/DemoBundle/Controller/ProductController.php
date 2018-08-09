<?php

namespace Dev\DemoBundle\Controller;

use Dev\DemoBundle\Entity\Product;
use Dev\DemoBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller
 */
class ProductController extends Controller
{
    /**
     * Renders list of products
     *
     * @return array
     *
     * @Route("/products", name="demo_product_list")
     * @Template
     */
    public function indexAction(): array
    {
        return [];
    }

    /**
     * Creates new product
     *
     * @return array
     *
     * @Route("/products/create", name="demo_product_create")
     * @Template("DevDemoBundle:Product:update.html.twig")
     */
    public function createAction(Request $request): array
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        return [
            'entity' => $product,
            'form' => $form->createView(),
        ];
    }

    public function updateAction(Product $product, Request $request): array
    {
    }
}
