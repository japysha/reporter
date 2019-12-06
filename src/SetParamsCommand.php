<?php


namespace Reporter;

use Reporter\Helper\ColorHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Question\Question;

class SetParamsCommand extends Command
{
    protected function configure()
    {
        $this->setName('setup:colors');
        $this->setDescription('Use this command to set colors for PDF report');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $filepath = __DIR__ . DIRECTORY_SEPARATOR . '../config.ini';
        $configData = parse_ini_file($filepath, true);
        $colors = $configData['colors'];

        foreach ($colors as $key => $color) {
            $question = new Question('Please enter the '. $key .' (default is ' . $color . '): ', $color);
            $question->setValidator(function ($answer) {
                if (!preg_match(ColorHelper::$rgxHexColor, $answer)) {
                    throw new \RuntimeException(
                        'Please insert the right format or use default'
                    );
                }
                return $answer;
            });

            $color = $helper->ask($input, $output, $question);
            $configData['colors'][$key] = $color;
        }

        $content = $this->configToString($configData);
        $success = $this->saveToFile($filepath, $content);

        if ($success) {
            $output->writeln('');
            return;
        }

        $output->writeln('<error>Something went wrong with updating file, please try again.</error>');
    }

    /**
     * @param array $configData
     * @return string
     */
    protected function configToString(array $configData): string
    {
        $content = "";
        foreach ($configData as $section => $values) {
            foreach ($values as $key => $value) {
                if (intval($key)) {
                    $content .= $section . "[] = '" . $value . "'" . PHP_EOL;
                } else {
                    $content .= $section . "[" . $key . "] = '" . $value . "'" . PHP_EOL;
                }
            }
        }
        return $content;
    }

    /**
     * @param $filepath
     * @param $content
     * @return bool
     */
    protected function saveToFile($filepath, $content): bool
    {
        if (!$handle = fopen($filepath, 'w')) {
            return false;
        }
        $success = fwrite($handle, $content);
        fclose($handle);

        return $success;
    }
}