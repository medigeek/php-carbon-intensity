<?php

declare(strict_types=1);

/*
 * The MIT License
 *
 * Copyright 2020-2021 Savvas Radevic <sradevic@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Medigeek\CarbonIntensity;

/**
 * Description of CarbonIntensityRegionsListObject
 *
 * @author Savvas Radevic
 */
class CarbonIntensityRegionsListObject extends CarbonIntensityDataObject
{
    protected string $from;
    protected string $to;
    protected array $regionsArray;
    protected array $regions = [];
    
    /*
        {
       "data": [
         {
           "from": "2021-07-18T14:00Z",
           "to": "2021-07-18T14:30Z",
           "regions": [
             {
               "regionid": 1,
               "dnoregion": "Scottish Hydro Electric Power Distribution",
               "shortname": "North Scotland",
               "intensity": {
                 "forecast": 27,
                 "index": "very low"
               },
               [...]
     */
    
    
    public function __construct(array $dataArray) {
        $this->dataArray = $dataArray;
        //var_dump($this->dataArray);
        //exit("CarbonIntensityRegionsListObject __construct");
        //get first item from the "data" array
        $this->regionsArray = $this->dataArray[0]["regions"];
        $this->from = $this->dataArray[0]["from"];
        $this->to = $this->dataArray[0]["to"];
        unset($this->intensity);
        unset($this->forecast);
        unset($this->actual);
        unset($this->index);
        
        foreach ($this->regionsArray as $value) {
            //call $functionName as method
            $CIRegionObject = new CarbonIntensityRegionObject($value, $this);
            array_push($this->regions, $CIRegionObject);
        }
    }
    
}
