<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CockpitApi
{
    protected $baseUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->baseUrl = config('services.shirtigo_api.base_url');
        $this->apiToken = config('services.shirtigo_api.token');
    }

    public function baseProducts()
    {
        $response = Http::withToken($this->apiToken)->get("{$this->baseUrl}/base-products?category=1");

        $statusCode = $response->status();
        $data = $response->json();
    
        return [
            'status' => $statusCode,
            'data' => $data
        ];
    }
    public function calculatePrice(array $data)
    {

        $response = Http::withToken($this->apiToken)->post("{$this->baseUrl}/orders/predict-price", $data);

        $statusCode = $response->status();
        $data = $response->json();
    
        return [
            'status' => $statusCode,
            'data' => $data
        ];
    }
    public function createOrder(array $data)
    {

        $response = Http::withToken($this->apiToken)->post("{$this->baseUrl}/orders", $data);

        $statusCode = $response->status();
        $data = $response->json();
    
        return [
            'status' => $statusCode,
            'data' => $data
        ];
    }
}
