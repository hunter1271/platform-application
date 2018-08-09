<?php

namespace Dev\DemoBundle\Migrations\Data\ORM;

use Dev\DemoBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Simple products seed
 */
class LoadProducts implements FixtureInterface
{
    /**
     * Load products seed into storage
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setName('First product');
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Second product');
        $manager->persist($product2);

        $manager->flush();
    }
}
