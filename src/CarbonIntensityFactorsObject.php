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
class CarbonIntensityFactorsObject
{
    private array $dataArray;
    private int $Biomass;
    private int $Coal;
    private int $DutchImports;
    private int $FrenchImports;
    private int $GasCombinedCycle;
    private int $GasOpenCycle;
    private int $Hydro;
    private int $IrishImports;
    private int $Nuclear;
    private int $Oil;
    private int $Other;
    private int $PumpedStorage;
    private int $Solar;
    private int $Wind;
    
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

    public function get(string $key, string $returntype = "array")
    {

        $tmpString = $this->$key;

        if ($returntype == "array") {
            return $tmpString;
        } elseif ($returntype == "json") {
            $jsonArray = json_encode($tmpString);
            return $jsonArray;
        }
    }

    public function set(string $key, $value)
    {
        $this->$key = $value;
        return true;
    }

    public function getMultiple(array $keys, string $returntype = "array")
    {
        $tmpArray = [];
        foreach ($keys as $key) {
            $tmpArray["$key"] = $this->$key;
        }

        if ($returntype == "array") {
            return $tmpArray;
        } elseif ($returntype == "json") {
            $jsonArray = json_encode($tmpArray);
            return $jsonArray;
        }
    }

    public function setMultiple(array $keyValuePairs)
    {
        foreach ($keyValuePairs as $key => $value) {
            $this->$key = $this->$value;
        }
    }

    public function getAll(string $returntype = "array")
    {
        $keyValuePairs = get_object_vars($this);
        ksort($keyValuePairs);

        if ($returntype == "array") {
            return $keyValuePairs;
        } elseif ($returntype == "json") {
            $KeyValuePairsJSON = json_encode($keyValuePairs);
            return $KeyValuePairsJSON;
        }
    }
}
