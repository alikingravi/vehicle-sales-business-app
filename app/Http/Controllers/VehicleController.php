<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 25/12/2017
 * Time: 22:40
 */

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Gets all vehicles added by the user
     *
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($userId)
    {
        $vehicles = Vehicle::where('user_id', $userId)->get();

        if (count($vehicles) === 0) {
            return response()->json([
                'status' => 404,
                'message' => 'No vehicles were found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'All vehicles have been retrieved from the DB',
            'data' => $vehicles
        ]);
    }

    /**
     * Creates a new vehicle
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVehicle(Request $request, $userId)
    {
        $vehicle = Vehicle::create([
            'user_id' => $userId,
            'registration' => $request->input('registration'),
            'manufacturer' => $request->input('manufacturer'),
            'model' => $request->input('model'),
            'colour' => $request->input('colour'),
            'mileage' => $request->input('mileage'),
            'engine_size' => $request->input('engine_size'),
            'fuel_type' => $request->input('fuel_type'),
            'gear' => $request->input('gear'),
            'year' => $request->input('year')
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Vehicle has been created successfully',
            'data' => $vehicle
        ]);
    }

    /**
     * Updates vehicle information
     *
     * @param Request $request
     * @param $userId
     * @param $vehicleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVehicle(Request $request, $userId, $vehicleId)
    {
        $vehicle = Vehicle::where('user_id', $userId)
            ->where('id', $vehicleId)
            ->update([
                'registration' => $request->input('registration'),
                'manufacturer' => $request->input('manufacturer'),
                'model' => $request->input('model'),
                'colour' => $request->input('colour'),
                'mileage' => $request->input('mileage'),
                'engine_size' => $request->input('engine_size'),
                'fuel_type' => $request->input('fuel_type'),
                'gear' => $request->input('gear'),
                'year' => $request->input('year')
            ]);

        return response()->json([
            'status' => 200,
            'message' => 'Vehicle information has been updated successfully',
            'data' => $vehicle
        ]);
    }
}
