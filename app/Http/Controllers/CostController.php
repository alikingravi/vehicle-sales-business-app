<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function addCosts(Request $request, $vehicleId)
    {
        $cost = Cost::create([
            'vehicle_id' => $vehicleId,
            'car_valet' => $request->input('car_valet'),
            'mot' => $request->input('mot'),
            'windscreen' => $request->input('windscreen'),
            'dents_scratches' => $request->input('dents_scratches'),
            'oil_filter' => $request->input('oil_filter'),
            'fuel_topup' => $request->input('fuel_topup'),
            'tyres' => $request->input('tyres'),
            'timing_chain' => $request->input('timing_chain'),
            'vat' => $request->input('vat'),
            'advertisement' => $request->input('advertisement'),
            'other_costs' => $request->input('other_costs')
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Costs have been added successfully',
            'data' => $cost
        ]);
    }
}
