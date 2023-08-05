<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

/*
 *   STUDENT
 *
 *
 */

//dodawanie studenta
Route::get('/Student/create',[\App\Http\Controllers\StudentController::class,'create'])->name('student.create');
Route::post('/Student/store',[\App\Http\Controllers\StudentController::class,'store'])->name('student.store');

//edycja studenta
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');

//usuniecie studenta z listy
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('/main', [MainController::class, 'index'])->name('main');
Route::get('/StudentList',[\App\Http\Controllers\StudentController::class,'index'])->name('student.index');

//profil studenta z widoku Wychowawcy
Route::get('/student/{id}',[StudentController::class,'show'])->name('student.show');

//nowi studenci
Route::get('/newStudents',[StudentController::class,'newStudents'])->name('newStudents');


Route::post('/save-event', [EventController::class, 'saveEvent'])->name('saveEvent');
Route::post('/delete-event', [\App\Http\Controllers\EventController::class, 'deleteEvent'])->name('deleteEvent');
Route::post('/edit-event', [\App\Http\Controllers\EventController::class, 'edit'])->name('editEvent');



Route::get('/get-events', [\App\Http\Controllers\EventController::class, 'getEvents'])->name('getEvents');

//ocenyStudenta
Route::get('/gradesList',[StudentController::class,'gradeList'])->name('students.StudentView.grades');
//profil studenta z widoku ucznia
Route::get('/student/{id}/profile',[StudentController::class,'showProfile'])->name('students.StudentView.profile');
Route::get('/studentsManage',[StudentController::class,'studentManage'])->name('Students.manage');
Route::post('/assignStudent',[StudentController::class,'assignStudent'])->name('assignStudent');

//widok wpisywania ocen wychowawcy

Route::get('/mark/student',[TeacherController::class,'index'])->name('teachers.studentMark');
Route::post('/mark/store', [TeacherController::class,'store'])->name('grade.store');
/*
 *
 *  KLASY
 *
 */

//Lista klas
Route::get('/listaKlas',[\App\Http\Controllers\ClassController::class,'index'])->name('index1');

//dodawanie klasy
Route::get('/classes/create',[\App\Http\Controllers\ClassController::class,'create'])->name('classes.create');
Route::post('/classes/store',[\App\Http\Controllers\ClassController::class,'store'])->name('classes.store');

//edycja klasy
Route::get('/classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
Route::put('/classes/{class}',[\App\Http\Controllers\ClassController::class,'update'])->name('classes.update');

Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');

//klasa wychowawcy
Route::get('/twojaKlasa',[ClassController::class,'showClass'])->name('classes.showClass');

// routes/web.php
Route::get('/classes/{class}', [ClassController::class, 'show'])->name('classes.show');
// routes/web.php
Route::post('/classes/{class}/addStudent', [ClassController::class, 'addStudent'])->name('classes.addStudent');


/*
 *
 *  KALENDARZ
 */
Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('index');
Route::post('/calendar', [\App\Http\Controllers\EventController::class, 'saveEvent'])->name('index');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


/*
 *
 * PERMISJE CRUD
 */

Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
