<?php
declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';

use Medigeek\CarbonIntensity;

$CI = new CarbonIntensity\CarbonIntensity();

/*$intensityTest1 = $CI->getIntensity();
var_dump($intensityTest1);
var_dump($intensityTest1->get('from'));
var_dump($intensityTest1->get('intensity'));
var_dump($intensityTest1->get('actual'));
var_dump($intensityTest1->get('index'));
*/

//$CI->getIntensityDate();
//$CI->getIntensityDate('2021-07-05');
//$CI->getIntensityDate('2021-07-04', '1');
$intensityDate4 = $CI->getIntensityDate('2021-07-04', '4');
foreach ($intensityDate4 as $val) {
    var_dump($val->get('from'));
    var_dump($val->get('intensity'));
    var_dump($val->get('actual'));
    var_dump($val->get('index'));
}