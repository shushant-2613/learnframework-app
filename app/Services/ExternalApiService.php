<?php
// app/Services/ExternalApiService.php

namespace App\Services;

use GuzzleHttp\Client; //HTTP Request
use Illuminate\Support\Facades\Http;

class ExternalApiService
{
    protected $apiBaseUrl;
    protected $httpClient;

    public function __construct($apiBaseUrl)
    {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->httpClient = new Client();
    }

    public function getQuestions()
    {
        $externalApiService = new ExternalApiService(config('services.external_api.api_base_url'));

$response = Http::get($externalApiService->getApiBaseUrl() . '/api/v1/questions', [
    'apiKey' => config('services.external_api.api_key'),
    'limit' => 10,
]);
        return $response->json();
    }
}