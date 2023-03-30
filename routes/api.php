<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\SiswaController;
use App\http\Controllers\KelasController;
// use App\http\Controllers\BukuController;
use App\Http\Controllers\bukuController;
use App\http\Controllers\PeminjamanController;
use App\http\Controllers\DetailController;
use App\http\Controllers\UserController;

//use App\Http\Controllers\SiswaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //preturn $request->user();
    
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::group(['middleware' => ['jwt.verify']], function () {
   Route::group(['middleware' => ['api.superadmin']], function () {

    });
    Route::group(['middleware' => ['api.admin']], function () {
    
    });


    Route::get('/getsiswa',[SiswaController::class,'getsiswa']);
    // Route::get('/getsiswabyid/{id_siswa}',[SiswaController::class,'detailsiswa']);
    Route::get('/detailsiswa/{id_siswa}',[SiswaController::class,'detailsiswa']);
    Route::post('/createsiswa',[SiswaController::class,'createsiswa']);
    Route::put('/updatesiswa/{id_siswa}',[SiswaController::class,'updatesiswa']);
    Route::delete('/deletesiswa/{id_siswa}',[SiswaController::class,'deletesiswa']);
    
    Route::get('/getkelas',[KelasController::class,'getkelas']);
    Route::post('/createkelas',[KelasController::class,'createkelas']);
    Route::put('/updatekelas/{id_kelas}',[KelasController::class,'updatekelas']);
    Route::delete('/deletekelas/{id_kelas}',[KelasController::class,'deletekelas']);
    
    // Route::get('/getbuku',[BukuController::class,'getbuku']);
    Route::get('/getbuku',[bukuController::class,'getbuku']);
    Route::get('/detailbuku/{id_buku}',[BukuController::class,'detailbuku']);
    Route::get('/getbuku/{id_buku}',[BukuController::class,'getsemuabuku']);
    Route::post('/createbuku',[BukuController::class,'createbuku']);
    Route::put('/updatebuku/{id_buku}',[BukuController::class,'updatebuku']);
    Route::delete('/deletebuku/{id_buku}',[BukuController::class,'deletebuku']);
    
    Route::get('/getpeminjaman/{id}',[PeminjamanController::class,'getpeminjaman']);
    Route::get('/getpeminjaman1',[PeminjamanController::class,'getpeminjaman1']);
    Route::post('/createpeminjaman',[PeminjamanController::class,'createpeminjaman']);
    Route::put('/kembalipeminjaman/{id}',[PeminjamanController::class,'kembalipeminjaman']);
    Route::delete('/deletepeminjaman',[PeminjamanController::class,'deletepeminjaman']);
});
 
