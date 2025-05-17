<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CampaignDonasiController;
use App\Http\Controllers\Admin\DonasiAdminController;
use App\Http\Controllers\Admin\PaymentAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DonasiUserController;
use App\Http\Controllers\User\PaymentUserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\App;



use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirectFilter', 'localeViewPath']
    ],
    function () {

        // Route::post('/locale/switch', function (Request $request) {
        //     $locale = $request->input('locale');
        //     App::setLocale($locale);
        //     session(['locale' => $locale]);

        //     return redirect()->back();
        // })->name('locale.switch');


        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
            Route::get('/campaign-donasi', 'indexDonasi')->name('donasi');
            Route::get('/campaign-donasi/{slug}', 'showDonasi')->name('donasi.show');
            Route::get('/donatur', 'indexDonatur')->name('donatur');
        });

        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'indexLogin')->name('indexLogin');
            Route::post('/login', 'login')->name('login');
            Route::post('/logout', 'logout')->name('logout');
            Route::get('/register', 'indexRegister')->name('indexRegister');
            Route::post('/register', 'register')->name('register');
        });


        Route::middleware(['CheckLogin'])->group(function () {
            Route::get('/campaign/{slug}', [CampaignDonasiController::class, 'index'])->name('campaign.index');
            Route::post('/campaign/donasi', [DonasiUserController::class, 'store'])->name('campaign.store');
            Route::resource('payments', PaymentUserController::class);
            Route::get('/payments/{id}', [PaymentUserController::class, 'show'])->name('payments.showForm');
            Route::post('/payments/store', [PaymentUserController::class, 'store'])->name('payments.store');



            Route::middleware("IsUser")->group(function () {
                Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
                Route::get('/donasi-user', [DonasiUserController::class, 'index'])->name('donationuser.index');
                Route::get('/pembayaran-user', [PaymentUserController::class, 'showPayment'])->name('paymentuser.index');
            });

            Route::middleware(["IsAdmin"])->prefix('admin')->group(function () {
                Route::resource('banners', BannerController::class);
                Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
                Route::get('/campaigns', [CampaignDonasiController::class, 'indexDashboard'])->name('campaigns.indexDashboard');
                Route::get('/campaigns/create', [CampaignDonasiController::class, 'create'])->name('campaigns.create');
                Route::post('/campaigns/store', [CampaignDonasiController::class, 'store'])->name('campaigns.store');
                Route::get('/campaigns/{campaign}/edit', [CampaignDonasiController::class, 'edit'])->name('campaigns.edit');
                Route::put('/campaigns/{campaign}', [CampaignDonasiController::class, 'update'])->name('campaigns.update');
                Route::delete('/campaigns/{id}', [CampaignDonasiController::class, 'destroy'])->name('campaigns.destroy');
                Route::get('/donations', [DonasiAdminController::class, 'index'])->name('donations.index');
                Route::get('/donations/{id}', [DonasiAdminController::class, 'showDonasi'])->name('donations.show');
                Route::get('/payments/admin', [PaymentAdminController::class, 'index'])->name('paymentsadmin.index');
                Route::patch('/payments/confirm/{id}', [PaymentAdminController::class, 'update'])->name('paymentsadmin.update');
            });
        });
    }
);
