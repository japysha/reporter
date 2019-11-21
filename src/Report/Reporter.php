<?php

namespace Reporter\Report;

use Reporter\Parser\CsvParser;

class Reporter
{

    /**
     * @param $fileName
     * @return string
     * @throws \Exception
     */
    public function createReport($fileName, $progressBar)
    {
        $data = $this->parseCsvFile($fileName);

        if (array_key_first($data)) {
            $firstDay = \DateTime::createFromFormat('d.m.Y', array_key_first($data));
            $firstDay->modify('first day of this month');
            $lastDay = \DateTime::createFromFormat('d.m.Y', array_key_first($data));
            $lastDay->modify('last day of this month');
        } else {
            $firstDay = new \DateTime('FIRST DAY OF PREVIOUS MONTH');
            $lastDay = new \DateTime('LAST DAY OF PREVIOUS MONTH');
        }

        $report = [];
        $reporter = '';
        $totalHours = 0;
        $day = clone $firstDay;
        while ($day <= $lastDay) {
            if (array_key_exists($day->format('d.m.Y'), $data)) {
                $report[] = [
                    'date' => $day->format('d.m.Y'),
                    'hours' => $data[$day->format('d.m.Y')]['hours'],
                    'desc' => $data[$day->format('d.m.Y')]['workDescription'],
                    'weekend' => false
                ];
                $reporter = $data[$day->format('d.m.Y')]['fullName'];
                $totalHours += $data[$day->format('d.m.Y')]['hours'];
            } else {
                $report[] = [
                    'date' => $day->format('d.m.Y'),
                    'hours' => 0,
                    'desc' => '',
                    'weekend' => $this->isWeekend($day)
                ];
            }
            $progressBar->advance();
            $day->add(new \DateInterval('P1D'));
        }
        $fileName = str_replace(' ', '_', $reporter) . '_' . $firstDay->format('d_m_Y') . '-' . $lastDay->format('d_m_Y') . '_report.pdf';
        $this->createPDF($report, $fileName, $reporter, $totalHours);

        return $fileName;
    }

    /**
     * @param $fileName
     * @return mixed
     */
    private function parseCsvFile($fileName)
    {
        $parser = new CsvParser();
        $file = $parser->openFile($fileName);
        $data = $parser->parseFile($file);
        $parser->closeFile($file);
        return $data;
    }

    /**
     * @param \DateTime $date
     * @return bool
     */
    private function isWeekend($date) {
        return (date('N', $date->getTimestamp()) >= 6);
    }

    /**
     * @param $data
     * @param $fileName
     * @param $reporter
     * @param $total
     */
    private function createPDF($data, $fileName, $reporter, $total) {
        $pdf = new PDF();
        $header = array('Date', 'Hours', 'Description');
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->FancyTable($header,$data);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(40,10,'total hours for '. $reporter. ': ' . round($total, 2));
        $pdf->Output('F', __DIR__ . DIRECTORY_SEPARATOR . '../../' . $fileName);
    }
}