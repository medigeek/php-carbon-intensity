<?php

/*
 * The MIT License
 *
 * Copyright 2021 Savvas Radevic.
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
 * Description of CarbonIntensityResponse
 *
 * @author Savvas Radevic
 */
class CarbonIntensityDataSingleObject
{
    private string $from;
    private string $to;
    private array  $intensity;
    private string $forecast;
    private string $actual;
    private string $index;
    
    public function __construct(Response $carbonIntensityResponse) {
        //var_dump($carbonIntensityResponse);
        $this->dataRaw = $carbonIntensityResponse->getBody()->getContents();
        $JSONArray = json_decode($this->dataRaw, true);
        $this->data = $JSONArray["data"];
        //var_dump($this->data);
        //var_dump($JSONArray);
        $this->from = $this->data[0]["from"];
        $this->to = $this->data[0]["to"];
        $this->intensity = $this->data[0]["intensity"];
        $this->forecast = $this->intensity["forecast"];
        $this->actual = $this->intensity["actual"];
        $this->index = $this->intensity["index"];
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
