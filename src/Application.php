<?php

namespace AboutYou;

use AboutYou\Entity\Category;
use AboutYou\Helper\ProductsFilter;
use AboutYou\Helper\ProductsGetter;
use AboutYou\Service\CategoryService;

class Application {

    protected $dice;

    protected $rules = [];

    protected $productsGetter;

    protected $productsFilter;

    protected $categoryService;

    public function __construct(
        ProductsFilter $productsFilter,
        ProductsGetter $productsGetter,
        CategoryService $categoryService
    )
    {
        $this->productsGetter = $productsGetter;
        $this->productsFilter = $productsFilter;
        $this->categoryService = $categoryService;
    }

    public function run()
    {

        $products =  $this->productsGetter->getProducts('Clothes');


        $filteredProducts = $this->productsFilter->filterProducts('Clothes', '34');
        echo "<pre>";
        var_dump($filteredProducts);
        echo "</pre>";

    }
}