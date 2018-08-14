<?php

namespace Dev\DemoBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Rest controller for product
 *
 * @RouteResource("product")
 * @NamePrefix("dev_demo_api_")
 */
class ProductController extends RestController
{
    /**
     * Performs delete action
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id): Response
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getManager(): ApiEntityManager
    {
        $this->get('dev_demo.api.product_manager');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
    }
}
