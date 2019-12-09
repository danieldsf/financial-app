<?php

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

use App\Http\Requests\ValueRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        #
        
        $saldo = Cache::get('saldo', 0);
        $saques = Cache::get('saques', 0);
        $depositos = Cache::get('depositos', 0);
    
        return view('home')
        ->withSaldo($saldo)
        ->withSaques($saques)
        ->withDepositos($depositos);
    });
    
    Route::get('/profile', function () {
        return view('home');
    });
    
    Route::get('/deposit', function () {
        return view('deposit');
    });
    
    Route::post('/deposit', function (ValueRequest $request) {
        $valorDeposito = $request->value;
    
        $saldo = Cache::get('saldo', 0);
        $depositos = Cache::get('depositos', 0);
    
        Cache::put('saldo', $saldo + $valorDeposito);
        Cache::put('depositos', $depositos + $valorDeposito);
        return redirect('/home');
    })->name('deposit.store');
    
    Route::get('/withdraw', function () {
        return view('withdraw');
    });
    
    
    Route::post('/withdraw', function (ValueRequest $request) {
        $valorSaque = $request->value;
    
        $saldo = Cache::get('saldo', 0);
        $saques = Cache::get('saques', 0);
    
        Cache::put('saldo', $saldo - $valorSaque);
        Cache::put('saques', $saques + $valorSaque);
        return redirect('/home');
    })->name('withdraw.store');
        
});

