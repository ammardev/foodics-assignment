<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\IngredientProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $products = collect($request->validated()['products'])
            ->mapWithKeys(fn($product) => [$product['id'] => ['quantity' => $product['quantity']]]);

        $ingredientProductPivotList = IngredientProduct::whereIn('product_id', $products->keys())
            ->with('ingredient:id,current_amount,inserted_amount,amount_alert_sent')
            ->get()
            ->map(function($item) use ($products) {
                $item->quantity = $products[$item->product_id]['quantity'];
                return $item;
            });
            
        $neededIngredients = [];
        
        foreach($ingredientProductPivotList as $listItem) {
            if (!isset($neededIngredients[$listItem->ingredient_id])) {
                $neededIngredients[$listItem->ingredient_id] = [
                    'needed_amount' => 0,
                    ...$listItem->ingredient->toArray(),
                    'products' => []
                ];
            }
            $neededIngredients[$listItem->ingredient_id]['needed_amount'] += $listItem->needed_amount * $listItem->quantity;
            $neededIngredients[$listItem->ingredient_id]['products'][] = $listItem->product_id;
        }

        foreach ($neededIngredients as $ingredientId => $ingredient) {

            $remainingAmount = $ingredient['current_amount'] - $ingredient['needed_amount'];

            if ($remainingAmount < 0) {
                // TODO: we can here send an alert to the merchant
                return response()->json(['error' => 'insufficient_amount for ingredient ' . $ingredientId]);
            }
            
            if (!$ingredient['amount_alert_sent'] && $remainingAmount <= $ingredient['inserted_amount'] / 2) {
                dump('send alert');
                // TODO: send the alert
            }
        }

        Order::create()->products()->attach($products->toArray());

        return response()->json(['message' => 'Order created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
