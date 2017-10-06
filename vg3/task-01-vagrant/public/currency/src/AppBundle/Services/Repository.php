<?php
/**
 * Created by PhpStorm.
 * User: Diana_Koshelieva
 * Date: 10/4/2017
 * Time: 1:55 PM
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Rate;


class Repository
{

    public function __construct(EntityManager $entityManager, Service $s)
    {
        $this->em = $entityManager;
        $this->s = $s;
        $this->cur=['uah','rub','usd','btc','eth','eur'];
    }

    public function addItem($id)
    {
        if(!in_array($id[0], $this->cur)||!in_array($id[1], $this->cur))
            return false;
        $this->addCurrency($id[0]);
        $from = $this->em->getRepository(Currency::class)->findOneBy(array('name' => $id[0]));
        $this->addCurrency($id[1]);
        $to = $this->em->getRepository(Currency::class)->findOneBy(array('name' => $id[1]));
        $rate = new Rate();
        $rate->setIdFrom($from->getID());
        $rate->setIdTo($to->getID());
        $res=$this->s->fromTo($id[0],$id[1]);
        $rate->setDate(time());
        $rate->setRate($res);
        $this->em->persist($rate);
        $this->em->flush();

        return $this->em->getRepository(Rate::class)->findBy(array('id_from'=>$from->getID(),'id_to'=>$to->getID()));
    }


    public function addCurrency($goal)
    {
        $result = $this->em->getRepository(Currency::class)->findBy(array('name' => $goal));
        if (count($result) == 0) {
            $cur = new Currency();
            $cur->setName($goal);
            $this->em->persist($cur);
            $this->em->flush();
        }

    }

}