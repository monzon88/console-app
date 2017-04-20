<?php
/**
 * @project   console
 * @link      https://git.setl.ru/console
 * @author    Monzon Traore <monzon@traore.ru>
 * @copyright Copyright 2017 Monzon Traore
 */

namespace monzon\cliapp\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class FibonacciCommand
 */
class FibonacciCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $start = 0;
        $stop = 100;

        $this->setName("fibo");
        $this->setDescription("Display the fibonacci numbers between 2 given numbers");
        $this->setDefinition([
            new InputOption('start', 's', InputOption::VALUE_OPTIONAL, 'Start number of the range of Fibonacci number', $start),
            new InputOption('stop', 'e', InputOption::VALUE_OPTIONAL, 'stop number of the range of Fibonacci number', $stop)
        ]);
        $this->setHelp(<<<EOT
Display the fibonacci numbers between a range of numbers given as parameters

Usage:

<info>php console.php phpmaster:fibonacci 2 18 <env></info>

You can also specify just a number and by default the start number will be 0
<info>php console.php phpmaster:fibonacci 18 <env></info>

If you don't specify a start and a stop number it will set by default [0,100]
<info>php console.php phpmaster:fibonacci<env></info>
EOT
            );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $headerStyle = new OutputFormatterStyle('black', 'yellow', ['bold']);
        $output->getFormatter()->setStyle('header', $headerStyle);

        $start = intval($input->getOption('start'));
        $stop  = intval($input->getOption('stop'));

        if (($start >= $stop) || ($start < 0)) {
            throw new \InvalidArgumentException('Stop number should be greater than start number');
        }

        $output->writeln('<header>Fibonacci numbers between '.$start.' - '.$stop.'</header>');
        $output->writeln('');

        $xnM2        = 0; // set x(n-2)
        $xnM1        = 1;  // set x(n-1)
        $totalFiboNr = 0;

        while ($xnM2 <= $stop) {
            if ($xnM2 >= $start)  {
                $output->write('<header>'.$xnM2.'</header> ');
                $totalFiboNr++;
            }

            $xn   = $xnM1 + $xnM2;
            $xnM2 = $xnM1;
            $xnM1 = $xn;
        }

        $output->writeln('');
        $output->writeln('');

        $output->writeln('<header>Total of Fibonacci numbers found = '.$totalFiboNr.' </header>');
    }
}
