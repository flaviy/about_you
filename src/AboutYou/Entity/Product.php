<?php

namespace AboutYou\Entity;

use AboutYou\Helper\ProductRowDataModifier;

/**
 * Class Product
 * @package AboutYou\Entity
 */
class Product extends AbstractEntity
{

    protected $relations = [
        'hasMany' => [
            [
                'class' => Variant::class,
                'propertyName' => 'variants'
            ]
        ]
    ];

    protected $rowDataModifier = ProductRowDataModifier::class;

    /**
     * Id of the Product.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the Product.
     *
     * @var string
     */
    public $name;

    /**
     * Description of the Product.
     * 
     * @var string
     */
    public $description;

    /**
     * Unsorted list of Variants with their corresponding prices.
     * 
     * @var Variant[]
     */
    public $variants = [];
}
