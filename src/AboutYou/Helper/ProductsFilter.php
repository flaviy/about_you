<?php

namespace AboutYou\Helper;
/**
 * Class ProductsFilter
 * @package AboutYou\Helper
 */
class ProductsFilter
{
    protected $productService;

    /**
     * ProductsFilter constructor.
     * @param \AboutYou\Service\ProductServiceInterface $productService
     */
    public function __construct(
        \AboutYou\Service\ProductServiceInterface $productService
    )
    {
        $this->productService = $productService;
    }

    /**
     * @param $categoryName
     * @param $size
     * @return \AboutYou\Entity\Product|array
     */
    public function filterProducts($categoryName, $size)
    {
        $products =  $this->productService->getProductsForCategory($categoryName);
        if(isset($products[$size])){
            return $products[$size];
        }
        return [];
    }
}