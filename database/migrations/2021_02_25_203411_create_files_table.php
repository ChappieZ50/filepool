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
            $table->id();

            // Auto generated file name
            $table->string('file_id');
            // Auto generated file name with extension
            $table->string('file_full_id');
            // File extension
            $table->string('file_mime');
            // File original name: "myfile" (Without extension)
            $table->string('file_original_id')->nullable();

            // File size by bytes
            $table->string('file_size')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            // Storage name | for now only have "local" and "aws"
            $table->string('uploaded_to');
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
