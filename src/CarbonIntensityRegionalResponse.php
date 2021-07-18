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
use Medigeek\CarbonIntensity\CarbonIntensityRegionObject;

/**
 * Description of CarbonIntensityRegionalResponse
 *
 * @author Savvas Radevic
 */
class CarbonIntensityRegionalResponse extends CarbonIntensityResponse
{
    /*private string $dataRaw = "";
    private array $data = [];
    private int $statusCode;
    private string $statusMessage;
    */
    
    protected string $from;
    protected string $to;
    protected array $regionsArray;
    protected array $regions = [];
    
    public function __construct(
        Response $carbonIntensityResponse
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
        
        //$CIRegionsListObject = new CarbonIntensityRegionsListObject($JSONArray["data"]);
        //$this->data = $CIRegionsListObject;
       
        $this->dataArray = $JSONArray["data"];
        unset($this->data);
        
        $this->regionsArray = $this->dataArray[0]["regions"];
        $this->from = $this->dataArray[0]["from"];
        $this->to = $this->dataArray[0]["to"];
        
        //var_dump($this->regionsArray);
        //exit();
        foreach ($this->regionsArray as $value) {
            //call $functionName as method
            $CIRegionObject = new CarbonIntensityRegionObject($value, $this);
            array_push($this->regions, $CIRegionObject);
        }
        //var_dump($this->regions);
        //exit();
    }
}
