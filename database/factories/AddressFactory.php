<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id" => rand(),
            "address_street" => $this->faker->streetAddress(),
            "address_street_extra" => $this->faker->streetAddress(),
            "address_city" => $this->faker->city(),
            "address_zip" => "12315",
            "address_country" => "Sweden",
            "address_state" => "Stockholm",
            "label" => "third address",
        ];
    }

    
}
