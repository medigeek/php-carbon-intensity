<?php

require_once __DIR__.'/../vendor/autoload.php';

use Medigeek\CarbonIntensity;

$CI = new CarbonIntensity\CarbonIntensity();

//$CI->getIntensity();
//$CI->getIntensityDate();
//$CI->getIntensityDate('2021-07-05');
$CI->getIntensityDate('2021-07-04', '1');
$CI->getIntensityDate('2021-07-04', '4');
