<?php

namespace AppBundle\Services;

use GuzzleHttp\Client;


class Service
{

    private $parser;

    public function __construct(Parser $p)
    {
        $this->parser = $p;
    }

    public function fromTo($from, $to)
    {

        $url1 = 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=' . $from;
        $url2 = 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=' . $to;
        $pr1 = "price_" . $from;
        $pr2 = "price_" . $to;
        $crypto1 = $this->parser->parse('GET', $url1, "JSON");
        $crypto2 = $this->parser->parse('GET', $url2, "JSON");

        $rate = $crypto1[0]->{$pr1} / $crypto2[0]->{$pr2};

        return $rate;

        //   $NBU = $this->parser->parse('GET', 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange', "XML");

    }

    public function convert()
    {
        $Eth = $this->parser->parse('GET', 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=UAH', "JSON");
        $Bit = $this->parser->parse('GET', 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=UAH', "JSON");
        $NBU = $this->parser->parse('GET', 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange', "XML");
        $b_prise = $Bit[0]->price_uah;
        $e_prise = $Eth[0]->price_uah;
        $usd_prise = null;
        $rub_prise = null;
        $uah_prise = 1;
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

        $cur = [$b_prise, $e_prise, $uah_prise, $rub_prise, $usd_prise];
        $result = [];
        for ($i = 0; $i < count($cur); $i++) {
            $middle = [];
            for ($j = 0; $j < count($cur); $j++) {
                $middle[] = (double)$cur[$j] / (double)$cur[$i];
            }
            array_push($result, $middle);
        }
        return $result;
    }


}