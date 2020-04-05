<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->increments('id_direc');
            $table->string('direc_name')->unique();
            $table->string('direc_description')->nullable();
            $table->string('direc_email')->nullable();
            $table->string('direc_phone')->nullable();
            $table->string('direc_status', 20)->index();
            $table->string('folder_path', 100)->index();
            $table->timestamps();

            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directions');
    }
}
