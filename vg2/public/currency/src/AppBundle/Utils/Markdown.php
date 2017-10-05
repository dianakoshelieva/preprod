<?php
/**
 * Created by PhpStorm.
 * User: Diana_Koshelieva
 * Date: 9/28/2017
 * Time: 3:54 PM
 */

namespace AppBundle\Utils;

class Markdown
{
    private $parser;

    public function __construct()
    {
        $this->parser = new \Parsedown();
    }

    public function toHtml($text)
    {
        $html = $this->parser->text($text);

        return $html;
    }
}