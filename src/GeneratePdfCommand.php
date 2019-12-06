<?php


namespace Reporter;


use Reporter\Report\Reporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratePdfCommand extends Command
{
    protected function configure()
    {
        $this->setName('generate:pdf');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'report.csv';

        if ( !file_exists($fileName) ) {
            $output->writeln('<error>please insert file report.csv in folder ' . dirname(__DIR__, 1) . '</error>');
            exit();
        }

        $progressBar = new ProgressBar($output, 50);
        $progressBar->start();
        try {
            $reporter = new Reporter();
            $fileName = $reporter->createReport($fileName, $progressBar);
            $progressBar->finish();

            $output->writeln('');
            $output->writeln('<info>Find your report in: ' . __DIR__ . DIRECTORY_SEPARATOR . '../' . $fileName . '</info>');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $output->writeln('');
    }
}