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


class Repository
{

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addItem($id)
    {

        $result = $this->isInDB($id[0], 'name',Currency::class);
        if (!$result) {
            $cur = new Currency();
            $cur->setName($id[0]);
            $cur2 = new Currency();
            $cur2->setName($id[1]);
            $this->em->persist($cur);
            $this->em->persist($cur2);
            $this->em->flush();
        }
        return $result;
    }



    private function isInDB($goal,$column, $db)
    {
        $result = $this->em->getRepository($db)->findBy(array($column => $goal));
        if (count($result)!==0) {
            return true;
        }
        return false;
    }

}