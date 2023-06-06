<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabinetFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinet_files', function (Blueprint $table) {
            $table->increments('id');
            //$table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->string('title');
            $table->string('file');

            //$table->foreign('category_id')->references('id')->on('cabinet_categories');
            $table->foreign('sub_category_id')->references('id')->on('cabinet_sub_categories');
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
        Schema::dropIfExists('cabinet_files');
    }
}
