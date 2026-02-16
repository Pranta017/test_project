<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterData\UpazilaController;
use App\Http\Controllers\MasterData\DistrictController;
use App\Http\Controllers\MasterData\DivisionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('website.home');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');



    // Beneficiaries
    Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])
        ->name('beneficiaries.index');

    Route::get('/beneficiaries/create', [BeneficiaryController::class, 'create'])
        ->name('beneficiaries.create');

    Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])
        ->name('beneficiaries.store');

    Route::get('/beneficiaries/{id}/edit', [BeneficiaryController::class, 'edit'])
        ->name('beneficiaries.edit');


    //  [Benficiary_table edit]
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/beneficiaries/{id}', [BeneficiaryController::class, 'update'])
        ->name('beneficiaries.update');

    Route::delete('/beneficiaries/{id}', [BeneficiaryController::class, 'destroy'])
        ->name('beneficiaries.destroy');

    Route::post('/beneficiaries/import', [BeneficiaryController::class, 'importExcel'])
        ->name('beneficiaries.import');




    // Route::get('/master/data1', [MasterDataController::class, 'page1'])->name('admin.master.division');
    // Route::get('/master/data2', [MasterDataController::class, 'page2'])->name('admin.master.district');
    // Route::get('/master/data3', [MasterDataController::class, 'page3'])->name('admin.master.upazila');



    Route::prefix('master-data')->group(function () {
        Route::get('/division', [DivisionController::class, 'list'])->name('division.list');

        Route::get('/division', [DivisionController::class, 'index'])->name('division.list'); //Filter added


        Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create');
        Route::post('/division', [DivisionController::class, 'store'])->name('division.store');

        Route::get('/division/{id}/edit', [DivisionController::class, 'edit'])->name('division.edit');
        Route::put('/division/{id}', [DivisionController::class, 'update'])->name('division.update');

        Route::delete('/division/{id}', [DivisionController::class, 'destroy'])
            ->name('division.destroy');




        Route::get('/district', [DistrictController::class, 'list'])->name('district.list');
        Route::get('/upazila', [UpazilaController::class, 'list'])->name('upazila.list');


        Route::get('/admin/master-data/division', [DivisionController::class, 'list'])
            ->name('division.list');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


    Route::prefix('admin/master-data')->group(function () {});
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
