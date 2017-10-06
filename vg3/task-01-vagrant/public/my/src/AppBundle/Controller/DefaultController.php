<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Service;
use Twig_Loader_Filesystem;
use Twig_Environment;

class DefaultController extends Controller
{
private $convertor;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $t=new Service();
$res=$t->convert();

        return new Response(
            '<html><body><table  cellspacing="15"><tr><th></th><th>BIT</th><th>ETH</th></th><th>UAH</th><th>RUB</th><th>USD</th></tr>
<tr><th>BIT</th><td>'.$res[0][0].' </td><td> '.$res[0][1].'</td><td> '.$res[0][2].'</td><td>' .$res[0][3].'</td><td>' .$res[0][4].'</td></tr>
<tr><th>ETH</th><td>'.$res[1][0].' </td><td> '.$res[1][1].'</td><td> '.$res[1][2].'</td><td>' .$res[1][3].'</td><td>' .$res[1][4].'</td></tr>
<tr><th>UAH</th><td>'.$res[2][0].' </td><td> '.$res[2][1].'</td><td> '.$res[2][2].'</td><td>' .$res[2][3].'</td><td>' .$res[2][4].'</td></tr>
<tr><th>RUB</th><td>'.$res[3][0].' </td><td> '.$res[3][1].'</td><td> '.$res[3][2].'</td><td>' .$res[3][3].'</td><td>' .$res[3][4].'</td></tr>
<tr><th>USD</th><td>'.$res[4][0].' </td><td> '.$res[4][1].'</td><td> '.$res[4][2].'</td><td>' .$res[4][3].'</td><td>' .$res[4][4].'</td></tr>
</table></body></html>'
        );
    }


}
