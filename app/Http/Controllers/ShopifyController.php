<?php

namespace App\Http\Controllers;

use App\Models\Shopify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopifyController extends Controller
{
    public function getProducts()
    {
        // Obtener la primera instancia de Shopify desde la base de datos
        $shopify = Shopify::first();

        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->get('https://' . $shopify->store . '.myshopify.com/admin/api/2024-07/products.json');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch products from Shopify API.'], $response->status());
        }
    }
    public function getStoreLocations(){
        $shopify = Shopify::first();

        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->get('https://' . $shopify->store . '.myshopify.com/admin/api/2024-07/locations.json');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch products from Shopify API.'], $response->status());
        }
    }
    //
}
