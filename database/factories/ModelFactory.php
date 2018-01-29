<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// User Factory
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password
    ];
});

// Vehicle Factory
$factory->define(App\Models\Vehicle::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'registration' => $faker->postcode,
        'manufacturer' => $faker->company,
        'model' => $faker->randomNumber(4),
        'colour' => $faker->colorName,
        'mileage' => $faker->randomNumber(5),
        'engine_size' => $faker->randomNumber(4),
        'fuel_type' => $faker->userName,
        'gear' => $faker->text(10),
        'year' => $faker->dateTimeThisYear
    ];
});

// Cost Factory
$factory->define(App\Models\Cost::class, function (Faker\Generator $faker) {
    return [
        'vehicle_id' => $faker->numberBetween(1, 1000),
        'car_valet' => $faker->randomFloat(2, 4, 6),
        'mot' => $faker->randomFloat(2, 4, 6),
        'windscreen' => $faker->randomFloat(2, 4, 6),
        'dents_scratches' => $faker->randomFloat(2, 4, 6),
        'oil_filter' => $faker->randomFloat(2, 4, 6),
        'fuel_topup' => $faker->randomFloat(2, 4, 6),
        'tyres' => $faker->randomFloat(2, 4, 6),
        'timing_chain' => $faker->randomFloat(2, 4, 6),
        'vat' => $faker->randomFloat(2, 4, 6),
        'advertisement' => $faker->randomFloat(2, 4, 6),
        'other_costs' => $faker->randomFloat(2, 4, 6)
    ];
});

// Sale Factory
$factory->define(App\Models\Sale::class, function (Faker\Generator $faker) {
    return [
        'vehicle_id' => $faker->numberBetween(1, 1000),
        'buying_price' => $faker->randomFloat(2, 4, 6),
        'total_vehicle_cost' => $faker->randomFloat(2, 4, 6),
        'list_price' => $faker->randomFloat(2, 4, 6),
        'selling_price' => $faker->randomFloat(2, 4, 6),
        'profit' => $faker->randomFloat(2, 4, 6),
        'additional_notes' => $faker->text(50),
        'sale_complete' => 0
    ];
});

// Account Factory
$factory->define(App\Models\Account::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'total_profit_made' => $faker->randomFloat(2, 4, 6),
        'total_cash_invested' => $faker->randomFloat(2, 4, 6),
        'my_profit' => $faker->randomFloat(2, 4, 6),
        'revenue' => $faker->randomFloat(2, 4, 6)
    ];
});