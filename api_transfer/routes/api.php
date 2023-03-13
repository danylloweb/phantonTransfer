<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['message' => 'Transfer Api OK!', 'error' => false];
});

Route::group(['middleware' => 'auth:api'], function () {
    $except = ['except' => ['create', 'edit','delete','update','store']];
    Route::get('user-authenticated', 'UsersController@getUserLogged');
    Route::get('users', 'UsersController@index');
    Route::get('users/{id}', 'UsersController@show');
    Route::post('users', 'UsersController@storeUser');
    Route::post('transactions', 'TransactionsController@storeTransaction');
    Route::post('revert-transactions', 'TransactionsController@revertTransaction');
    Route::resource('userTypes', 'UserTypesController', $except);
    Route::resource('transactionStatuses', 'TransactionStatusesController', $except);
    Route::resource('transfers', 'TransfersController', $except);
    Route::resource('transferStatuses', 'TransferStatusesController', $except);
});

Route::any('*', function () { return ['message' => 'Transfer Api OK!', 'error' => false]; });
