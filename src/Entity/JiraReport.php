<?php

namespace Reporter\Entity;
/**
 * Class JiraReport
 * @package Entity
 */
class JiraReport
{
    /**
     * @var string
     */
    public $issueKey;


    public $issueSummary;

    /**
     * @var int
     */
    public $hours;
    public $workDate;
    public $username;
    public $fullName;
    public $period;
    public $accountKey;
    public $accountName;
    public $accountLead;
    public $accountCategory;
    public $accountCustomer;
    public $activityName;
    public $component;
    public $allComponents;
    public $versionName;
    public $issueType;
    public $issueStatus;
    public $projectKey;
    public $projectName;
    public $epic;
    public $epicLink;
    public $workDescription;
    public $parentKey;
    public $reporter;
    public $externalHours;
    public $billedHours;
    public $issueOriginalEstimate;
    public $issueRemainingEstimate;
    public $epicName;

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
}