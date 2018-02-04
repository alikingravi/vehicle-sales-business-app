<?php
/**
 * Created by PhpStorm.
 * User: alikingravi
 * Date: 22/01/2018
 * Time: 12:17
 */

namespace App\Helpers;

use App\Models\Cost;

class CostHelper
{
    /**
     * Returns the total costs associated with a vehicle
     *
     * @param $vehicleId
     * @return string
     */
    public function getTotalVehicleCost($vehicleId)
    {
        // Get all costs of vehicle
        $vehicle = Cost::where('vehicle_id', $vehicleId)->first();

        // Add all individual costs using bcmath functions
        $total1 = bcadd($vehicle->car_valet, $vehicle->mot, 2);
        $total2 = bcadd($vehicle->windscreen, $vehicle->dents_scratches, 2);
        $total3 = bcadd($vehicle->oil_filter, $vehicle->fuel_topup, 2);
        $total4 = bcadd($vehicle->tyres, $vehicle->timing_chain, 2);
        $total5 = bcadd($vehicle->vat, $vehicle->advertisement, 2);

        $total12 = bcadd($total1, $total2, 2);
        $total34 = bcadd($total3, $total4, 2);
        $total1234 = bcadd($total12, $total34, 2);

        $total6 = bcadd($total5, $vehicle->other_costs, 2);

        $totalFinal = bcadd($total1234, $total6, 2);

        return $totalFinal;
    }
}