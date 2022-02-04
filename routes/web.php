<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Services\ClickUp\ClickUpApiWrapper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $clickUpApi = new ClickUpApiWrapper;

    $user = User::findOrFail(1);


    $clickUpApi->getTeams($user->clickup_api_token);

});
