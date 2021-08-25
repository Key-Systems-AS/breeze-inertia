<?php

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', function () {
    $users = User::get();
    return Inertia::render('Users', ['users' => $users]);
})->middleware(['auth', 'verified'])->name('users');

Route::post('/users', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/users');
})->middleware(['auth', 'verified']);



Route::get('/list', function () {
    return Inertia::render('List');
})->middleware(['auth', 'verified'])->name('list');

Route::get('/list2', function () {
    return Inertia::render('List2');
})->middleware(['auth', 'verified'])->name('list2');

require __DIR__.'/auth.php';
