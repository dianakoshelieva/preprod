<?php
/**
 * Created by PhpStorm.
 * User: Diana_Koshelieva
 * Date: 9/29/2017
 * Time: 5:11 PM
 */

namespace AppBundle\Services;

use GuzzleHttp\Client;

class Parser
{
    public function parse($method, $url, $type)
    {

        $client = new Client();
        $res = $client->request($method, $url);
        if ($type == "JSON")
            $res = json_decode($res->getBody());
        if ($type == "XML")
            $res = simplexml_load_string($res->getBody());
        return $res;
    }

}