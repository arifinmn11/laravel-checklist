<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use App\Models\ChecklistItem;
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

Route::group(['middleware' => 'api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::prefix('checklist')->group(function () {
        Route::get('/', [ChecklistController::class, 'getAll']);
        Route::post('/', [ChecklistController::class, 'add']);
        Route::delete('/{id}', [ChecklistController::class, 'delete']);


        Route::get('/{id}/item', [ChecklistItemController::class, 'getAllByChecklistId']);
        Route::post('/{id}/item', [ChecklistItemController::class, 'add']);
        Route::get('/checklist/{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'getAllByCheckIdItemId']);

    });

    
});
