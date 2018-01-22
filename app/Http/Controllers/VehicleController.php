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
    public function index()
    {
        $vehicles = Vehicle::all();

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

    public function createVehicle(Request $request)
    {
        $vehicle = Vehicle::create([
            'user_id' => Auth::user()->id,
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
}