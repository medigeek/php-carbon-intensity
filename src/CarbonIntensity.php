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

use GuzzleHttp\Client;
use Medigeek\CarbonIntensity\CarbonIntensityResponse;
use Medigeek\CarbonIntensity\CarbonIntensityRegionalResponse;
use Exception;

/**
 * PHP SDK for carbonintensity.org.uk
 *
 * @author Savvas Radevic
 */
class CarbonIntensity
{

    protected $client = null;

    public function __construct () {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.carbonintensity.org.uk/',
            // You can set any number of default request options.
            'timeout' => 60.0,
        ]);
    }

    public function getIntensityFactors () {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-factors
        $endpointString = 'intensity/factors';
        $obj = $this->callApiEndpoint($endpointString, 'CarbonIntensityFactorsObject');
        return $obj->get('data');
    }

    public function getIntensityDate (string $date = '', string $period = ''): array {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date-date
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date-date-period
        $endpointString = sprintf('intensity/date/%s/%s', $date, $period);
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data');
    }

    private function callApiEndpoint (
        string $endpoint,
        string $objectType = 'CarbonIntensityDataObject'
    ): CarbonIntensityResponse {
        try {
            $response = $this->client->get(
                $endpoint,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
        } catch (Exception $e) {
            exit(sprintf("exception %s: %s\n", $e->getCode(), $e->getMessage()));
        }

        $responseObject = new CarbonIntensityResponse($response, $objectType);
        return $responseObject;
    }

    public function getIntensity (): CarbonIntensityDataObject {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity
        $endpointString = 'intensity';
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data')[0];
    }

    public function getIntensityFromTo (
        string $from = '',
        string $to = ''
    ): array {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-from
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-from-to
        $endpointString = sprintf('intensity/%s/%s', $from, $to);
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data');
    }

    public function getIntensityFW24h (
        string $from
    ): array {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-from-fw24h
        $endpointString = sprintf('intensity/%s/fw24h', $from);
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data');
    }

    public function getIntensityFW48h (
        string $from
    ): array {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-from-fw48h
        $endpointString = sprintf('intensity/%s/fw48h', $from);
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data');
    }

    public function getIntensityPT24h (
        string $from
    ): array {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-from-pt24h
        $endpointString = sprintf('intensity/%s/pt24h', $from);
        $obj = $this->callApiEndpoint($endpointString);
        return $obj->get('data');
    }

    public function getIntensityStats (
        string $from,
        string $to,
        string $block = ''
    ): array {
        //https://carbon-intensity.github.io/api-definitions/#get-intensity-stats-from-to
        //https://carbon-intensity.github.io/api-definitions/#get-intensity-stats-from-to-block
        $endpointString = sprintf('intensity/stats/%s/%s/%s', $from, $to, $block);
        $obj = $this->callApiEndpoint($endpointString, 'CarbonIntensityStatsObject');
        return $obj->get('data');
    }

    public function getGeneration (): CarbonIntensityGenerationMixObject {
        //https://carbon-intensity.github.io/api-definitions/#get-generation
        //https://carbon-intensity.github.io/api-definitions/#get-generation-from-to
        $endpointString = 'generation';
        $obj = $this->callApiEndpoint($endpointString, 'CarbonIntensityGenerationMixObject', false);
        return $obj->get('data')[0];
    }

    public function getGenerationFromTo (
        string $from,
        string $to
    ): array {
        //https://carbon-intensity.github.io/api-definitions/#get-generation
        //https://carbon-intensity.github.io/api-definitions/#get-generation-from-to
        $endpointString = sprintf('generation/%s/%s', $from, $to);
        $obj = $this->callApiEndpoint($endpointString, 'CarbonIntensityGenerationMixObject');
        return $obj->get('data');
    }

    public function getGenerationPT24h (
        string $from
    ): array {
        //https://carbon-intensity.github.io/api-definitions/#get-generation-from-pt24h
        $endpointString = sprintf('generation/%s/pt24h', $from);
        $obj = $this->callApiEndpoint($endpointString, 'CarbonIntensityGenerationMixObject');
        return $obj->get('data');
    }
    
    private function callApiEndpointRegional (
        string $endpoint,
        bool $hasDataArray = false,
        bool $getDataFromFirstKey = true
    ): CarbonIntensityRegionalResponse {
        try {
            $response = $this->client->get(
                $endpoint,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
        } catch (Exception $e) {
            exit(sprintf("exception %s: %s\n", $e->getCode(), $e->getMessage()));
        }

        $responseObject = new CarbonIntensityRegionalResponse($response, $hasDataArray, $getDataFromFirstKey);
        return $responseObject;
    }

    public function getRegional (): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional
        $endpointString = 'regional';
        $obj = $this->callApiEndpointRegional($endpointString);
        return $obj;
    }
    
    public function getRegionalEngland (): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-england
        $endpointString = 'regional/england';
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true);
        return $obj;
    }
    
    public function getRegionalScotland (): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-scotland
        $endpointString = 'regional/scotland';
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true);
        return $obj;
    }
    
    public function getRegionalWales (): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-wales
        $endpointString = 'regional/wales';
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true);
        return $obj;
    }
    
    
    public function getRegionalPostcode (string $postcode): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-postcode-postcode
        $endpointString = sprintf('regional/postcode/%s', $postcode);
        //regex validation: '^([A-Z][A-HJ-Y]?[0-9][A-Z0-9]?|GIR)$'
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true);
        return $obj;
    }
    
    
    public function getRegionalRegionID (int $regionID): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-regionid-regionid
        $endpointString = sprintf('regional/regionid/%s', $regionID);
        //validation: [1-17] https://carbon-intensity.github.io/api-definitions/#region-list
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true);
        return $obj;
    }
    
    
    public function getRegionalIntensityFromFw24h (string $from): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-intensity-from-fw24h
        $endpointString = sprintf('regional/intensity/%s/fw24h', $from);
        //validation: [1-17] https://carbon-intensity.github.io/api-definitions/#region-list
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = false);
        return $obj;
    }
    
    
    public function getRegionalIntensityFromFw24hPostcode (string $from, string $postcode): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-intensity-from-fw24h-postcode-postcode
        $endpointString = sprintf('regional/intensity/%s/fw24h/postcode/%s', $from, $postcode);
        //validation: [1-17] https://carbon-intensity.github.io/api-definitions/#region-list
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true, $getDataFromFirstKey = false);
        return $obj;
    }
    
    
    public function getRegionalIntensityFromFw24hRegionID (string $from, int $regionID): CarbonIntensityRegionalResponse {
        //https://carbon-intensity.github.io/api-definitions/#get-regional-intensity-from-fw24h-postcode-postcode
        $endpointString = sprintf('regional/intensity/%s/fw24h/regionid/%s', $from, $regionID);
        //validation: [1-17] https://carbon-intensity.github.io/api-definitions/#region-list
        $obj = $this->callApiEndpointRegional($endpointString, $hasDataArray = true, $getDataFromFirstKey = false);
        return $obj;
    }
    
    

}
