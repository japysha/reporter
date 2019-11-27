<?php

namespace Reporter\Parser;

use DateTime;
use Reporter\Entity\JiraReport;
use Reporter\Entity\ReportEntity;

/**
 * Class CsvParser
 */
class CsvParser implements Parser
{
    /**
     * @param $fileName
     * @return mixed
     */
    public function openFile($fileName)
    {
        return fopen($fileName, 'r');
    }

    /**
     * @param $file
     * @return mixed
     */
    public function parseFile($file)
    {
        $monthReport = [];
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            if (0 === count($data) || !$data[0]) {
                continue;
            }

            if ($this->excludeThisLine($data[0])) {
                continue;
            }

            if (!$this->createDateFromString($data[3])) {
                var_dump($data);exit();
            }

            $timeReport = $this->getReportEntity($data);

            if ($this->isAbsence($timeReport)) {
                $timeReport->setHours(0);
                $timeReport->setWorkDescription('absence');
            }
            if (!array_key_exists($timeReport->getWorkDate(), $monthReport)) {
                $monthReport[$timeReport->getWorkDate()] = json_decode($timeReport->getJSONEncode(), true);
            } else {
                $monthReport[$timeReport->getWorkDate()]['hours'] += $timeReport->getHours();
                $monthReport[$timeReport->getWorkDate()]['workDescription'] .= ';' . $timeReport->getWorkDescription();
            }
        }
        return $monthReport;
    }

    /**
     * @param $file
     */
    public function closeFile($file): void
    {
        fclose($file);
    }

    /**
     * @param $string
     * @return DateTime|false
     */
    private function createDateFromString($string)
    {
        return DateTime::createFromFormat('Y-m-d H:i', $string);
    }

    /**
     * @param ReportEntity $timeReport
     * @return bool
     */
    private function isAbsence(ReportEntity $timeReport)
    {
        $configData = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '../../config.ini');
        $excludedTasks = $configData['excluded_tasks'];

        foreach ($excludedTasks as $task) {
            if (strpos(strtolower($timeReport->getIssueSummary()), strtolower($task)) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array|null $data
     * @return ReportEntity
     */
    protected function getReportEntity(?array $data): ReportEntity
    {
        $timeReport = new JiraReport(
            $data[0],
            $data[1],
            floatval($data[2]),
            $this->createDateFromString($data[3])->format('d.m.Y'),
            $data[4],
            $data[5],
            $data[6],
            $data[7],
            $data[8],
            $data[9],
            $data[10],
            $data[11],
            $data[12],
            $data[13],
            $data[14],
            $data[15],
            $data[16],
            $data[17],
            $data[18],
            $data[19],
            $data[20],
            $data[21],
            $data[0] . ' ' . $data[22],
            $data[23],
            $data[24],
            $data[25],
            $data[26],
            $data[27],
            $data[28],
            $data[29]
        );
        return $timeReport;
    }

    /**
     * @param string $data
     * @return bool
     */
    protected function excludeThisLine(string $data): bool
    {
        $configData = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '../../config.ini');
        $excludeLines = $configData['excluded_lines'];
        foreach ($excludeLines as $exclude) {
            if (strpos($data, $exclude) === 0) {
                return true;
            }
        }
        return false;
    }
}