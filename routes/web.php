<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntryRouteController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\GradeSchoolController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\JuniorHighSchoolController;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\PassAdministrationController;
use App\Http\Controllers\PassExamController;
use App\Http\Controllers\PassEyeController;
use App\Http\Controllers\PassInterviewController;
use App\Http\Controllers\PassMedicalController;
use App\Http\Controllers\PassPsychotestController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SeniorHighSchoolController;
use App\Http\Controllers\SiblingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    // Only Admin
    Route::prefix('kelola')->group(function () {
        Route::resource('administrasi', PassAdministrationController::class);
        Route::resource('test-potensi-akademik', PassExamController::class);
        Route::resource('test-kesehatan-mata', PassEyeController::class);
        Route::resource('wawancara', PassInterviewController::class);
        Route::resource('psikotest', PassPsychotestController::class);
        Route::resource('medical-check-up', PassMedicalController::class);
        Route::resource('jalur-masuk', EntryRouteController::class);
        Route::resource('jurusan-smk', StudyController::class);
    });
    // Only Student
    Route::prefix('data')->group(function () {
        Route::resource('prestasi', AchievementController::class);
        Route::resource('ayah', FatherController::class);
        Route::resource('sekolah-dasar', GradeSchoolController::class);
        Route::resource('wali', GuardianController::class);
        Route::resource('sekolah-mengenah-pertama', JuniorHighSchoolController::class);
        Route::resource('ibu', MotherController::class);
        Route::resource('raport', RaportController::class);
        Route::resource('sekolah-menengah-kejuruan', SeniorHighSchoolController::class);
        Route::resource('saudara', SiblingController::class);
        //Admin & Student Access
        Route::resource('pribadi-calon-mahasiswa', StudentController::class);
    });
});
