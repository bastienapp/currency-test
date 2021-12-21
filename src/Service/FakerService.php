<?php

namespace App\Service;

use Faker\Factory;
use Faker\Generator;

class FakerService
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function getRandomName()
    {
        return ucfirst($this->faker->word());
    }

    public function getRandomPrice()
    {
        return $this->faker->randomFloat(2, 1, 100);
    }
}
