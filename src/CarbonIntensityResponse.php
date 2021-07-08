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
use GuzzleHttp\Psr7\Response;
use Medigeek\CarbonIntensity\CarbonIntensityDataObject;
use Medigeek\CarbonIntensity\CarbonIntensityStatsObject;

/**
 * Description of CarbonIntensityResponse
 *
 * @author Savvas Radevic
 */
class CarbonIntensityResponse
{
    private string $dataRaw = "";
    private array $data = [];
    private int $statusCode;
    private string $statusMessage;
    
    public function __construct(
        Response $carbonIntensityResponse, 
        string $objectType = 'CarbonIntensityDataObject'
    ) {
        //var_dump($carbonIntensityResponse);
        $this->dataRaw = $carbonIntensityResponse->getBody()->getContents();
        $JSONArray = json_decode($this->dataRaw, true);
        //var_dump($JSONArray);
        if (array_key_exists("error", $JSONArray)) {
            /*
                {
                "error": {
                  "code": "400 Bad Request",
                  "message": "Please enter a valid date in ISO8601 format 
                             YYYY-MM-DD and period 1-48 e.g. /intensity/date/2017-08-25/42"
                  }
                }
             */
            
            exit(
                sprintf(
                    "error %s: %s\n", 
                    $JSONArray["error"]["code"],
                    $JSONArray["error"]["message"])
            );
        }
        $this->statusCode = $carbonIntensityResponse->getStatusCode();
        $this->statusMessage = $carbonIntensityResponse->getReasonPhrase();
        //$this->data = $JSONArray["data"];
        foreach ($JSONArray["data"] as $value) {
            if ($objectType == 'CarbonIntensityFactorsObject') {
                array_push($this->data, $this->prepareFactorsObject($value));
            }
            elseif ($objectType == 'CarbonIntensityStatsObject') {
                array_push($this->data, $this->prepareStatsObject($value));
            }
            else {
                array_push($this->data, $this->prepareDataObject($value));
            }
        }
        //var_dump($this->data);
        //var_dump($JSONArray);
    }
    
    private function prepareDataObject($value): CarbonIntensityDataObject {
        $obj = new CarbonIntensityDataObject($value);
        return $obj;
    }
    
    private function prepareStatsObject($value): CarbonIntensityStatsObject {
        $obj = new CarbonIntensityStatsObject($value);
        return $obj;
    }
    
    private function prepareFactorsObject($value): CarbonIntensityFactorsObject {
        $obj = new CarbonIntensityFactorsObject($value);
        return $obj;
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
