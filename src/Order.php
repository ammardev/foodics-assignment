<?php

namespace Foodics;

use Foodics\Exceptions\IncorrectOrderTotal;
use App\Models\Order as EloquentOrder;

class Order
{
    public StockChecker $stockChecker;
    private array $products;
    private int $expectedTotal;
    private int $actualTotal;

    public function __construct(int $total)
    {
        $this->expectedTotal = $total;
        $this->actualTotal = 0;
        $this->products = [];
        $this->stockChecker = new StockChecker();
    }

    public function addProductToOrder($product, int $quantity)
    {
        $product['quantity'] = $quantity;
        $this->products[] = $product;
        $this->stockChecker->addIngredients($product['ingredients'], $quantity);
        // $this->total += $product['price'] * $quantity;
    }

    public function checkout()
    {
        $this->verifyTotal();
        $this->persist();
        $this->stockChecker->updateStock();
    }

    private function persist()
    {
        // TODO: Database related code should be separated to a repository to avoid mixing business logic with application Logic

        $attachedProducts = [];
        foreach ($this->products as $product) {
            $attachedProducts[$product['id']] = [
                'quantity' => $product['quantity'],
                // 'price' => $product['price']
            ];
        }

        EloquentOrder::create()
            ->products()->attach($attachedProducts);
    }

    private function verifyTotal()
    {
        if ($this->expectedTotal != $this->actualTotal) {
            throw new IncorrectOrderTotal($this->actualTotal, $this->expectedTotal);
        }
    }
}