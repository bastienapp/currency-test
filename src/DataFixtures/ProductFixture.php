<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    const PRODUCTS = [
        [
            'name' => 'Test 1',
            'price' => 2.48,
        ],
        [
            'name' => 'Test 2',
            'price' => 6.24,
        ],
        [
            'name' => 'Test 3',
            'price' => 1.47,
        ],
        [
            'name' => 'Test 4',
            'price' => 12.77,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $key => $productInfos) {
            $product = new Product();
            $product->setName($productInfos['name']);
            $product->setPrice($productInfos['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
