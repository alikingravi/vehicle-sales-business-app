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

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json($vehicles, 200);
    }

    public function createVehicle(Request $request)
    {

        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle);
    }
}