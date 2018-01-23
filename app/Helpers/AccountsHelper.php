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
    /**
     * Calculates user accounts data
     *
     * @param $userId
     * @return array|bool
     */
    public function calculateAccounts($userId)
    {
        $totalProfitMade = '';
        $totalCashInvested = '';
        $revenue = '';
        $accounts = [];

        $sales = Sale::where('user_id', $userId)
            ->where('sale_complete', 1)
            ->get();

        if (count($sales) === 0) {
            return false;
        }

        $profit = [];
        $buyingPrice = [];
        foreach ($sales as $sale) {
            $profit[] = bcmul($sale->profit, 100, 0);
            $buyingPrice[] = bcmul($sale->buying_price, 100, 0);
            $totalVehicleCost[] = bcmul($sale->total_vehicle_cost, 100, 0);
            $sellingPrice[] = bcmul($sale->selling_price, 100, 0);
        }
        $totalProfitMade = bcdiv(array_sum($profit), 100, 2);
        $revenue = bcdiv(array_sum($sellingPrice), 100, 2);

        $total1 = bcdiv(array_sum($buyingPrice), 100, 2);
        $total2 = bcdiv(array_sum($totalVehicleCost), 100, 2);

        $totalInvestment = bcadd($total1, $total2, 2);

        $accounts = [
            'total_profit_made' => $totalProfitMade,
            'total_cash_invested' => $totalInvestment,
            'my_profit' => bcdiv($totalProfitMade, 2, 2),
            'revenue' => $revenue
        ];

        return $accounts;
    }
}
