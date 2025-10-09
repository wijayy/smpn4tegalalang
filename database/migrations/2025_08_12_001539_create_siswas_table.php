<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 100);
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->string('nis', 30)->unique();
            $table->string('nisn');
            $table->string('alamat');
            $table->string('no_telp');
            $table->date( 'tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('angkatan_id')->constrained('angkatans')->onDelete('cascade');
            $table->boolean('siswa_tidak_mampu')->default(false); // Tambahan kolom boolean
            $table->enum('status', ['aktif', 'lulus', 'keluar'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
