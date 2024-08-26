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
    public function updateProduct(Request $request, $productId) {
        $shopify = Shopify::first();
    
        // JSON object to send in the POST request
        $jsonObject = $request->all(); // This assumes the JSON data is in the request body
    
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->put('https://' . $shopify->store . '.myshopify.com/admin/api/2024-07/products/' . $productId . '.json', $jsonObject);
    
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to update the product on Shopify API.'], $response->status());
        }
    }
    public function updateProductQuantity(Request $request) {
        $shopify = Shopify::first();
    
        // JSON object to send in the POST request
        $jsonObject = $request->all(); // This assumes the JSON data is in the request body
    
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->post('https://' . $shopify->store . '.myshopify.com/admin/api/2024-07/inventory_levels/set.json', $jsonObject);
    
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to update the product quantity on Shopify API.'], $response->status());
        }
    }
    public function getOrders()
    {
        // Obtener la primera instancia de Shopify desde la base de datos
        $shopify = Shopify::first();

        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->get('https://' . $shopify->store . '.myshopify.com/admin/api/2024-07/orders.json?status=any');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch Orders from Shopify API.'], $response->status());
        }
    }
    public function createOrder(Request $request) {
        $shopify = Shopify::first();
    
        // JSON object to send in the POST request
        $jsonObject = $request->all(); // This assumes the JSON data is in the request body
    // dd($jsonObject);
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $shopify->token_shopify,
        ])->post('https://' . $shopify->store . '.myshopify.com/admin/api/2024-01/orders.json', $jsonObject);
    
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to Create an order on Shopify API.'], $response->status());
        }
    }
    //
}
