<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 31/01/2018
 * Time: 20:00
 */
class SaleTest extends TestCase
{
    use DatabaseMigrations;

    public function testSaleIsCreated()
    {
        $this->post('api/sale/create/1/1', [
            'buying_price' => 1800
        ])
            ->seeJson([
                'buying_price' => 1800,
            ]);

        $this->seeInDatabase(
            'sales',
            [
                'buying_price' => 1800,
            ]
        );
    }

    public function testGetSale()
    {
        $this->post('api/sale/create/1/1', [
            'buying_price' => 1800
        ])
            ->seeJson([
                'buying_price' => 1800,
            ]);

        $this->get('api/sale/get/1')
            ->seeJson([
                "message" => "All sales have been retrieved from the DB",
            ]);
    }

    public function testUpdateSale()
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
        ]);

        $this->seeInDatabase(
            'vehicles',
            [
                'id' => 1,
                'registration' => 'DF06NZY',
            ]
        );

        // Create a cost
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

        // Create a sale
        $this->post('api/sale/create/1/1', [
            'buying_price' => 1800
        ]);

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

        $this->seeInDatabase(
            'sales',
            [
                'sale_complete' => 1,
            ]
        );
    }
}