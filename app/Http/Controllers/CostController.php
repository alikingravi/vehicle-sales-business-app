<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    /**
     * CostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets the costs associated with the vehicle
     *
     * @param $vehicleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($vehicleId)
    {
        $cost = Cost::where('vehicle_id', $vehicleId)
            ->with('vehicle')
            ->get();

        if (count($cost) === 0) {
            return response()->json([
                'status' => 404,
                'message' => 'No costs were found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'All costs have been retrieved from the DB',
            'data' => $cost
        ]);
    }

    /**
     * Adds costs associated with a vehicle
     *
     * @param Request $request
     * @param $vehicleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCosts(Request $request, $vehicleId)
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

    /**
     * Updates the costs
     *
     * @param Request $request
     * @param $vehicleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCosts(Request $request, $vehicleId)
    {
        $cost = Cost::where('vehicle_id', $vehicleId)
            ->update([
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
            'message' => 'Costs have been updated successfully',
            'data' => $cost
        ]);
    }
}
