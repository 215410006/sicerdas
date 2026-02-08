<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\QuestionImportController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MateriKategoriController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TryoutSiswaController;
use App\Http\Controllers\SettingController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/admin/dashboard_admin', [HomeController::class, 'adminDashboard'])->name('admin.dashboard_admin');
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

//student routr
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');


});

// Dashboard Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard_staff', [HomeController::class, 'staffDashboard'])->name('staff.dashboard_staff');
});

// Dashboard Staff
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard_student', [HomeController::class, 'studentDashboard'])->name('students.dashboard_student');

    //tryout
    Route::get('/tryout/{id}/kerjakan', [TryoutSiswaController::class, 'kerjakan'])->name('tryout.kerjakan');
    Route::post('/tryout/{id}/submit', [TryoutSiswaController::class, 'submit'])->name('tryout.submit');

});


 // Manajemen Soal
 Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
 Route::post('/questions/import', [QuestionController::class, 'import'])->name('questions.import');
 Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
 Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
 Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
 Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update'); 
 Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
 Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
 Route::get('/questions/by-category/{categoryId}', [QuestionController::class, 'byCategory']);




// Manajemen Kategori Soal
Route::get('/question-categories', [QuestionCategoryController::class, 'index'])->name('question_categories.index');
Route::get('/question-categories/create', [QuestionCategoryController::class, 'create'])->name('question_categories.create');
Route::post('/question-categories', [QuestionCategoryController::class, 'store'])->name('question_categories.store');
Route::get('/question-categories/{category}/edit', [QuestionCategoryController::class, 'edit'])->name('question_categories.edit');
Route::put('/question-categories/{category}', [QuestionCategoryController::class, 'update'])->name('question_categories.update');
Route::delete('/question-categories/{id}', [QuestionCategoryController::class, 'destroy'])->name('question_categories.destroy');



//materi

Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/{materi}/edit', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');
Route::get('/materi/{materi}', [MateriController::class, 'show'])->name('materi.show');



// Menampilkan daftar kategori materi
Route::get('/materi_kategori', [MateriKategoriController::class, 'index'])->name('materi_kategori.index');
Route::get('/materi_kategori/create', [MateriKategoriController::class, 'create'])->name('materi_kategori.create');
Route::post('/materi_kategori', [MateriKategoriController::class, 'store'])->name('materi_kategori.store');
Route::get('/materi_kategori/{kategori}/edit', [MateriKategoriController::class, 'edit'])->name('materi_kategori.edit');
Route::put('/materi_kategori/{kategori}', [MateriKategoriController::class, 'update'])->name('materi_kategori.update');
Route::delete('/materi_kategori/{kategori}', [MateriKategoriController::class, 'destroy'])->name('materi_kategori.destroy');


//fitur tryout

Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout.index');
Route::get('/tryout/create', [TryoutController::class, 'create'])->name('tryout.create');
Route::post('/tryout', [TryoutController::class, 'store'])->name('tryout.store');
Route::get('/tryout/{tryout}/edit', [TryoutController::class, 'edit'])->name('tryout.edit');
Route::put('/tryout/{tryout}', [TryoutController::class, 'update'])->name('tryout.update');
Route::delete('/tryout/{tryout}', [TryoutController::class, 'destroy'])->name('tryout.destroy');
Route::get('tryout/jadwal', [TryoutController::class, 'schedule'])->name('tryout.schedule');
Route::get('/tryout/result', [TryoutController::class, 'result'])->name('tryout.result');
Route::get('tryout/{tryout}/soal', [TryoutController::class, 'showQuestions'])->name('tryout.soal');
Route::post('/tryout/save-answer', [TryoutController::class, 'saveAnswer'])->name('tryout.saveAnswer');



Route::get('/leaderboard', [\App\Http\Controllers\TryoutController::class, 'leaderboard'])->name('tryout.leaderboard');

//performa

Route::get('/performa/laporan-skor', [PerformaController::class, 'laporanSkor'])->name('performa.laporan-skor');
Route::get('/performa/kemajuan', [PerformaController::class, 'kemajuanSiswa'])->name('performa.kemajuan');
Route::get('/performa/kehadiran', [PerformaController::class, 'kehadiran'])->name('performa.kehadiran');

// Route untuk halaman profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // Menampilkan profil

//pengaturan

Route::prefix('pengaturan')->group(function () {
    Route::get('/umum', [SettingController::class, 'umum'])->name('pengaturan.umum');
    Route::get('/keamanan', [SettingController::class, 'keamanan'])->name('pengaturan.keamanan');
});

