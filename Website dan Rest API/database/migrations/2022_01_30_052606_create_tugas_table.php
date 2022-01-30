<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('deskripsi');
            $table->string('lampiran');
            $table->date('batas_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}
