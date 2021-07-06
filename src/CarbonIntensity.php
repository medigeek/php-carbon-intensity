<?php

declare(strict_types=1);

/*
 * The MIT License
 *
 * Copyright 2020 Savvas Radevic.
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
use Exception;

/**
 * PHP SDK for carbonintensity.org.uk
 *
 * @author Savvas Radevic
 */
class CarbonIntensity
{
    protected $client = null;
    
    public function __construct()
    {
        echo "construct\n";
        $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'https://api.carbonintensity.org.uk/',
                // You can set any number of default request options.
                'timeout'  => 60.0,
            ]);
    }
    
    public function getIntensityDate(string $date = '', string $period = '')
    {
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date-date
        //https://carbon-intensity.github.io/api-definitions/?shell#get-intensity-date-date-period
        $endpointString = sprintf('intensity/date/%s/%s', $date, $period);
        $obj = $this->callApiEndpoint($endpointString);
        //var_dump($obj);
        return $obj->get('data');
        //exit("DEBUG DONE getIntensityDate");
    }
    
    private function callApiEndpoint(string $endpoint): CarbonIntensityResponse {
        try {
            $response = $this->client->get(
                //'intensity/',
                $endpoint,
                [
                    'headers' => [
                        //'User-Agent' => 'testing/1.0',
                        'Accept'     => 'application/json',
                        //'X-Foo'      => ['Bar', 'Baz']
                    ]
                ]
            );
        } catch (Exception $e) {
            exit(sprintf("exception %s: %s\n", $e->getCode(), $e->getMessage()));
        }
        
        $responseObject = new CarbonIntensityResponse($response);
        //var_dump($responseObject);
        //$code = $response->getStatusCode();
        //$reasonPhrase = $response->getReasonPhrase();
        /*printf("code %s reasonPhrase: %s\n body->contents: %s\n",
            $code,
            $reasonPhrase,
            $responseObject->get('dataRaw')
            );
        */
        return $responseObject;
    }
    
    public function getIntensity(): CarbonIntensityDataObject {
        $obj = $this->callApiEndpoint('intensity');
        //var_dump($obj->get('data')[0]);
        //exit("DEBUG DONE getIntensity");
        return $obj->get('data')[0];
    }
}