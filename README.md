# Reporter

This project parse file report.csv export from Jira ticketing system and creates monthly time log report in PDF.

### Prerequisites

PHP 7.3. need to be installed and run.

If you need help to update your PHP version take a look <a target="_blank" href="https://php-osx.liip.ch/">here</a>.


### Install & Run

The fastest way to install Phinx is to add it to your project using Composer (<a target="_blank" href="https://getcomposer.org/">https://getcomposer.org/</a>).

<ol>
<li>Install Composer:

```
$ curl -sS https://getcomposer.org/installer | php
```
</li>
<li>Clone project from git:

```
$ git clone https://github.com/japysha/reporter.git
```
</li>
<li>Run composer install:

```
$ php composer.phar install
```
</li>
<li>Execute Reporter:<br>
Download you report from jira for given time period. Name file report.csv and save in reporter folder. Run command

```
$ ./reporter generate-pdf
```

in case you get error: <br>zsh:permission denied <br>give permission to reporter with command:

```
$ chmod +x ./reporter
```
</li>
</ol>

Pdf report with you name and time period will be generated in same folder.


## Authors

* **japysha** 