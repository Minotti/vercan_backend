<?php

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    (new \App\Modules\User\Services\UserService())->find(auth()->id());
});
