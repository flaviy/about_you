<?php

namespace AboutYou\Service;

use AboutYou\Entity\Category;

/**
 * This class is an (unfinished) example implementation of an unordered product service.
 */
class SizeOrderedProductService implements ProductServiceInterface
{

    /**
     * Maps from category name to the id for the category service.
     *  
     * @var array
     */
    private $categoryNameToIdMapping = [
        'Clothes' => 17325
    ];

    /** @var CategoryService $categoryService */
    protected $categoryService;

    public function __construct(
        CategoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @inheritdoc
     */
    public function getProductsForCategory($categoryName)
    {
        if (!isset($this->categoryNameToIdMapping[$categoryName]))
        {
            throw new \InvalidArgumentException(sprintf('Given category name [%s] is not mapped.', $categoryName));
        }
        $categoryId = $this->categoryNameToIdMapping[$categoryName];
        /** @var Category $category */
        $category = $this->categoryService->getCategory($categoryId);
        $products =  ($category && $category->products)?$category->products:[];
        $result = [];
        if($products){
            foreach ($products as $product) {
                if(!$product->variants){
                    continue;
                }
                foreach ($product->variants as $variant) {
                    $result[$variant->size][] = $product;
                }
            }
        }
        return $result;
    }
}
