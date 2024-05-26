<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DailyReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => '/v1'], function()
    {
        Route::group(['middleware' => 'api'], function () {
            Route::get('/daily-report/{record_date?}', [CalendarController::class, 'show']);
            Route::post('/daily-report', [DailyReportController::class, 'store']);
        });
    }
);
