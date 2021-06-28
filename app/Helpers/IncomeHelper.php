<?php


namespace App\Helpers;


use App\Models\Ledger;

class IncomeHelper
{
    public static function saveIncome(string $category, int $amount, string $desciption)
    {
        Ledger::create(
            [
                'date' => date('Y-m-d'),
                'category' => $category,
                'description' => $desciption,
                'amount' => $amount,
            ]);
    }
}
