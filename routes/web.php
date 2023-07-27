<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrunkController;
use App\Http\Controllers\SenderController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\WellDataController;
use App\Http\Controllers\WellSwitchController;
use App\Http\Controllers\ActionRequiredController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UnderTestingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/', 'index')->name('user-login');

Route::post('/user-login', [AuthController::class, 'user']);

// Admin Login
Route::view('/admin-cp', 'admin.login');

Route::post('/admin-login', [AuthController::class, 'admin']);

// Logingout
Route::get('/logout', [AuthController::class, 'logout']);

// Admin
Route::middleware('isAdmin')->group( function () {
    
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

        Route::resource('areas', AreaController::class)->except(['create', 'edit', 'update']);
        
        // Route::get('/areas', [AreaController::class, 'index']);

        // Route::post('/areas/store', [AreaController::class, 'store']);
        
        // Route::get('/areas/{id}', [AreaController::class, 'show']);

        // Route::post('/areas/delete', [AreaController::class, 'delete']);

        Route::resource('users', UserController::class)->only(['index', 'destroy', 'store']);
        
        // Route::get('/users', [AdminController::class, 'users']);
        
        // Route::post('/add-user', [UserController::class, 'store']);

        // Route::post('/delete-user', [UserController::class, 'delete']);

        Route::resource('trunks', TrunkController::class)->except(['edit', 'update', 'create']);

        // Route::get('/trunks', [AdminController::class, 'users']);

        // Route::post('/add-trunk', [TrunkController::class, 'store']);

        // Route::post('/delete-trunk', [TrunkController::class, 'delete']);

        Route::post('/add-well', [WellController::class, 'store']);

        Route::post('/delete-well', [WellController::class, 'delete'])->name('delete-well');
        

    });

});


// Receiver
Route::middleware('isReceiver')->group( function () {
    
    Route::prefix('receiver')->group(function () {

        Route::get('/dashboard', [ReceiverController::class, 'index'])->name('receiver-dashboard');

        Route::get('/production-header', [WellDataController::class, 'index']);

        Route::get('/my-area', [ReceiverController::class, 'myArea']);

        Route::get('/trunk-wells/{id}', [ReceiverController::class, 'receiverTrunkWells'])->name('receiver-trunk-wells');

        Route::get('/notifications', [NotificationController::class, 'index']);

        Route::get('/notification-seen/{id}', [NotificationController::class, 'markAsSeen']);

        Route::post('/submit-notification', [NotificationController::class, 'submit']);

        Route::get('/wells-under-testing', [UnderTestingController::class, 'index']);

        Route::post('/submit-under-testing', [UnderTestingController::class, 'submit']);

    });
    
});


// Sender
Route::middleware('isSender')->group( function () {

    Route::prefix('sender')->group(function () {

        Route::get('/dashboard', [SenderController::class, 'index'])->name('sender-dashboard');

        Route::get('/areas/{id}', [SenderController::class, 'area']);

        Route::get('/trunk-wells/{id}', [SenderController::class, 'trunkWells'])->name('trunk-wells');

        Route::get('/well-switch', [WellSwitchController::class, 'index']);

        Route::get('/well-switch-single/{well}', [WellSwitchController::class, 'sendWellSwitch']);

        Route::post('/share-well-switch', [WellSwitchController::class, 'store']);

        Route::get('/edit-well-switch/{id}', [WellSwitchController::class, 'edit']);

        Route::post('/update-well-switch/{id}', [WellSwitchController::class, 'update']);

        Route::get('/well-data/{well?}/{wellData_id?}', [WellDataController::class, 'wellData']);

        Route::post('/action-not-required', [ActionRequiredController::class, 'actionNotRequired']);

        Route::post('/share-well-data', [WellDataController::class, 'store']);

        Route::get('/action-required', [ActionRequiredController::class, 'index']);
    });

});