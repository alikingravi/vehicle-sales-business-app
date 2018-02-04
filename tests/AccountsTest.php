<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 31/01/2018
 * Time: 20:37
 */
class AccountsTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAccounts()
    {
        // Create a vehicle
        $this->post('api/vehicles/create/1', [
            'registration' => 'DF06NZY',
            'manufacturer' => 'BMW',
            'model' => '318i',
            'colour' => 'Black',
            'mileage' => 93000,
            'engine_size' => 2.0,
            'fuel_type' => 'petrol',
            'gear' => 'manual',
            'year' => '2006',
        ])
            ->seeJson([
                'registration' => 'DF06NZY'
            ]);

        // Create vehicle cost
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

        // Create a sale
        $this->post('api/sale/create/1/1', [
            'buying_price' => 1800
        ])
            ->seeJson([
                'buying_price' => 1800,
            ]);

        // Update the sale
        $this->post('api/sale/update/1', [
            'buying_price' => 1800,
            'list_price' => 3800,
            'selling_price' => 3650,
            'additional_notes' => "All good",
            'sale_complete' => 1,
        ])
            ->seeJson([
                "message" => "Sale has been updated successfully",
            ]);

        // Calculate and get accounts info
        $this->get('api/accounts/calculate/1')
            ->seeJson([
                "message" => "Account data acquired successfully",
            ]);
    }
}