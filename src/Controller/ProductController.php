<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/{id}/{currency}", name="product_show")
     */
    public function show(
        Product $product,
        string $currency = 'EUR',
        CurrencyService $currencyService
    ): Response {
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'currency' => $currency,
            'price' => $currencyService->convertPrice($product->getPrice(), $currency),
            'country' => $currencyService->getLocale($currency)
        ]);
    }
}
