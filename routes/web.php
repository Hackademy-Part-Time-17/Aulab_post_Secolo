<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\WriterController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/article/index',[ArticleController::class,'index'])->name('article.index');

Route::get('/article/{article:slug}/show',[ArticleController::class,'show'])->name('article.show');

Route::get('/article/category/{category}',[ArticleController::class,'byCategory'])->name('article.byCategory');

Route::get('/article/writer/{user:id}',[ArticleController::class,'byWriter'])->name('article.byWriter');

Route::get('/article/search',[ArticleController::class,'articleSearch'])->name('article.search');

Route::get('/careers',[PublicController::class,'careers'])->name('careers');

Route::post('/careers/submit',[PublicController::class,'careersSubmit'])->name('careers.submit');

Route::middleware('admin')->group(function(){
    Route::get('/admin/dashboard/ruoli',[AdminController::class,'dashboardRoles'])->name('admin.dashboardRoles');
    Route::get('/admin/dashboard/metainfos',[AdminController::class,'dashboardMetainfos'])->name('admin.dashboardMetainfos');
    Route::get('/admin/{user:id}/set-admin',[AdminController::class,'setAdmin'])->name('admin.setAdmin');//potremmo usare anche il metodo PATCH per modificare parzialmente i dati
    Route::get('/admin/{user:id}/set-revisor',[AdminController::class,'setRevisor'])->name('admin.setRevisor');
    Route::get('/admin/{user:id}/left-revisor',[AdminController::class,'leftRevisor'])->name('admin.leftRevisor');
    Route::get('/admin/{user:id}/set-writer',[AdminController::class,'setWriter'])->name('admin.setWriter');
    Route::get('/admin/{user:id}/left-writer',[AdminController::class,'leftWriter'])->name('admin.leftWriter');
    Route::put('/admin/edit/{tag}/tag',[AdminController::class,'editTag'])->name('admin.editTag');
    Route::delete('/admin/delete/{tag}/tag',[AdminController::class,'deleteTag'])->name('admin.deleteTag');
    Route::put('/admin/edit/{category}/category',[AdminController::class,'editCategory'])->name('admin.editCategory');
    Route::delete('/admin/delete/{category}/category',[AdminController::class,'deleteCategory'])->name('admin.deleteCategory');
    Route::post('/admin/category/store',[AdminController::class,'storeCategory'])->name('admin.storeCategory');
});
Route::middleware('revisor')->group(function(){
    Route::get('/revisor/dashboard',[RevisorController::class,'dashboard'])->name('revisor.dashboard');
    Route::get('/revisor/{article:slug}/accept',[RevisorController::class,'acceptArticle'])->name('revisor.acceptArticle');
    Route::get('/revisor/{article:slug}/reject',[RevisorController::class,'rejectArticle'])->name('revisor.rejectArticle');
    Route::get('/revisor/{article:slug}/undo',[RevisorController::class,'undoArticle'])->name('revisor.undoArticle');
});
Route::middleware('writer')->group(function(){
    Route::get('/article/create',[ArticleController::class,'create'])->name('article.create');
    Route::post('/article/store',[ArticleController::class,'store'])->name('article.store');
    Route::get('/writer/dashboard',[WriterController::class,'dashboard'])->name('writer.dashboard');
    Route::get('/article/{article:slug}/edit',[ArticleController::class,'edit'])->name('article.edit');
    Route::put('/article/{article:slug}/update',[ArticleController::class,'update'])->name('article.update');
    Route::delete('/article/{article:slug}/destroy',[ArticleController::class,'destroy'])->name('article.destroy');


});


