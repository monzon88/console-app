<?php
/**
 * @project   console
 * @link      https://git.setl.ru/console
 * @author    Monzon Traore <monzon@traore.ru>
 * @copyright Copyright 2017 Monzon Traore
 */

namespace monzon\cliapp\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FunCommand
 */
class FunCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName("fun");
        $this->setDescription("The <info>fun</info> command.");
        $this->setDefinition([]);

        $this->setHelp("The <info>fun</info> command.");
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->setFormatter(new OutputFormatter(true));

        $rows        = 1000;
        $progressBar = new ProgressBar($output, $rows);

        $progressBar->setBarCharacter('<fg=magenta>></>');
        $progressBar->setBarWidth(100);
        $progressBar->setProgressCharacter("*");
        $progressBar->setFormat('%current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        for ($i = 0; $i < $rows; $i++) {
            usleep(3000);
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');
    }
}
