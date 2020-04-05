<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expiditeur')->nullable();
            $table->string('destinataire')->nullable();
            $table->string('objet')->nullable();
            $table->string('num_text')->nullable();
            $table->string('num_enrg')->nullable();
            $table->integer('nombre_page')->nullable()->default(1);
            $table->string('importance')->nullable();
            $table->string('communication_a')->nullable();
            $table->date('date_arrivee')->nullable();
            $table->time('heur_arrivee')->nullable();
            $table->string('sig_ext')->nullable();
            $table->string('sig_int')->nullable();
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_path');
            $table->string('mime');
            $table->unsignedInteger('ref_user');

            $table->foreign('ref_user')
                ->references('ref_user')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('files');
    }
}
