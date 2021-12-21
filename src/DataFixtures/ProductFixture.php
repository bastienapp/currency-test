<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Service\FakerService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    const MAX_PRODUCTS = 5;

    private FakerService $fakerService;

    public function __construct(FakerService $fakerService)
    {
        $this->fakerService = $fakerService;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::MAX_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName($this->fakerService->getRandomName());
            $product->setPrice($this->fakerService->getRandomPrice());
            $manager->persist($product);
        }

        $manager->flush();
    }
}
