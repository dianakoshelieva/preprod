<?php

namespace AppBundle\Controller;

use GuzzleHttp\Psr7\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Services\Service;
use AppBundle\Services\Repository;



class DefaultController extends Controller
{
    private $convertor;


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Service $s)
    {
        $res = $s->convert();
        return $this->render('default/index.html.twig', array('items' => $res, 'val' => ['BIT', 'ETH', 'UAH', 'RUB', 'USD']));

    }

    /**
     * @Route("/rates/{id}/", defaults={"id" = 1})
     */
    public function indexActionq(Repository $r, $id)
    {
        $pieces = explode("-", $id);

        if (count($pieces)==2) {

            $res=$r->addItem($pieces);

            return $this->render('index/table.html.twig', array('items' => "ok",'res'=>$res));
        } else {

            return $this->render('index/table.html.twig', array('items' => "ne ok"));
        }


    }
}
