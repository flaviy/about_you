<?php

namespace AboutYou\Helper;

/**
 * Class ProductsGetter
 * @package AboutYou\Helper
 */
class ProductsGetter
{
    protected $productService;

    /**
     * ProductsGetter constructor.
     * @param \AboutYou\Service\ProductServiceInterface $productService
     */
    public function __construct(
        //Preference is defined in di/rules.php
        \AboutYou\Service\ProductServiceInterface $productService
    )
    {
        $this->productService = $productService;
    }

    /**
     * @param $categoryName
     * @return \AboutYou\Entity\Product[]
     */
    public function getProducts($categoryName)
    {
        return $this->productService->getProductsForCategory($categoryName);
    }

}