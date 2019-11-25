<?php

namespace Reporter\Entity;
/**
 * Class JiraReport
 * @package Entity
 */
class JiraReport implements ReportEntity
{
    private $issueKey;
    private $issueSummary;
    private $hours;
    private $workDate;
    private $username;
    private $fullName;
    private $period;
    private $accountKey;
    private $accountName;
    private $accountLead;
    private $accountCategory;
    private $accountCustomer;
    private $activityName;
    private $component;
    private $allComponents;
    private $versionName;
    private $issueType;
    private $issueStatus;
    private $projectKey;
    private $projectName;
    private $epic;
    private $epicLink;
    private $workDescription;
    private $parentKey;
    private $reporter;
    private $externalHours;
    private $billedHours;
    private $issueOriginalEstimate;
    private $issueRemainingEstimate;
    private $epicName;

    /**
     * JiraReport constructor.
     * @param string $issueKey
     * @param $issueSummary
     * @param $hours
     * @param $workDate
     * @param $username
     * @param $fullName
     * @param $period
     * @param $accountKey
     * @param $accountName
     * @param $accountLead
     * @param $accountCategory
     * @param $accountCustomer
     * @param $activityName
     * @param $component
     * @param $allComponents
     * @param $versionName
     * @param $issueType
     * @param $issueStatus
     * @param $projectKey
     * @param $projectName
     * @param $epic
     * @param $epicLink
     * @param $workDescription
     * @param $parentKey
     * @param $reporter
     * @param $externalHours
     * @param $billedHours
     * @param $issueOriginalEstimate
     * @param $issueRemainingEstimate
     * @param $epicName
     */
    public function __construct($issueKey, $issueSummary, $hours, $workDate, $username, $fullName, $period, $accountKey, $accountName, $accountLead, $accountCategory, $accountCustomer, $activityName, $component, $allComponents, $versionName, $issueType, $issueStatus, $projectKey, $projectName, $epic, $epicLink, $workDescription, $parentKey, $reporter, $externalHours, $billedHours, $issueOriginalEstimate, $issueRemainingEstimate, $epicName)
    {
        $this->issueKey = $issueKey;
        $this->issueSummary = $issueSummary;
        $this->hours = $hours;
        $this->workDate = $workDate;
        $this->username = $username;
        $this->fullName = $fullName;
        $this->period = $period;
        $this->accountKey = $accountKey;
        $this->accountName = $accountName;
        $this->accountLead = $accountLead;
        $this->accountCategory = $accountCategory;
        $this->accountCustomer = $accountCustomer;
        $this->activityName = $activityName;
        $this->component = $component;
        $this->allComponents = $allComponents;
        $this->versionName = $versionName;
        $this->issueType = $issueType;
        $this->issueStatus = $issueStatus;
        $this->projectKey = $projectKey;
        $this->projectName = $projectName;
        $this->epic = $epic;
        $this->epicLink = $epicLink;
        $this->workDescription = $workDescription;
        $this->parentKey = $parentKey;
        $this->reporter = $reporter;
        $this->externalHours = $externalHours;
        $this->billedHours = $billedHours;
        $this->issueOriginalEstimate = $issueOriginalEstimate;
        $this->issueRemainingEstimate = $issueRemainingEstimate;
        $this->epicName = $epicName;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return int
     */
    public function getHours()
    {
        $this->hours;
    }

    /**
     * @param $description
     */
    public function setWorkDescription($description)
    {
        $this->workDescription = $description;
    }

    /**
     * @return string
     */
    public function getWorkDescription(): string
    {
        return $this->workDescription;
    }

    /**
     * @return string
     */
    public function getWorkDate(): string
    {
        return $this->workDate;
    }

    /**
     * @return string
     */
    public function getIssueSummary(): string
    {
        return $this->issueSummary;
    }

    /**
     * @return string
     */
    public function getJSONEncode(): string
    {
        return json_encode(get_object_vars($this));
    }
}