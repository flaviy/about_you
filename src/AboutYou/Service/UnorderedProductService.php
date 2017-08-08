<?php

namespace AboutYou\Service;
use AboutYou\Entity\Category;

/**
 * Implementation of ProductServiceInterface
 * Returns unordered list of products by category
 */
class UnorderedProductService implements ProductServiceInterface
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
        return ($category && $category->products)?$category->products:[];
    }
}
