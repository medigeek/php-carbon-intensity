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

use Medigeek\CarbonIntensity\CarbonIntensityRegionalResponse;

/**
 * Description of CarbonIntensityRegionObject
 *
 * @author Savvas Radevic
 */
class CarbonIntensityRegionObject extends CarbonIntensityDataObject
{
    protected array $regionArray;
    protected int $regionid;
    protected string $dnoregion;
    protected string $shortname;
    protected string $postcode;
    
    protected array $intensity;
    protected int $forecast;
    protected string $index;
    
    protected array $generationmix;
    protected float $gas;
    protected float $coal;
    protected float $biomass;
    protected float $nuclear;
    protected float $hydro;
    protected float $imports;
    protected float $other;
    protected float $wind;
    protected float $solar;
    
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
                  "generationmix": [
                    {
                      "fuel": "biomass",
                      "perc": 2.8
                    },
                    {
                      "fuel": "coal",
                      "perc": 0
                    },
                    {
                      "fuel": "imports",
                      "perc": 0
                    },
                    {
                      "fuel": "gas",
                      "perc": 5.9
                    },
                    {
                      "fuel": "nuclear",
                      "perc": 35.1
                    },
                    {
                      "fuel": "other",
                      "perc": 0
                    },
                    {
                      "fuel": "hydro",
                      "perc": 7.6
                    },
                    {
                      "fuel": "solar",
                      "perc": 4.1
                    },
                    {
                      "fuel": "wind",
                      "perc": 44.5
                    }
                  ]
                },
                [..]
     */
    
    
    public function __construct(
        array $regionArray, 
        CarbonIntensityRegionalResponse $parentObject,
        bool $hasDataArray = false,
        bool $getDataFromFirstKey = true
    ) {
        //var_dump($carbonIntensityResponse);
        unset($this->dataArray);
        $this->regionArray = $regionArray;
        unset($this->actual);
        
        //$this->regionsArray = $parentObject["regions"];
        unset($this->regionsArray);
        
        if ($getDataFromFirstKey) {
            //$getDataFromFirstKey
            //regional/intensity/2021-07-20T11:30Z/fw24h/postcode/RG10
            //doesn't have data in first key of $this->dataArray[0]
            //doesn't have "from" in the parent array
            $this->from = $parentObject->get("from");
            $this->to = $parentObject->get("to");
        } else {
            $this->from = $regionArray["from"];
            $this->to = $regionArray["to"];
        }
        
        
        if ($hasDataArray == true) {
            // /regional/england has data array
            $this->regionid = $parentObject->get("regionid");
            $this->dnoregion = $parentObject->get("dnoregion");
            $this->shortname = $parentObject->get("shortname");
            if ($parentObject->exists('postcode')) {
                $this->postcode = $parentObject->get("postcode");
            }
        }
        else {
            $this->regionid = $this->regionArray["regionid"];
            $this->dnoregion = $this->regionArray["dnoregion"];
            $this->shortname = $this->regionArray["shortname"];
        }
        $this->intensity = $this->regionArray["intensity"];
        $this->forecast = $this->intensity["forecast"];
        $this->index = $this->intensity["index"];
        
        $this->generationmix = $this->regionArray["generationmix"];
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
