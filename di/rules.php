<?php

return [

    AboutYou\Helper\ProductsFilter::class =>
        [
            'substitutions' =>
                [
                    AboutYou\Service\ProductServiceInterface::class => [
                        'instance' => AboutYou\Service\SizeOrderedProductService::class
                    ]
                ]
        ],

    AboutYou\Helper\ProductsGetter::class =>
        [
            'substitutions' =>
                [
                    AboutYou\Service\ProductServiceInterface::class => [
                        'instance' => AboutYou\Service\UnorderedProductService::class
                    ]
                ]
        ],

    AboutYou\DataSource\DataSourceInterface::class =>
        [
            'instanceOf' => AboutYou\DataSource\Json::class
        ]
];

