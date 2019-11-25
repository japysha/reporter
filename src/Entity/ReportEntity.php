<?php

namespace Reporter\Entity;


interface ReportEntity
{
    /**
     * @param int $hours
     * @return mixed
     */
    public function setHours(int $hours);

    /**
     * @return int
     */
    public function getHours();

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