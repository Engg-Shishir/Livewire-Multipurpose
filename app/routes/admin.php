<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\User\ListUsers;
use App\Http\Livewire\Admin\Appoinments\ListAppoinments;
use App\Http\Livewire\Admin\Appoinments\CreateAppoinmentForm;
use App\Http\Livewire\Admin\Appoinments\UpdateAppoinmentForm;
use App\Http\Livewire\Admin\Profile\Update;


Route::get('dashboard', DashboardController::class)->name('dashboard');
Route::get('user', ListUsers::class)->name('user');
Route::get('appoinments', ListAppoinments::class)->name('appoinments');
Route::get('appoinments/create', CreateAppoinmentForm::class)->name('appoinments.create');
Route::get('appoinment/{PassAppoinment}/edit', UpdateAppoinmentForm::class)->name('appoinments.edit');
Route::get('profile', Update::class)->name('profile.edit');