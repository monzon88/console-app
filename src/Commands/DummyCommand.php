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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class DummyCommand
 */
class DummyCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName("dummy");
        $this->setDescription("This command prints 'Hello World!'");
        $this->setDefinition([
            new InputOption('flag', 'f', InputOption::VALUE_NONE, 'Raise a flag'),
            new InputArgument('activities', InputArgument::IS_ARRAY, 'Space-separated activities to perform', null),
        ]);

        $this->setHelp("The <info>hello</info> command just prints 'Hello World!'");
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello World!");
    }
}
