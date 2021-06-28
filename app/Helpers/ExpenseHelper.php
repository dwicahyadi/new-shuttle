<?php


namespace App\Helpers;


use App\Models\Ledger;

class ExpenseHelper
{
    public static function saveExpense(string $category, int $amount, string $desciption)
    {
        Ledger::create(
            [
                'date' => date('Y-m-d'),
                'category' => $category,
                'description' => $desciption,
                'amount' => $amount*-1,
            ]);
    }
}
