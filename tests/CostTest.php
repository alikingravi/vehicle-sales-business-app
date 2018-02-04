<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 31/01/2018
 * Time: 19:39
 */
class CostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCostIsCreated()
    {
        $this->post('api/cost/create/1', [
            'car_valet' => 55,
            'mot' => 35,
            'windscreen' => 0,
            'dents_scratches' => 150,
            'oil_filter' => 0,
            'fuel_topup' => 10,
            'tyres' => 0,
            'timing_chain' => 0,
            'vat' => 250,
            'advertisement' => 60,
            'other_costs' => 50,
        ])
        ->seeJson([
            "message" => "Costs have been added successfully",
        ]);

        $this->seeInDatabase(
            'costs',
            [
                'fuel_topup' => 10,
            ]
        );
    }

    public function testGetVehicleCost()
    {
        $this->post('api/cost/create/1', [
            'car_valet' => 55,
            'mot' => 35,
            'windscreen' => 0,
            'dents_scratches' => 150,
            'oil_filter' => 0,
            'fuel_topup' => 10,
            'tyres' => 0,
            'timing_chain' => 0,
            'vat' => 250,
            'advertisement' => 60,
            'other_costs' => 50,
        ]);

        $this->get('api/cost/get/1')
            ->seeJson([
                "message" => "All costs have been retrieved from the DB",
            ]);
    }

    public function testGetNonExistentVehicleCost()
    {
        $this->post('api/cost/create/1', [
            'car_valet' => 55,
            'mot' => 35,
            'windscreen' => 0,
            'dents_scratches' => 150,
            'oil_filter' => 0,
            'fuel_topup' => 10,
            'tyres' => 0,
            'timing_chain' => 0,
            'vat' => 250,
            'advertisement' => 60,
            'other_costs' => 50,
        ]);

        $this->seeInDatabase(
            'costs',
            [
                'vehicle_id' => 1,
            ]
        );

        $this->notSeeInDatabase(
            'costs',
            [
                'vehicle_id' => 2,
            ]
        );

        $this->get('api/cost/get/2')
            ->seeJson([
                "message" => "No costs were found",
            ]);
    }

    public function testCostIsUpdated()
    {
        $this->post('api/cost/create/1', [
            'car_valet' => 55,
            'mot' => 35,
            'windscreen' => 0,
            'dents_scratches' => 150,
            'oil_filter' => 0,
            'fuel_topup' => 10,
            'tyres' => 0,
            'timing_chain' => 0,
            'vat' => 250,
            'advertisement' => 60,
            'other_costs' => 50,
        ]);

        $this->seeInDatabase(
            'costs',
            [
                'oil_filter' => 0,
            ]
        );

        $this->post('api/cost/update/1', [
            'car_valet' => 55,
            'mot' => 35,
            'windscreen' => 42,
            'dents_scratches' => 150,
            'oil_filter' => 23.55,
            'fuel_topup' => 10,
            'tyres' => 20,
            'timing_chain' => 33.12,
            'vat' => 250,
            'advertisement' => 60,
            'other_costs' => 50,
        ])
            ->seeJson([
                "message" => "Costs have been updated successfully",
            ]);

        $this->seeInDatabase(
            'costs',
            [
                'oil_filter' => 23.55,
            ]
        );
    }
}