<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect(route('login'));
})->name('home');

Route::middleware(['auth', 'verified', 'reset_password'])->group(function () {
    Route::redirect('settings', 'password');

    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('guru', 'guru-index')->name('guru.index');

    Volt::route('kelas', 'kelas-index')->name('kelas.index');

    Volt::route('jadwal', 'jadwal-index')->name('jadwal.index');
    Volt::route('jadwal/edit', 'jadwal-create')->name('jadwal.create');


    Volt::route('siswa', 'siswa-index')->name('siswa.index');
    Volt::route('siswa/prestasi', 'prestasi-index')->name('prestasi.index');

    Volt::route('setting', 'setting-index')->name('setting.index');
});

Route::middleware(['auth', 'verified', 'reset_password', 'admin'])->group(function () {
    Volt::route('angkatan', 'angkatan-index')->name('angkatan.index');
    Volt::route('dashboard', 'dashboard')->name('dashboard');
    Volt::route('mapel', 'mapel-index')->name('mapel.index');
    Volt::route('setting', 'setting-index')->name('setting.index');
    Volt::route('admin', 'admin-index')->name('admin.index');
    Volt::route('import/admin', 'import.admin')->name('admin.import');
    Volt::route('import/guru', 'import.guru')->name('guru.import');
    Volt::route('siswa/import', 'import.siswa')->name('siswa.import');
});

require __DIR__ . '/auth.php';
