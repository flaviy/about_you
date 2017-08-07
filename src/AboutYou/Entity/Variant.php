<?php

namespace AboutYou\Entity;

use AboutYou\Entity\Validators\VariantEntityValidator;

/**
 * Class Variant
 * @package AboutYou\Entity
 */
class Variant extends  AbstractEntity
{

    protected $relations = [
        'belongsTo' => [
            'class' => Product::class,
            'propertyName' => 'product'
        ],
        'hasOne' => [
            [
                'class' => Price::class,
                'propertyName' => 'price'
            ]
        ]
    ];

    protected $validator = VariantEntityValidator::class;


    /**
     * Id of the Variant.
     *
     * @var int
     */
    public $id;

    /**
     * Defines if the Variant is default for the product.
     *
     * @var bool
     */
    public $isDefault;

    /**
     * Defines if the Variant is Available or not.
     * 
     * @var bool
     */
    public $isAvailable;

    /**
     * Number of available items in stock.
     *
     * @var int
     */
    public $quantity;

    /**
     * Size of the Variant.
     *
     * @var mixed
     */
    public $size;

    /**
     * Variant price.
     * 
     * @var \AboutYou\Entity\Price
     */
    public $price;

    /**
     * Product that the Variant belongs to.
     *
     * @var \AboutYou\Entity\Product
     */
    public $product;
}
