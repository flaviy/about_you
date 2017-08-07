<?php

namespace AboutYou\Entity;

use AboutYou\Helper\CategoryRowDataModifier;

/**
 * Class Category
 * @package AboutYou\Entity
 */
class Category extends AbstractEntity
{

    protected $relations = [
        'hasMany' => [
            [
                'class' => Product::class,
                'propertyName' => 'products'
            ]
        ]
    ];

    protected $rowDataModifier = CategoryRowDataModifier::class;

    /**
     * Id of the Category.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the Category.
     *
     * @var string
     */
    public $name;

    /**
     * List of Products that belong to a Category.
     *
     * @var \AboutYou\Entity\Product[]
     */
    public $products = [];
}
