<?php

namespace AppBundle\Services;


class Service
{


    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser=$parser;
    }

    public function convert()
    {
//        $client = new Client();
//        $resEth = $client->request('GET', 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=UAH');
//        $Eth = json_decode($resEth->getBody());
//        $resBit = $client->request('GET', 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=UAH');
//        $Bit = json_decode($resBit->getBody());
//        $b_prise = $Bit[0]->price_uah;
//        $e_prise = $Eth[0]->price_uah;
//        $resBit = $client->request('GET', 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange');
//        $NBU = simplexml_load_string($resBit->getBody());
        $Eth=$this->parser->parse('GET', 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=UAH',"JSON");
        $Bit=$this->parser->parse('GET', 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=UAH',"JSON");
        $NBU=$this->parser->parse('GET', 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange',"XML");
        $b_prise = $Bit[0]->price_uah;
        $e_prise = $Eth[0]->price_uah;
        $usd_prise = null;
        $rub_prise = null;
        $uah_prise=1;
        foreach ($NBU->currency as $currency) {
            switch ($currency->cc) {
                case "USD": {
                    $usd_prise = $currency->rate;
                    break;
                }
                case "RUB": {
                    $rub_prise = $currency->rate;
                    break;
                }
            }
        }

        $cur=[$b_prise ,$e_prise,$uah_prise,$rub_prise,$usd_prise];
        $result=[];
        for($i=0;$i<count($cur);$i++) {
            $middle = [];
            for ($j = 0; $j < count($cur); $j++) {
                $middle[]=(double)$cur[$j]/(double)$cur[$i];
            }
            array_push($result,$middle);
        }
        return $result;
    }


    public function get()
    {

        return array(1, 3, 4);

    }

}