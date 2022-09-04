<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResumesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return redirect('home');
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::get('registration_as_employer', [CustomAuthController::class, 'registrationEmployer'])->name('register-employer');
Route::get('logout', [CustomAuthController::class, 'signOut'])->name('logout');
Route::post('customRegistration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::post('employerRegistration', [CustomAuthController::class, 'employerRegistration'])->name('register.employer');
Route::post('customLogin', [CustomAuthController::class, 'customLogin'])->name('login.custom');

Route::get('api/user', [CustomAuthController::class, 'userReturner']);

Route::get('account', function () {
    return view('account');
})->middleware('auth');

Route::post('updateProfPicture', [CustomAuthController::class, 'updateProfPicture'])->name('update.picture');
Route::post('updateProfName', [CustomAuthController::class, 'updateProfName'])->name('update.name');

Route::get('/main', function () {
    return view('main');
});


Route::get('/project/create', function (){
    return view('employers.create');
})->name('create.project.view');
Route::post('/project/create', [ProjectController::class, 'validateNewProject'])->name('create.project');

Route::get('/project/view/{id}', [ProjectController::class, 'viewProject'])->name('view.project');

Route::get('account/resume/edit', [ResumesController::class, 'viewEditResume'])->name('edit.account.resume');;
Route::post('account/resume/save', [ResumesController::class, 'createResume'])->name('save.account.resume');

//Route::get('resume/view/{id}', [ResumesController::class, 'viewResume'])->name('view.resume');
//Route::get('resume/edit/{id}', [ResumesController::class, 'viewEditResume'])->name('edit.resume');

Route::get('resume/new', function () {
    return view('employees.resumes.create');
})->name('new.resume');


//Route::post('resume/new', [ResumesController::class, 'createResume'])->name('create.resume');
//Route::post('resume/edit/{id}', [ResumesController::class, 'editResume'])->name('edit.resume');

Route::get('admin/panel', [AdminController::class, 'index'])->name('admin.panel');

