<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Services\Service;
use Symfony\Component\Console\Helper\Table;

class GreetCommand extends ContainerAwareCommand
{
    private $convertor;

    public function __construct(Service $convertor)
    {
        parent::__construct();
        $this->convertor = $convertor;
    }

    protected function configure()
    {
        $this
            ->setName('demo:getCurrency')
            ->setDescription('get currency')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to convert?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $currencyTable = $this->convertor->convert();
        $name = $input->getArgument('name');
        $val = array('BIT', 'ETH', 'UAH', 'RUB', 'USD');
        $pieces = explode("-", $name);

        if (count($pieces)==2&&in_array($pieces[0], $val)&&in_array($pieces[1], $val)) {
            $x=array_search($pieces[0], $val);
            $y=array_search($pieces[1], $val);
            $output->write($currencyTable[$x][$y]."\n");

        } else {

            foreach ($val as $key => $value) {
                array_unshift($currencyTable[$key], $val[$key]);
            }
            $table = new Table($output);
            $table
                ->setHeaders(array_merge([''], $val))
                ->setRows($currencyTable);
            $table->render();
        }


    }
}