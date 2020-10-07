<?php

Route::group([
    'prefix'     => config('admin.base.route_prefix', 'admin'),
    'middleware' => ['web', 'auth.admin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

}); // this should be the absolute last line of this file