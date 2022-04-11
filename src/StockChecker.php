<?php

namespace Foodics;

use Foodics\Exceptions\AmountInStockIsNotEnough;

class StockChecker
{
    private $ingredients;
    private $ingredientsNeedToReFill;

    public function __construct()
    {
        $this->ingredients = [];
        $this->ingredientsNeedToReFill = [];
    }

    public function addIngredients(array $ingredients, int $quantity)
    {
        foreach ($ingredients as $ingredient) {
            $this->addIngredient($ingredient, $quantity);
        }
    }

    public function getIngredientsNeedToReFill()
    {
        return $this->ingredientsNeedToReFill;
    }

    private function addIngredient($ingredient, int $quantity)
    {
        if (!isset($this->ingredients[$ingredient['id']])) {
            $this->ingredients[$ingredient['id']] = [
                'needed_amount' => 0,
            ];
        }

        $this->ingredients[$ingredient['id']]['needed_amount'] += $ingredient['pivot']['needed_amount'] * $quantity;


        $remainingAmount = $ingredient['current_amount'] - $this->ingredients[$ingredient['id']]['needed_amount'];

        if (!$ingredient['amount_alert_sent'] && $remainingAmount <= $ingredient['inserted_amount'] * 0.5) {
            $this->ingredientsNeedToReFill[] = $ingredient;
        }

        if ($remainingAmount < 0) {
            throw new AmountInStockIsNotEnough();
        }
    }
}