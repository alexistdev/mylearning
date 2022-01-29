<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditMapels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapels', function (Blueprint $table) {
            $table->bigInteger('guru_id')->unsigned();
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });

//        Schema::table('mapels', function (Blueprint $table) {
//            $table->foreignId('guru_id')->constrained('gurus')
//                ->onUpdate('cascade')
//                ->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
