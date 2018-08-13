<?php

namespace Dev\DemoBundle\Controller;

use Dev\DemoBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Dev\DemoBundle\Form\Type\ProductType;
use Oro\Bundle\FormBundle\Form\Handler\RequestHandlerTrait;
use Oro\Bundle\UIBundle\Route\Router;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Product controller
 *
 * @Route(service="Dev\DemoBundle\Controller\ProductController")
 */
class ProductController extends Controller
{
    use RequestHandlerTrait;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var Router
     */
    private $uiRouter;

    /**
     * Constructor
     *
     * @param ObjectManager $objectManager
     * @param Router        $uiRouter
     */
    public function __construct(ObjectManager $objectManager, Router $uiRouter)
    {
        $this->objectManager = $objectManager;
        $this->uiRouter      = $uiRouter;
    }

    /**
     * Renders list of products
     *
     * @return array
     *
     * @Route("/products", name="demo_product_index")
     * @Template
     */
    public function indexAction(): array
    {
        return [];
    }

    /**
     * Creates new product
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Route("/products/create", name="demo_product_create")
     * @Template("DevDemoBundle:Product:update.html.twig")
     */
    public function createAction(Request $request)
    {
        return $this->update(new Product(), $request);
    }

    /**
     * Updates product
     *
     * @param Product $product
     * @param Request $request
     *
     * @return array
     *
     * @Route("/products/update/{id}", name="demo_product_update", requirements={"id"="\d+"})
     * @Template
     */
    public function updateAction(Product $product, Request $request): array
    {
        return $this->update($product, $request);
    }

    /**
     * Processes product form
     *
     * @param Product $product
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    protected function update(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);

        if (in_array($request->getMethod(), ['POST', 'PUT'], true)) {
            $this->submitPostPutRequest($form, $request);
            if ($form->isValid()) {
                $this->objectManager->persist($product);
                $this->objectManager->flush();

                return $this->uiRouter->redirect($product);
            }
        }

        return [
            'entity' => $product,
            'form'   => $form->createView(),
        ];
    }
}
