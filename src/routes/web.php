<?php

use App\Http\Controllers\ContactController;
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


Route::get("/", [ContactController::class, "index"])->name("contact.index");
Route::post("/confirm", [ContactController::class, "confirm"])->name("contact.confirm");
Route::post("/thanks", [ContactController::class, "store"])->name("contact.store");
Route::get("/thanks", [ContactController::class, "thanks"])->name("contact.thanks");

Route::middleware("auth")->group(function () {
    Route::get("/admin", [ContactController::class, "admin"])->name("admin");
});
Route::get('/admin/search', [ContactController::class, 'search']);
Route::delete("/admin/delete/{id}", [ContactController::class, "destroy"]);
Route::get("/export", [ContactController::class, "export"]);
Route::get('/reset', [ContactController::class, 'admin'])->name('admin.reset');
