<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    const MAX_PRODUCTS = 5;

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::MAX_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName("Product $i");
            $value = rand(100, 10000) / 100;
            $product->setPrice($value);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
