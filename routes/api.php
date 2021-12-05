<?php

use App\Http\Controllers\EventTrackerHomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return $request->user();
});

Route::post('/add-student',[StudentController::class, 'store']);
Route::get('/list-students',[StudentController::class, 'liststudents']);
Route::get('/edit-student/{id}',[StudentController::class, 'edit']);
Route::post('/update-student/{id}',[StudentController::class, 'update']);

Route::get('/delete-student/{id}',[StudentController::class, 'destroy']);


//Event Tracker Api/Routes
Route::get('/getallevents', [EventTrackerHomeController::class,'getEvents']);
Route::post('/runtasks/{time}', [EventTrackerHomeController::class,'run_tasks']);
Route::get('/generatereport', [EventTrackerHomeController::class,'getReport']);
Route::post('/starttasks/{time}', [EventTrackerHomeController::class,'start_task']);
Route::post('/stoptasks/{time}', [EventTrackerHomeController::class,'stop_task']);
Route::post('/reporttasks/{time}', [EventTrackerHomeController::class,'report_task']);

//User Api/Routes
Route::post('register',[UsersController::class,'register']);
Route::post('login',[UsersController::class,'login']);


//Product Api/Routes
Route::post('addproduct',[ProductsController::class,'addproduct']);
Route::get('listproducts',[ProductsController::class,'listproducts']);
Route::delete('delete/{id}',[ProductsController::class,'delete']);
Route::get('product/{id}',[ProductsController::class,'getProduct']);
Route::put('update/{id}',[ProductsController::class,'update']);


//Patients Api/Routes
Route::post('addhealthfacility',[PatientController::class,'addfacility']);
Route::post('addpatient',[PatientController::class,'addpatient']);
Route::get('listpatients',[PatientController::class,'listpatients']);
Route::get('listfacilities',[PatientController::class,'listfacilities']);
Route::get('statistics',[PatientController::class,'statistics']);

Route::get('search/{key}',[PatientController::class,'search']);
