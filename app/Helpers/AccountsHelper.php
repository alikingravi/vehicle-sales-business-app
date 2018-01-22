<?php
/**
 * Created by PhpStorm.
 * User: alikingravi
 * Date: 22/01/2018
 * Time: 12:50
 */

namespace App\Helpers;

use App\Models\Account;
use App\Models\Sale;

class AccountsHelper
{
    public function updateAccounts($userId, $totalProfit, $totalCashInvested, $sellingPrice)
    {
        $account = Account::where('user_id', $userId)->first();

        $totalProfitMade = bcadd($account->total_profit_made, $totalProfit, 2);

        $account->total_profit_made = $totalProfitMade;

        $account->total_cash_invested = bcadd($account->total_cash_invested, $totalCashInvested, 2);

        $account->my_profit = bcdiv($totalProfitMade, 2, 2);

        $account->revenue = bcadd($account->revenue, $sellingPrice, 2);

        $account->save();

        return response()->json([
            'status' => 200,
            'message' => 'User Accounts have been updated'
        ]);
    }

    public function calculateAccounts($userId)
    {
        $sales = Sale::where('user_id', $userId);

        $info = [];
        $saleData = [];
        foreach ($sales as $sale) {
            $info[] = $sale;
        }
        dd($info);
    }
}