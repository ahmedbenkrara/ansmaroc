<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SignalerController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategorieController;

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

//home
Route::get('/',[HomeController::class,'getCT'])->name('home');

//contact
Route::get('/contact',[MailController::class,'contact'])->name('contact');
Route::post('/contact',[MailController::class,'send'])->name('send');

//create announce
Route::get('/createannounce',[AnnounceController::class,'index'])->name('announce.create');
Route::post('/createannounce',[AnnounceController::class,'create'])->name('announce.send');
Route::post('/registeran',[AnnounceController::class,'register'])->name('announce.register');
Route::post('/img',[AnnounceController::class,'img'])->name('img');

//search
Route::get('/search',[SearchController::class,'index'])->name('search');
Route::get('/search/titre/{titre?}/ville/{ville?}/price/{price?}/cat/{cat?}',[SearchController::class,'filter'])->name('search.filter');
Route::get('/search/category/{id}',[SearchController::class,'catfilter']);
Route::get('/details/{city?}/{slug?}/{id?}',[SearchController::class,'Details']);
Route::get('/annonces/{city?}',[SearchController::class,'Bycity']);

//favorite
Route::post('/favorite',[FavoriteController::class,'create'])->name('favorite');

//signaler
Route::post('/signaler',[SignalerController::class,'create'])->name('signaler');

Route::get('/dashboard', [DashboardController::class,'index'])
->middleware(['auth','verified'])->name('dashboard');

//for users
Route::group(['middleware' => ['auth','role:user','verified']],function(){
    Route::get('/anfilter',[SearchController::class,'filterauth'])->name('filterauth');
    Route::get('/favorite',[FavoriteController::class,'read']);
    //edit Annonce
    Route::get('/editan/{id?}',[AnnounceController::class,'edit']);
    Route::post('/update',[AnnounceController::class,'update'])->name('annonce.update');
    Route::post('/updateimage',[AnnounceController::class,'updateimage'])->name('annonce.image');
    Route::get('/delete/{id}',[AnnounceController::class,'delete']);

});

//for admins
Route::group(['middleware'=>['auth','role:admin','verified']],function(){
    Route::get('/demande/{id?}',[SearchController::class,'Adetails']);
    Route::post('/demande',[DemandeController::class,'demande'])->name('demande');
    Route::post('/delannonce',[DemandeController::class,'delete'])->name('addelete');
    Route::get('/reports',[DemandeController::class,'view']);
    Route::get('/reportD/{id?}',[DemandeController::class,'signaledelete']);
    Route::get('/admin',[RegisterController::class,'create']);
    Route::post('/admin',[RegisterController::class,'store'])->name('admin.store');
    ///////////////////////////////////////////////////////////////////////////////////////
    Route::get('/categories/{id?}',[CategorieController::class,'index']);
    Route::get('/edit{id?}',[CategorieController::class,'edit']);
    Route::post('/updatescat',[CategorieController::class,'update']);
    Route::post('/deletescat',[CategorieController::class,'delete'])->name('delete.scat');
    Route::post('/createscat',[CategorieController::class,'create'])->name('create.scat');
    Route::post('/createcat',[CategorieController::class,'createcat'])->name('create.cat');
    ///////////////////////////////////////////////////////////////////////////////////////
    Route::get('/cats',[CategorieController::class,'view']);
    Route::get('/getcat{id?}',[CategorieController::class,'getcat']);
    Route::post('/updatecat',[CategorieController::class,'updatecat'])->name('update.cat');
    Route::post('/deletecat',[CategorieController::class,'deletecat'])->name('deletecat.cat');
    ////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/seo',[HomeController::class,'settings']);
    Route::get('/seoupdate',[HomeController::class,'update'])->name('settings.update');
    ////////////////////////////////////////////////////////////////////////////////////////
    Route::post('/setTitle',[HomeController::class,'setTitle']);

});

Route::group(['middleware' => ['auth','verified']],function(){
    //parametre
    Route::get('/parametre',[ParametreController::class,'index']);
    Route::post('/updateuser',[ParametreController::class,'update']);
});

require __DIR__.'/auth.php';
