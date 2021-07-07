<?php
declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';

use Medigeek\CarbonIntensity;

$CI = new CarbonIntensity\CarbonIntensity();

/*
$intensityTest1 = $CI->getIntensity();
var_dump($intensityTest1);
var_dump($intensityTest1->get('from'));
var_dump($intensityTest1->get('intensity'));
var_dump($intensityTest1->get('actual'));
var_dump($intensityTest1->get('index'));
*/

/*
$intensityDateNoArgs = $CI->getIntensityDate();
foreach ($intensityDateNoArgs as $val) {
    var_dump($val->get('from'));
    var_dump($val->get('intensity'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
}
*/

/*
$intensityDateOnlyDateArg = $CI->getIntensityDate('2021-07-05');
foreach ($intensityDateOnlyDateArg as $val) {
    var_dump($val->get('from'));
    var_dump($val->get('intensity'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
}
*/

/*
$intensityDatePeriod1 = $CI->getIntensityDate('2021-07-04', '1');
foreach ($intensityDatePeriod1 as $val) {
    var_dump($val->get('from'));
    var_dump($val->get('intensity'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
}
*/

/*
$intensityDatePeriod4 = $CI->getIntensityDate('2021-07-04', '4');
foreach ($intensityDatePeriod4 as $val) {
    var_dump($val->get('from'));
    var_dump($val->get('intensity'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
}
*/

/*
$intensityFactors1 = $CI->getIntensityFactors();
foreach ($intensityFactors1 as $val) {
    var_dump($val->get('Biomass'));
    var_dump($val->get('Coal'));
    var_dump($val->get('Solar'));
    var_dump($val->get('dataArray'));
    var_dump($val->getAll());
}
*/