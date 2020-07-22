<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ['as' => 'index','uses' => 'HomeController@index']);

Route::get('/companies', ['as' => 'companies','uses' => 'CompanyController@index']);
Route::get('/company/{id}', ['as' => 'company.details','uses' => 'CompanyController@show']);
Route::get('/create-company', ['as' => 'company.create','uses' => 'CompanyController@create']);
Route::get('/manage-users/{id}', ['as' => 'company.manage-users','uses' => 'CompanyController@manage_users']);
Route::post('/store-company', ['as' => 'company.store','uses' => 'CompanyController@store']);
Route::get('/activate-user', ['as' => 'customer.activate','uses' => 'CompanyController@activateuser']);
Route::get('/deactivate-user', ['as' => 'customer.deactivate','uses' => 'CompanyController@deactivateuser']);

Route::get('/tarifs', ['as' => 'tarifs','uses' => 'TarifController@index']);
Route::get('/tarif/{id}', ['as' => 'tarif.details','uses' => 'TarifController@show']);
Route::get('/create-tarif', ['as' => 'tarif.create','uses' => 'TarifController@create']);
Route::post('/store-tarif', ['as' => 'tarif.store','uses' => 'TarifController@store']);

Route::get('/customers', ['as' => 'customers','uses' => 'CustomerController@index']);
Route::get('/customer/{id}', ['as' => 'customer.details','uses' => 'CustomerController@show']);
Route::get('/create-customer', ['as' => 'customer.create','uses' => 'CustomerController@create']);
Route::post('/store-customer', ['as' => 'customer.store','uses' => 'CustomerController@store']);

Route::get('/filtering-tarif', ['as' => 'tarif-through-company.filtering','uses' => 'TarifController@filtering']);

Route::get('query', 'QueryController');

Route::get('users/export/', 'HomeController@export');
