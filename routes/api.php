<?php

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
 Route::get('/admin', 'App\Http\Controllers\AdminController@getAdmin');
// get admin by id
Route::get('/admin/{id}', 'App\Http\Controllers\AdminController@getAdminById');
// login
Route::get('/login', 'App\Http\Controllers\AdminController@login');
Route::post('/admin', 'App\Http\Controllers\AdminController@store');
//create certificate
Route::post('/create-cert', 'App\Http\Controllers\CertificateController@store');
// get certificate
Route::get('/get-cert-all', 'App\Http\Controllers\CertificateController@get');
// get certificate by id
Route::get('/get-cert/{id}', 'App\Http\Controllers\CertificateController@getById');

// get certificate by certificate id
Route::get('/get-cert-by-certificateId/{certificateId}', 'App\Http\Controllers\CertificateController@getByCertificateId');

// get certificate by certificate id and date of birth

Route::post('/get-cert-by-certificateId-dob', 'App\Http\Controllers\CertificateController@getByCertificateIdAndDob');

// get certificate by service
Route::get('/get-cert-by-service/{service}', 'App\Http\Controllers\CertificateController@getByService');
//test
Route::post('/image', 'App\Http\Controllers\CertificateController@imageUpload');

// create application
Route::post('/create-application', 'App\Http\Controllers\CertificateController@storeApplication');

// get all applications
Route::get('/get-applications', 'App\Http\Controllers\CertificateController@getApplications');

// get application by id
Route::get('/get-application/{id}', 'App\Http\Controllers\CertificateController@getApplicationById');

// get application by applicationId
Route::get('/get-application-by-applicationId/{applicationId}', 'App\Http\Controllers\CertificateController@getApplicationByApplicationId');

// get application by service

Route::get('/get-application-by-service/{service}', 'App\Http\Controllers\CertificateController@getApplicationByService');

//get application by status
Route::get('/get-application-by-status/{status}', 'App\Http\Controllers\CertificateController@getApplicationByStatus');

// update application status 
//Route::post('/update-application-status/{id}', 'App\Http\Controllers\CertificateController@updateApplicationStatus');

// update application status with comment

Route::post('/update-application-status-comment/{id}', 'App\Http\Controllers\CertificateController@updateApplicationStatusWithComment');

// update application 

Route::post('/update-application/{id}', 'App\Http\Controllers\CertificateController@updateApplication');

// recover application id by service, dob, nid

Route::post('/recover-application-id', 'App\Http\Controllers\CertificateController@recoverApplicationId');