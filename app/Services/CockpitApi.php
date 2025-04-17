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

    public function getProducts()
    {
        $response = Http::withToken($this->apiToken)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get("{$this->baseUrl}/base-products?category=1");

        $statusCode = $response->status();
        $data = $response->json();
        $data = $data['data'] ?? $data;
    
        return [
            'status' => $statusCode,
            'data' => $data
        ];
    }
    public function calculatePrice(array $payload)
    {
        $response = Http::withToken($this->apiToken)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/orders/predict-price", $payload);

        $statusCode = $response->status();
        $data = $response->json();
        $data = $data['data'] ?? $data;
        try {
            if ($statusCode != "200" && $statusCode !="201") {
                return [
                    'status' => $statusCode,
                    'msg' => "Shirtigo Cockpit API returned $statusCode",
                    'CockpitAPI msg' => $data['message'],
                ];
            }
            return [
                'status' => $statusCode,
                'data' => $data,
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 500,
                'message' => 'Something went wrong with backend.',
            ];
        }

    }
    public function createOrder(array $payload)
    {

        $response = Http::withToken($this->apiToken)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/orders", $payload);

        $statusCode = $response->status();
        $data = $response->json();
        $data = $data['data'] ?? $data;
    
        try {
            if ($statusCode != "200" && $statusCode !="201") {
                return [
                    'status' => $statusCode,
                    'msg' => "Shirtigo Cockpit API returned $statusCode",
                    'CockpitAPI msg' => $data['message'],
                ];
            }
            return [
                'status' => $statusCode,
                'data' => $data,
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 500,
                'message' => 'Something went wrong with backend.',
            ];
        }
    }
}
