<?php

namespace AboutYou;

use AboutYou\Entity\Category;
use AboutYou\Helper\ProductsFilter;
use AboutYou\Helper\ProductsGetter;
use AboutYou\Service\CategoryService;

/**
 * Class Application
 * @package AboutYou
 */
class Application {

    protected $dice;

    protected $rules = [];

    protected $productsGetter;

    protected $productsFilter;

    protected $categoryService;

    /**
     * Application constructor.
     * @param ProductsFilter $productsFilter
     * @param ProductsGetter $productsGetter
     * @param CategoryService $categoryService
     */
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

        echo "<pre>";
        var_dump($products);
        echo "</pre>";

        $filteredProducts = $this->productsFilter->filterProducts('Clothes', '34');
        echo "<pre>";
        var_dump($filteredProducts);
        echo "</pre>";

    }
}