<?php

namespace App\Http\Controllers;

use App\Services\CockpitApi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use App\Events\OrderWasPlaced;

class CockpitApiController extends Controller {
    protected $apiService;

    public function __construct(CockpitApi $apiService)
    {
        $this->apiService = $apiService;
    }
    

    public function getProducts()
    {
        $response = $this->apiService->baseProducts();
        return Inertia::render('Order', [
            'products' => $response,
        ]);
    }

    public function calculatePrice(Request $request)
    {
        $data = $request->validate([
            'delivery' => 'required|array',
            'products' => 'required|array',
            'delivery.firstname' => 'required|string',
            'delivery.lastname' => 'required|string',
            'delivery.street' => 'required|string',
            'delivery.postcode' => 'required|string',
            'delivery.city' => 'required|string',
            'delivery.country' => 'required|string',
            'products.*.base_product_sku' => 'required|string',
            'products.*.amount' => 'required|integer|min:1',
            'products.*.processings.*.processingarea_type' => 'required|string',
            'products.*.processings.*.processingposition' => 'required|string',
            'products.*.processings.*.design_url' => 'required|string',
            'products.*.processings.*.width' => 'required|integer',
            'products.*.processings.*.offset_top' => 'required|integer',
            'products.*.processings.*.offset_center' => 'required|integer',
        ]);
        $response = $this->apiService->calculatePrice($data);
        return $response;
    }

    public function createOrder(Request $request)
    {
        $data = $request->validate([
            'delivery' => 'required|array',
            'products' => 'required|array',
            'delivery.firstname' => 'required|string',
            'delivery.lastname' => 'required|string',
            'delivery.street' => 'required|string',
            'delivery.postcode' => 'required|string',
            'delivery.city' => 'required|string',
            'delivery.country' => 'required|string',
            'products.*.base_product_sku' => 'required|string',
            'products.*.amount' => 'required|integer|min:1',
            'products.*.processings.*.processingarea_type' => 'required|string',
            'products.*.processings.*.processingposition' => 'required|string',
            'products.*.processings.*.processingmethod' => 'required|string',
            'products.*.processings.*.design_url' => 'required|string',
            'products.*.processings.*.width' => 'required|integer',
            'products.*.processings.*.offset_top' => 'required|integer',
            'products.*.processings.*.force_position' => 'required|boolean',
            'products.*.processings.*.extract_size_and_position' => 'required|boolean',
        ]);
        $response = $this->apiService->createOrder($data);
        if($response[''] == 200){
            event(new OrderWasPlaced($response['status']));
        }
        return $response;
    }

}