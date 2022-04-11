<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\IngredientProduct;
use App\Models\Product;
use Foodics\Exceptions\AmountInStockIsNotEnough;
use Foodics\Exceptions\IncorrectOrderTotal;
use Foodics\Order;
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
        $orderedProducts = collect($request->validated()['products'])
            ->mapWithKeys(fn($product) => [$product['id'] => $product['quantity']]);
        
        // TODO: read total price from frontend
        // TODO: separate this query to a repository
        $products = Product::select([
            'id',
            // 'price'
        ])->whereIn('id', $orderedProducts->keys())
        ->with('ingredients')
        ->get()
        ->toArray();
        
        try {
            $order = new Order(0);
            foreach($products as $product) {
                $order->addProductToOrder(
                    $product,
                    $orderedProducts[$product['id']]
                );
            }
            $order->checkout();
        } catch (IncorrectOrderTotal $e) {
            return response()->json(['error' => 'Incorrect order price'], 400);
        } catch (AmountInStockIsNotEnough $q) {
            return response()->json(['error' => 'Amount in stock is not enough'], 400);
        }

        foreach ($order->stockChecker->getIngredientsNeedToReFill() as $ingredient) {
            // TODO: queue notification
        }

        // TODO: Persist order
        // TODO: Update stock
        // TODO: Add all in a transaction
        
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
