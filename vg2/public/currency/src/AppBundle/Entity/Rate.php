<?php
/**
 * Created by PhpStorm.
 * User: Diana_Koshelieva
 * Date: 10/4/2017
 * Time: 10:56 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Rate
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="rate")
 */
class Rate
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="id_from", referencedColumnName="id")
     */

    protected $id_from;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="id_to", referencedColumnName="id")
     */

    protected $id_to;

    /**
     * @ORM\Column(type="integer")
     */

    protected $rate;

    /**
     * @ORM\Column(type="integer")
     */

    protected $date;

}