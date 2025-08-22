<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Frontend Controllers
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProfilNagariController as PublicProfilNagariController;
use App\Http\Controllers\Public\AparaturController as AparaturFrontendController;
use App\Http\Controllers\Public\LayananController as LayananFrontendController;
use App\Http\Controllers\Public\BeritaController as BeritaFrontendController;
use App\Http\Controllers\Public\AgendaController as AgendaFrontendController;
use App\Http\Controllers\Public\GaleriController as GaleriFrontendController;
use App\Http\Controllers\Public\SuratController as SuratFrontendController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilNagariController as AdminProfilNagariController;
use App\Http\Controllers\Admin\AparaturController as AparaturAdminController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LayananController as LayananAdminController;
use App\Http\Controllers\Admin\BeritaController as BeritaAdminController;
use App\Http\Controllers\Admin\AgendaController as AgendaAdminController;
use App\Http\Controllers\Admin\GaleriController as GaleriAdminController;
use App\Http\Controllers\Admin\SuratController as SuratAdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CkeditorController;

// Auth Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Middleware Class
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::middleware('web')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profil-nagari', [PublicProfilNagariController::class, 'index'])->name('public.profil');

    // Aparatur
    Route::get('/aparatur', [AparaturFrontendController::class, 'index'])
         ->name('public.aparatur.index');
    Route::get('/aparatur/{aparatur}', [AparaturFrontendController::class, 'show'])
         ->name('public.aparatur.show');

    // Layanan
    Route::get('/layanan', [LayananFrontendController::class, 'index'])->name('public.layanan.index');
    Route::get('/layanan/{layanan}', [LayananFrontendController::class, 'show'])->name('public.layanan.show');

    // Berita
    Route::get('/berita', [BeritaFrontendController::class, 'index'])->name('public.berita.index');
    Route::get('/berita/{beritum}', [BeritaFrontendController::class, 'show'])->name('public.berita.show');

    // Agenda
    Route::get('agenda/filter', [AgendaFrontendController::class, 'filter'])->name('public.agenda.filter');
    Route::get('/agenda', [AgendaFrontendController::class, 'index'])->name('public.agenda.index');
    Route::get('/agenda/{agenda}', [AgendaFrontendController::class, 'show'])->name('public.agenda.show');

    // Galeri
    Route::get('/galeri', [GaleriFrontendController::class, 'index'])->name('public.galeri.index');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication (Custom)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('web')->name('admin.')->group(function(){
    Route::get('login',[AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('login',[AuthenticatedSessionController::class,'store'])->name('login.store');
    Route::post('logout',[AuthenticatedSessionController::class,'destroy'])->middleware('auth')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Admin & Superadmin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
     ->middleware(['auth', RoleMiddleware::class . ':admin,superadmin'])
     ->name('admin.')
     ->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])
     ->name('ckeditor.upload');
    Route::post('berita/upload-image', [BeritaAdminController::class, 'uploadImage'])
     ->name('berita.upload');
    Route::resource('profil-nagari',AdminProfilNagariController::class)->except('destroy');
    Route::resources([
        'aparatur'=>AparaturAdminController::class,
        'penduduk'=>PendudukController::class,
        'layanan'=>LayananAdminController::class,
        'berita'=>BeritaAdminController::class,
        'agenda'=>AgendaAdminController::class,
        'galeri'=>GaleriAdminController::class,
    ]);
    Route::get('surat',[SuratAdminController::class,'index'])->name('surat.index');
    Route::get('surat/{surat}',[SuratAdminController::class,'show'])->name('surat.show');
    Route::patch('surat/{surat}/approve',[SuratAdminController::class,'approve'])->name('surat.approve');
    Route::patch('surat/{surat}/reject',[SuratAdminController::class,'reject'])->name('surat.reject');
    Route::delete('surat/{surat}',[SuratAdminController::class,'destroy'])->name('surat.destroy');
    Route::get('surat/{surat}/export',[SuratAdminController::class,'export'])->name('surat.export');
    Route::get('layanan/export/csv',[LayananAdminController::class,'exportCsv'])->name('layanan.export.csv');

    // Superadmin only
    Route::middleware(RoleMiddleware::class . ':superadmin')->group(function(){
        Route::get('setting',[SettingController::class,'edit'])->name('setting.edit');
        Route::put('setting',[SettingController::class,'update'])->name('setting.update');
        Route::resource('users',UserController::class);
    });

    // Admin profile
    Route::get('profile',[AdminProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[AdminProfileController::class,'update'])->name('profile.update');
    Route::delete('profile',[AdminProfileController::class,'destroy'])->name('profile.destroy');
});

// Shortcut
Route::get('/dashboard',fn()=>redirect()->route('admin.dashboard'))->middleware('auth');
