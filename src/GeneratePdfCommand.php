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
        $this->setName('generate-pdf');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . '../report.csv';

        $progressBar = new ProgressBar($output, 50);
        $progressBar->start();
        try {
            $reporter = new Reporter();
            $fileName = $reporter->createReport($fileName, $progressBar);
            printf("Find your report in: " . __DIR__ . DIRECTORY_SEPARATOR . '../' . $fileName . "\n");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $progressBar->finish();
    }
}