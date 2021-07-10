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
 * Description of CarbonIntensityGenerationMixObject
 *
 * @author Savvas Radevic
 */
class CarbonIntensityGenerationMixObject extends CarbonIntensityDataObject
{
    protected float $gas;
    protected float $coal;
    protected float $biomass;
    protected float $nuclear;
    protected float $hydro;
    protected float $imports;
    protected float $other;
    protected float $wind;
    protected float $solar;
    //protected string $from;
    //protected string $to;
    protected array  $generationmix;
    //protected string $index;
    //protected array  $dataArray;
    
    /*
        {
          "data":[
          {
            "from": "2018-01-20T12:00Z",
            "to": "2018-01-20T12:30Z",
            "generationmix": [
              {
                "fuel": "gas",
                "perc": 43.6
              },
              {
                "fuel": "coal",
                "perc": 0.7
              },
              {
                "fuel": "biomass",
                "perc": 4.2
              },
              {
                "fuel": "nuclear",
                "perc": 17.6
              },
              {
                "fuel": "hydro",
                "perc": 1.1
              },
              {
                "fuel": "imports",
                "perc": 6.5
              },
              {
                "fuel": "other",
                "perc": 0.3
              },
              {
                "fuel": "wind",
                "perc": 6.8
              },
              {
                "fuel": "solar",
                "perc": 18.1
              }
            ]
          }]
        }
     */
    
    
    public function __construct(array $dataArray) {
        //var_dump($carbonIntensityResponse);
        //parent::__construct($dataArray);
        $this->dataArray = $dataArray;
        //var_dump($this->dataArray);
        unset($this->intensity);
        unset($this->forecast);
        unset($this->actual);
        unset($this->index);
        $this->from = $this->dataArray["from"];
        $this->to = $this->dataArray["to"];
        $this->generationmix = $this->dataArray["generationmix"];
        foreach ($this->generationmix as $val) {
            switch ($val["fuel"]) {
                case 'gas':
                    $this->gas = $val["perc"];
                    break;
                case 'coal':
                    $this->coal = $val["perc"];
                    break;
                case 'biomass':
                    $this->biomass = $val["perc"];
                    break;
                case 'nuclear':
                    $this->nuclear = $val["perc"];
                    break;
                case 'hydro':
                    $this->hydro = $val["perc"];
                    break;
                case 'imports':
                    $this->imports = $val["perc"];
                    break;
                case 'other':
                    $this->other = $val["perc"];
                    break;
                case 'wind':
                    $this->wind = $val["perc"];
                    break;
                case 'solar':
                    $this->solar = $val["perc"];
                    break;
                default:
                    exit(sprintf("Unknown fuel type: %s", $val["fuel"]));
                    break;
            }
       }
    }
}
