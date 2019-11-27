<?php

namespace Reporter\Report;

use Reporter\Helper\ColorHelper;
use \FPDF;

class PDF extends FPDF
{
    /**
     * @param $header
     * @param $data
     */
    public function fancyTable($header, $data)
    {
        $colors = $this->getColors();

        $headerColor = ColorHelper::hex2rgb($colors['headerColor']);
        $headerTextColor = ColorHelper::hex2rgb($colors['headerTextColor']);
        $fillColor = ColorHelper::hex2rgb($colors['fillColor']);
        $fillTextColor = ColorHelper::hex2rgb($colors['fillTextColor']);
        $weekendColor = ColorHelper::hex2rgb($colors['weekendColor']);
        $lineColor = ColorHelper::hex2rgb($colors['lineColor']);

        $this->SetFillColor($headerColor['r'], $headerColor['g'], $headerColor['b']);
        $this->SetTextColor($headerTextColor['r'], $headerTextColor['g'], $headerTextColor['b']);
        $this->SetDrawColor($lineColor['r'], $lineColor['g'], $lineColor['b']);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        // Header
        $columnWidth = [35, 15, 140];
        for($i=0; $i < count($header); $i++) {
            $this->Cell($columnWidth[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor($fillColor['r'], $fillColor['g'], $fillColor['b']);
        $this->SetTextColor($fillTextColor['r']);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->SetFillColor($fillColor['r'], $fillColor['g'], $fillColor['b']);
            if ($row['weekend']) {
                $this->SetFillColor($weekendColor['r'], $weekendColor['g'], $weekendColor['b']);
                $fill = true;
            }

            $this->Cell($columnWidth[0],6, $row['date'],'L',0,'L',$fill);
            $this->Cell($columnWidth[1],6, number_format($row['hours'], 2),0,0,'R',$fill);
            $this->MultiCell($columnWidth[2],6, str_replace( ";",PHP_EOL, $row['desc']),'R','L',$fill);
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($columnWidth),0,'','T');
    }

    /**
     * @return array|false
     */
    protected function getColors()
    {
        $configData = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '../../config.ini', true);
        return $configData['colors'];
    }

}