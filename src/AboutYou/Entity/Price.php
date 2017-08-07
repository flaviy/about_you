<?php

namespace AboutYou\Entity;

/**
 * Class Price
 * @package AboutYou\Entity
 */
class Price extends AbstractEntity
{
    protected $relations = [
        'belongsTo' => [
            'class' => Variant::class,
            'propertyName' => 'variant'
        ]
    ];

    /**
     * Current price.
     *
     * @var int
     */
    public $current;

    /**
     * Old price.
     *
     * @var int|null
     */
    public $old;

    /**
     * Defines if the price is sale.
     *
     * @var bool
     */
    public $isSale;

    /**
     * Variant that the price belongs to.
     *
     * @var \AboutYou\Entity\Variant
     */
    public $variant;
}
