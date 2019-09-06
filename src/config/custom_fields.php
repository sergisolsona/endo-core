<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 06/09/2019
 * Time: 11:25
 */

use Endo\EndoCore\App\CustomFields\BooleanRuleParam;
use Endo\EndoCore\App\CustomFields\ChoicesParam;
use Endo\EndoCore\App\CustomFields\DefaultValueParam;
use Endo\EndoCore\App\CustomFields\HeightParam;
use Endo\EndoCore\App\CustomFields\InstructionsParam;
use Endo\EndoCore\App\CustomFields\MaxLengthParam;
use Endo\EndoCore\App\CustomFields\MinLengthParam;
use Endo\EndoCore\App\CustomFields\MultipleParam;
use Endo\EndoCore\App\CustomFields\NumRowsParam;
use Endo\EndoCore\App\CustomFields\PlaceholderParam;
use Endo\EndoCore\App\CustomFields\PostObjectParam;
use Endo\EndoCore\App\CustomFields\RequiredParam;
use Endo\EndoCore\App\CustomFields\TextType;
use Endo\EndoCore\App\CustomFields\WidthParam;
use Endo\EndoCore\App\CustomFields\WysiwygParam;

return [
    'text' => [
        'name' => 'Text',
        'params' => [
            RequiredParam::class,
            PlaceholderParam::class,
            MaxLengthParam::class,
            MinLengthParam::class,
            TextType::class
        ]
    ],

    'textarea' => [
        'name' => 'Textarea',
        'params' => [
            RequiredParam::class,
            PlaceholderParam::class,
            MaxLengthParam::class,
            MinLengthParam::class,
            NumRowsParam::class,
            WysiwygParam::class,
        ]
    ],

    'date' => [
        'name' => 'Date',
        'params' => [
            RequiredParam::class,
        ]
    ],

    'number' => [
        'name' => 'Number',
        'params' => [
            RequiredParam::class,
            DefaultValueParam::class,
            MaxLengthParam::class,
            MinLengthParam::class,
        ]
    ],

    'media' => [
        'name' => 'Media',
        'params' => [
            RequiredParam::class,
            HeightParam::class,
            WidthParam::class,
        ]
    ],

    'form' => [
        'name' => 'Form',
        'params' => [
            RequiredParam::class,
        ]
    ],

    'gallery' => [
        'name' => 'Gallery',
        'params' => [
            RequiredParam::class,
            HeightParam::class,
            WidthParam::class,
            InstructionsParam::class,
            MinLengthParam::class,
        ]
    ],

    'selection' => [
        'name' => 'Selection',
        'params' => [
            RequiredParam::class,
            MaxLengthParam::class,
            MinLengthParam::class,
            InstructionsParam::class,
            PostObjectParam::class,
            MultipleParam::class,
            ChoicesParam::class,
        ]
    ],

    'gmaps' => [
        'name' => 'Google Maps',
        'params' => [
            RequiredParam::class,
        ]
    ],

    'boolean' => [
        'name' => 'Boolean',
        'params' => [
            RequiredParam::class,
            BooleanRuleParam::class,
        ]
    ],

    'repeater' => [
        'name' => 'Repeater',
        'params' => [
            MaxLengthParam::class,
            MinLengthParam::class,
            InstructionsParam::class,
        ]
    ],
];