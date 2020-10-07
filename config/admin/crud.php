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
            'contentClass' => 'col-12',

            'responsiveTable' => true,

            'persistentTable' => false,

            'searchableTable' => false,

            'persistentTableDuration' => false,

            'defaultPageLength' => 25,

            'pageLengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'backpack::crud.all']],

            'actionsColumnPriority' => 1,

            'resetButton' => false,
        ],
    ]
];