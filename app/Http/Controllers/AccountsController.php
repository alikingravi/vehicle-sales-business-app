<?php

namespace App\Http\Controllers;

use App\Helpers\AccountsHelper;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Calculates user accounts info when sales are completed
     *
     * @param AccountsHelper $accountsHelper
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccounts(AccountsHelper $accountsHelper, $userId)
    {
        $accounts = $accountsHelper->calculateAccounts($userId);

        if (!$accounts) {
            return response()->json([
                'status' => 404,
                'message' => 'No sales have been completed yet.'
            ]);
        }

        $accountUpdate = Account::where('user_id', $userId)->update([
            'user_id' => $userId,
            'total_profit_made' => $accounts['total_profit_made'],
            'total_cash_invested' => $accounts['total_cash_invested'],
            'my_profit' => $accounts['my_profit'],
            'revenue' => $accounts['revenue']
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Account data acquired successfully',
            'data' => $accountUpdate
        ]);
    }
}
