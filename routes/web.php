<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    //* task
    Route::get('/task' , [TaskController::class, 'index'])->name("task.index");
    Route::post('/task/store' , [TaskController::class, 'store'])->name("task.store");
    Route::delete('/task/{task}' , [TaskController::class, 'destroy'])->name('task.destroy');
    Route::put('/task/update/{task}' , [TaskController::class, 'update'])->name('task.update');
    


    //* team
    Route::get('/team' , [TeamController::class, 'index'])->name("team.index");
    Route::post('/team/store' , [TeamController::class, 'store'])->name("team.store");
    Route::get('/team/show/{team}' , [TeamController::class, 'show'])->name('team.show');
    // Route::post('/team/invitation/{teamId}' , [InvitationController::class, 'store'])->name("invite.store");

    Route::post('/teams/{team}/invite', [InvitationController::class, 'invite'])
    ->name('team.invite');
    Route::get('/invitation/{invitation}/respond', [InvitationController::class, 'respond'])
    ->name('invitation.respond');


    //* calendar
    Route::get('/calendar' , [CalendarController::class, 'index'])->name("calendar.index");
    Route::post('/calendar/store' , [CalendarController::class, 'store'])->name("calendar.store");
    Route::resource("calendar" , CalendarController::class);
    Route::put("/calendar/update/{calendar}" , [CalendarController::class , "update"])->name("updateCalendar");
    Route::delete("/calendar/delete/{calendar}" , [CalendarController::class , "destroy"])->name("deleteCalendar");

});

require __DIR__.'/auth.php';





