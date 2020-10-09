<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TESSA CRUD
    |--------------------------------------------------------------------------
    |
    |
    */

    'operations' => [
        'list' => [
            'contentClass' => 'w-full',

            'responsiveTable' => true,

            'persistentTable' => false,

            'searchableTable' => false,

            'persistentTableDuration' => false,

            'defaultPageLength' => 25,

            'pageLengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'backpack::crud.all']],

            'actionsColumnPriority' => 1,

            'resetButton' => false,
        ],

        'create' => [
            'contentClass' => 'w-full',

            'tabsType' => 'horizontal', //options: horizontal, vertical

            'groupedErrors' => true,
            'inlineErrors'  => true,

            'autoFocusOnFirstField' => true,

            'defaultSaveAction' => 'save_and_back',

            'showSaveActionChange' => true, //options: true, false

            'showCancelButton' => true,

            'saveAllInputsExcept' => false,
        ],
    ]
];