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
    private $id = null;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="id_from", referencedColumnName="id")
     */

    private $id_from;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="id_to", referencedColumnName="id")
     */

    private $id_to;

    /**
     * @ORM\Column(type="float")
     */

    private $rate;

    /**
     * @ORM\Column(type="integer")
     */

    private $date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdFrom()
    {
        return $this->id_from;
    }

    /**
     * @param mixed $id_from
     */
    public function setIdFrom($id_from)
    {
        $this->id_from = $id_from;
    }

    /**
     * @return mixed
     */
    public function getIdTo()
    {
        return $this->id_to;
    }

    /**
     * @param mixed $id_to
     */
    public function setIdTo($id_to)
    {
        $this->id_to = $id_to;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}