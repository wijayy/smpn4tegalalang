<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'password');

    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('angkatan', 'angkatan-index')->name('angkatan.index');
    Volt::route('tambah-angkatan/', 'angkatan-create')->name('angkatan.create');

    Volt::route('guru', 'guru-index')->name('guru.index');

    Volt::route('kelas', 'kelas-index')->name('kelas.index');
    
    Volt::route('siswa', 'siswa-index')->name('siswa.index');

});

require __DIR__ . '/auth.php';
