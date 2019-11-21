<?php

namespace Reporter\Parser;

use Reporter\Entity\JiraReport;

/**
 * Class CsvParser
 */
class CsvParser implements Parser
{
    /**
     * @var array
     */
    private $excludeLines = ['#', 'Issue Key'];

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

            $timeReport = $this->getJiraReport($data);

            if ($this->isAbsence($timeReport)) {
                $timeReport->hours = 0;
                $timeReport->workDescription = 'absence';
            }

            if (!array_key_exists($timeReport->workDate, $monthReport)) {
                $monthReport[$timeReport->workDate] = (array)$timeReport;
            } else {
                $monthReport[$timeReport->workDate]['hours'] += $timeReport->hours;
                $monthReport[$timeReport->workDate]['workDescription'] .= ';' . $timeReport->workDescription;
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
     * @return DateTime
     */
    private function createDateFromString($string)
    {
        return \DateTime::createFromFormat('Y-m-d H:i', $string);
    }

    /**
     * @param $timeReport
     * @return bool
     */
    private function isAbsence($timeReport)
    {
        return strpos(strtolower($timeReport->issueSummary),'days off') !== false ||
            strpos(strtolower($timeReport->issueSummary),'day off') !== false ||
            strpos(strtolower($timeReport->issueSummary),'sickness') !== false ||
            strpos(strtolower($timeReport->issueSummary),'sick') !== false ||
            strpos(strtolower($timeReport->issueSummary),'leave of absence') !== false;
    }

    /**
     * @param array|null $data
     * @return JiraReport
     */
    private function getJiraReport(?array $data): JiraReport
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
    private function excludeThisLine(string $data): bool
    {
        foreach ($this->excludeLines as $exclude) {
            if (strpos($data, $exclude) === 0) {
                return true;
            }
        }
        return false;
    }
}