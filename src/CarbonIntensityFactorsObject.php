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
 * Description of CarbonIntensityFactorsObject
 *
 * @author Savvas Radevic
 */
class CarbonIntensityFactorsObject extends CarbonIntensityDataObject
{
    //protected array $dataArray;
    protected int $Biomass;
    protected int $Coal;
    protected int $DutchImports;
    protected int $FrenchImports;
    protected int $GasCombinedCycle;
    protected int $GasOpenCycle;
    protected int $Hydro;
    protected int $IrishImports;
    protected int $Nuclear;
    protected int $Oil;
    protected int $Other;
    protected int $PumpedStorage;
    protected int $Solar;
    protected int $Wind;
    
    /*
      {
        "data":[
        {
          "Biomass": 120,
          "Coal": 937,
          "Dutch Imports": 474,
          "French Imports": 53,
          "Gas (Combined Cycle)": 394,
          "Gas (Open Cycle)": 651,
          "Hydro": 0,
          "Irish Imports": 458,
          "Nuclear": 0,
          "Oil": 935,
          "Other": 300,
          "Pumped Storage": 0,
          "Solar": 0,
          "Wind": 0
        }]
      }
     */
    
    
    public function __construct(array $dataArray) {
        //var_dump($carbonIntensityResponse);
        //var_dump($dataArray);
        $this->dataArray = $dataArray;
        //var_dump($this->data);
        //var_dump($JSONArray);
        unset($this->intensity);
        unset($this->forecast);
        unset($this->actual);
        unset($this->index);
        $this->Biomass = $this->dataArray["Biomass"];
        $this->Coal = $this->dataArray["Coal"];
        $this->DutchImports = $this->dataArray["Dutch Imports"];
        $this->FrenchImports = $this->dataArray["French Imports"];
        $this->GasCombinedCycle = $this->dataArray["Gas (Combined Cycle)"];
        $this->GasOpenCycle = $this->dataArray["Gas (Open Cycle)"];
        $this->Hydro = $this->dataArray["Hydro"];
        $this->IrishImports = $this->dataArray["Irish Imports"];
        $this->Nuclear = $this->dataArray["Nuclear"];
        $this->Oil = $this->dataArray["Oil"];
        $this->Other = $this->dataArray["Other"];
        $this->PumpedStorage = $this->dataArray["Pumped Storage"];
        $this->Solar = $this->dataArray["Solar"];
        $this->Wind = $this->dataArray["Wind"];
    }

}
