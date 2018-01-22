<?php

namespace App\Http\Controllers;

use App\Helpers\AccountsHelper;
use App\Helpers\CostHelper;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();

        if (count($sales) === 0) {
            return response()->json([
                'status' => 404,
                'message' => 'No sales were found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'All sales have been retrieved from the DB',
            'data' => $sales
        ]);
    }

    public function createSale(Request $request, CostHelper $costHelper, AccountsHelper $accountsHelper, $vehicleId)
    {
        $totalVehicleCost = $costHelper->getTotalVehicleCost($vehicleId);

        $totalCost = bcadd($request->input('buying_price'), $totalVehicleCost, 2);

        $profit = bcsub($request->input('selling_price'), $totalCost, 2);

        $sale = Sale::create([
            'vehicle_id' => $vehicleId,
            'buying_price' => $request->input('buying_price'),
            'total_vehicle_cost' => $totalVehicleCost,
            'list_price' => $request->input('list_price'),
            'selling_price' => $request->input('selling_price'),
            'profit' => $profit,
            'additional_notes' => $request->input('additional_notes'),
            'sale_complete' => $request->input('sale_complete')
        ]);

        $accounts = $accountsHelper->updateAccounts(1, $profit, $totalCost, $request->input('selling_price'));

        return response()->json([
            'status' => 200,
            'message' => 'Sale has been created successfully',
            'data' => $sale,
            'accounts' => $accounts
        ]);
    }
}
