<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\ContainerBuilder;


/**
 * Class Currency
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Rate", mappedBy="id_from")
     * @ORM\OneToMany(targetEntity="Rate", mappedBy="id_to")
     */
    protected $id = null;

    /**
     * @ORM\Column(type="string")
     */

    protected $name;

    private $container;

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}