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
 * Description of CarbonIntensityDataObject
 *
 * @author Savvas Radevic
 */
class CarbonIntensityStatsObject extends CarbonIntensityDataObject
{
    protected int $min;
    protected int $max;
    protected int $average;
    //protected string $from;
    //protected string $to;
    //protected array  $intensity;
    //protected string $index;
    //protected array  $dataArray;
    
    /*
        {
          "data":[
          {
            "from": "2018-01-20T12:00Z",
            "to": "2018-01-20T12:30Z",
            "intensity": {
              "max": 320,
              "average": 266,
              "min": 180,
              "index": "moderate"
            }
          }]
        }
     */
    
    
    public function __construct(array $dataArray) {
        //var_dump($carbonIntensityResponse);
        //parent::__construct($dataArray);
        $this->dataArray = $dataArray;
        //var_dump($this->dataArray);
        $this->from = $this->dataArray["from"];
        $this->to = $this->dataArray["to"];
        $this->intensity = $this->dataArray["intensity"];
        $this->max = $this->intensity["max"];
        $this->min = $this->intensity["min"];
        $this->average = $this->intensity["average"];
    }
}
