<?php
declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';

use Medigeek\CarbonIntensity;

$CI = new CarbonIntensity\CarbonIntensity();



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

/*
$intensityTest1 = $CI->getIntensity();
var_dump($intensityTest1);
var_dump($intensityTest1->get('from'));
var_dump($intensityTest1->get('intensity'));
var_dump($intensityTest1->get('actual'));
var_dump($intensityTest1->get('index'));
*/

/*
$intensityTest2 = $CI->getIntensityFromTo('2021-07-07T16:31Z');
foreach ($intensityTest2 as $val) {
    var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
    var_dump($val->get('intensity'));
}
*/

/*
$intensityTest3 = $CI->getIntensityFromTo('2021-07-07T08:01Z', '2021-07-07T09:00Z');
foreach ($intensityTest3 as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
    var_dump($val->get('intensity'));
}
*/

/*
$intensityFW24h = $CI->getIntensityFW24h('2021-07-06T08:01Z');
foreach ($intensityFW24h as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
    var_dump($val->get('intensity'));
}
*/

/*
$intensityFW48h = $CI->getIntensityFW48h('2021-07-04T08:01Z');
foreach ($intensityFW48h as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
    var_dump($val->get('intensity'));
}
*/

/*
$intensityPT24h = $CI->getIntensityPT24h('2021-07-07T08:01Z');
foreach ($intensityPT24h as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
    var_dump($val->get('intensity'));
}
*/

/*
$intensityStats1 = $CI->getIntensityStats('2021-07-07T08:01Z', '2021-07-07T12:00Z');
foreach ($intensityStats1 as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('min'));
    var_dump($val->get('max'));
    var_dump($val->get('average'));
    var_dump($val->get('intensity'));
}

$intensityStats2 = $CI->getIntensityStats('2021-07-07T08:01Z', '2021-07-07T12:00Z', '2');
foreach ($intensityStats2 as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('min'));
    var_dump($val->get('max'));
    var_dump($val->get('average'));
    var_dump($val->get('intensity'));
}

*/


/*
$generationPT24h = $CI->getGenerationPT24h('2021-07-09T08:01Z');
foreach ($generationPT24h as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('gas'));
    var_dump($val->get('solar'));
    var_dump($val->get('generationmix'));
}
*/

/*
$generation1 = $CI->getGeneration();
//var_dump($generation1);
var_dump($generation1->get('from'));
var_dump($generation1->get('gas'));
var_dump($generation1->get('solar'));
var_dump($generation1->get('hydro'));
var_dump($generation1->get('other'));
var_dump($generation1->get('wind'));
var_dump($generation1->get('generationmix'));
*/

/*
$generationFromTo1 = $CI->getGenerationFromTo('2021-07-09T08:01Z', '2021-07-09T12:00Z');
foreach ($generationFromTo1 as $val) {
    //var_dump($val);
    var_dump($val->get('from'));
    var_dump($val->get('gas'));
    var_dump($val->get('solar'));
    var_dump($val->get('generationmix'));
}
*/
