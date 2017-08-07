<?php

namespace AboutYou\Helper;

/**
 * Class ProductsGetter
 * @package AboutYou\Helper
 */
class ProductsGetter
{
    protected $productService;

    public function __construct(
        \AboutYou\Service\ProductServiceInterface $productService
    )
    {
        $this->productService = $productService;
    }

    public function getProducts($categoryName)
    {
        return $this->productService->getProductsForCategory($categoryName);
    }

}