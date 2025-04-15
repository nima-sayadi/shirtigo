<?php

namespace App\Http\Controllers;

use App\Services\CockpitApi;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

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

}