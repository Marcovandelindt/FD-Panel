<?php

use App\Models\User;
use App\Models\ClickupTeam;
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
    $team = ClickupTeam::findOrFail(env('CLICKUP_TEAM_ID'));

    $clickUpApi->getSpaces($user->clickup_api_token, $team->team_id);

});

Route::get('/clickup/import', [App\Http\Controllers\ClickUp\ImportClickUpDataController::class, 'import'])->name('clickup.import');
