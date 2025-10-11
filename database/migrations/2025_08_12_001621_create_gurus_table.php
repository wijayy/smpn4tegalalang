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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            // $table->string('nama', 100);
            $table->string('kode', 100);
            $table->string('slug', 100);
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->string('no_pegawai', 30)->nullable();
            $table->string('alamat');
            $table->string('no_telp');
            $table->foreignId('mapel_id')->nullable()->constrained('mapels')->onDelete('set null');
            // $table->integer('total_jam_mingguan')->default(24);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
