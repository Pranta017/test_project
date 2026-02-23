<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\BenefitController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterData\DivisionController;
use App\Http\Controllers\MasterData\DistrictController;
use App\Http\Controllers\MasterData\UpazilaController;




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

    Route::get('/beneficiaries/{id}', [BeneficiaryController::class, 'show'])
    ->name('beneficiaries.show');


    //  [Benficiary_table edit]
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/beneficiaries/{id}', [BeneficiaryController::class, 'update'])
        ->name('beneficiaries.update');

    Route::delete('/beneficiaries/{id}', [BeneficiaryController::class, 'destroy'])
        ->name('beneficiaries.destroy');

    Route::post('/beneficiaries/import', [BeneficiaryController::class, 'importExcel'])
        ->name('beneficiaries.import');







    Route::prefix('master-data')->group(function () {

        // Division Routes
        Route::get('/division', [DivisionController::class, 'list'])->name('division.list');
        Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create');
        Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');
        // Route::post('/district/store', [DistrictController::class, 'store'])->name('district.store');
        Route::get('/division/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
        Route::put('/division/update/{id}', [DivisionController::class, 'update'])->name('division.update');
        Route::delete('/division/delete/{id}', [DivisionController::class, 'destroy'])->name('division.destroy');

        // District Routes
        Route::get('/district', [DistrictController::class, 'list'])->name('district.list');
        Route::get('/district/create', [DistrictController::class, 'create'])->name('district.create');
        Route::post('/district/store', [DistrictController::class, 'store'])->name('district.store');
        Route::get('/district/edit/{district}', [DistrictController::class, 'edit'])->name('district.edit');
        Route::put('/district/update/{district}', [DistrictController::class, 'update'])->name('district.update');
        Route::delete('/district/delete/{district}', [DistrictController::class, 'destroy'])->name('district.delete');
        Route::get('/districts', [DistrictController::class, 'index'])->name('district.list');


        // Upazila Routes
        Route::get('/upazilas', [UpazilaController::class, 'list'])->name('upazila.list');
        Route::resource('upazila', UpazilaController::class);

        Route::get('/upazila/create', [UpazilaController::class, 'create'])->name('upazilas.create');
        Route::post('/upazila/store', [UpazilaController::class, 'store'])->name('upazilas.store');

        Route::get('/get-districts/{division_id}', [UpazilaController::class, 'getDistricts'])->name('get.districts');
        Route::get('/get-upazilas/{district_id}', [UpazilaController::class, 'getUpazilas'])->name('get.upazilas');

        Route::get('/upazilas', [UpazilaController::class, 'list'])->name('upazila.list');


        // Benefit Routes
        Route::get('/benefits', [BenefitController::class, 'list'])->name('benefits.list');
        Route::get('/benefit/create', [BenefitController::class, 'create'])->name('benefit.create');
        Route::post('/benefit/store', [BenefitController::class, 'store'])->name('benefit.store');
        Route::get('/benefit/edit/{id}', [BenefitController::class, 'edit'])->name('benefit.edit');
        Route::put('/benefit/update/{id}', [BenefitController::class, 'update'])->name('benefit.update');
        Route::delete('/benefit/delete/{id}', [BenefitController::class, 'destroy'])->name('benefit.destroy');

    });



    // District filter route
    Route::get('district/filter', [DistrictController::class, 'filter'])->name('district.filter');

    // Division filter route
    Route::get('division/filter', [DivisionController::class, 'filter'])->name('division.filter');

    // beneficiary filter route

    Route::get('beneficiary/filter', [BeneficiaryController::class, 'filter'])
        ->name('beneficiary.filter');

    Route::get('/beneficiary/list', [BeneficiaryController::class, 'list'])
        ->name('beneficiary.list');

    Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])
    ->name('beneficiaries.index');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


    Route::prefix('admin/master-data')->group(function () {});
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
