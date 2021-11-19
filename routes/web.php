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

Route::post('/plant/save', [App\Http\Controllers\HomeController::class, 'plantsave'])->name('plant.save');
Route::post('/plant/delete/{id}', [App\Http\Controllers\HomeController::class, 'plantdelete'])->name('plant.delete');
Route::post('/plant/update/{id}', [App\Http\Controllers\HomeController::class, 'plantedit'])->name('plant.edit');
Route::post('/postplant/uploadphoto/{id}',[App\Http\Controllers\HomeController::class,'uploadphotopost'])->name('post.uploadphoto');
Route::post('/postplant/postsave/{id}',[App\Http\Controllers\HomeController::class,'postsave'])->name('post.save');

Auth::routes();
Route::group(['middleware'=>['AdminCheck']],function(){
    Route::get('/', function () {
        return view('index');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'admin_dash'])->name('admin.dash');
Route::get('/admin/viewplants', [App\Http\Controllers\HomeController::class, 'viewplants'])->name('view.plants');
Route::get('/admin/vieweditplants/{id}', [App\Http\Controllers\HomeController::class, 'editviewplant'])->name('view.edit');
Route::get('/admin/viewpost', [App\Http\Controllers\HomeController::class, 'viewpost'])->name('post.view');
Route::get('/admin/loadpost', [App\Http\Controllers\HomeController::class, 'loadpost'])->name('post.load');
Route::get('/admin/postselected/{id}', [App\Http\Controllers\HomeController::class, 'postcreate'])->name('post.create');
Route::get('/admin/fetchpostphoto/{id}',[App\Http\Controllers\HomeController::class,'fetchpostphotos'])->name('post.fetch');
Route::get('/admin/deletepostphoto',[App\Http\Controllers\HomeController::class,'deletepostphotos'])->name('postphoto.delete');
Route::get('/admin/viewupdatepost/{id}',[App\Http\Controllers\HomeController::class,'postupdate'])->name('post.view.edit');
Route::get('/admin/postdelete/{id}',[App\Http\Controllers\HomeController::class,'post_delete'])->name('post.delete');
Route::get('/admin/viewplantdetails/{id}',[App\Http\Controllers\HomeController::class,'plant_details'])->name('plant.detail');



