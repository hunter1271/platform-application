<?php

namespace Dev\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

/**
 * Product entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="dev_demo_products")
 */
class Product
{
    /**
     * Identifier
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * Name of product
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
