<?php

namespace Reporter\Entity;


interface ReportEntity
{
    /**
     * @param float $hours
     * @return mixed
     */
    public function setHours(float $hours);

    /**
     * @return float
     */
    public function getHours(): float;

    /**
     * @param $description
     * @return mixed
     */
    public function setWorkDescription($description);

    /**
     * @return string
     */
    public function getWorkDescription(): string;

    /**
     * @return string
     */
    public function getWorkDate(): string ;

    /**
     * @return string
     */
    public function getIssueSummary(): string ;

    /**
     * @return string
     */
    public function getJSONEncode(): string ;
}