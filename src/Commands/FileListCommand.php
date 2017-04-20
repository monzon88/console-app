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
use Symfony\Component\Finder\Finder;
use InvalidArgumentException;

/**
 * Class Ls
 */
class FileListCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName("ls");
        $this->setDescription('List all the files in a given directory.');
        $this->setDefinition([
            new InputArgument('dir', InputArgument::REQUIRED, 'The directory to search for files in.'),
            new InputOption('ext', 'e', InputOption::VALUE_OPTIONAL , 'An optional file extension to filter by.'),
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
        $dir = $input->getArgument('dir');

        if (!file_exists($dir) || ! is_dir($dir)) {
            throw new InvalidArgumentException('The directory must exist.');
        }

        $ext = strtolower($input->getOption('ext'));

        if (!empty($ext)) {
            $ext = '*.' . str_replace(['*', '.'], '', $ext);
        }

        $finder = new Finder();
        $finder->in($dir);
        $finder->sortByName();

        if ($ext) {
            $finder->files()->name($ext);
        }

        $depthSep   = '   ';
        $subDepth   = 0;
        $startDepth = (substr_count($dir, DIRECTORY_SEPARATOR) - 1);

        $output->writeln('<info>' . $dir . ': </info>');

        foreach ($finder as $file) {
            if ($file->isDir()) {
                $subDepth = (substr_count($file->getPathname(), DIRECTORY_SEPARATOR) - $startDepth);
                $output->writeln('<info>' . str_repeat($depthSep, $subDepth) . ' ' . trim($file->getFilename()) . '</info>');
            } else {
                $output->writeln(str_repeat($depthSep, $subDepth + 1) . trim($file->getFilename()));
            }
        }
    }
}
