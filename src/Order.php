<?php

namespace Foodics;

use Foodics\Exceptions\IncorrectOrderTotal;

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
        $this->products[] = $product;
        $this->stockChecker->addIngredients($product['ingredients'], $quantity);
        // $this->total += $product['price'] * $quantity;
    }

    public function checkout()
    {
        $this->verifyTotal();
        // Call to orders repository to save order
        // Call to ingredient repository to update stock
    }

    private function verifyTotal()
    {
        if ($this->expectedTotal != $this->actualTotal) {
            throw new IncorrectOrderTotal($this->actualTotal, $this->expectedTotal);
        }
    }
}