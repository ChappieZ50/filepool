<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            /* Website */
            $table->string('website_name')->nullable();
            $table->string('google_analytics')->nullable();
            $table->integer('max_file_size')->nullable();
            $table->integer('one_time_uploads')->nullable();
            $table->string('uploads_storage', 10)->default('local');
            $table->string('dropzone_text')->nullable();
            $table->string('browse_text')->nullable();
            $table->string('dropzone_rule')->nullable();
            $table->string('menu_title')->nullable();

            /* AWS API */
            $table->string('aws_access_key')->nullable();
            $table->string('aws_secret_access_key')->nullable();
            $table->string('aws_region')->nullable();
            $table->string('aws_bucket')->nullable();

            /* Login & Recaptcha API */
            $table->string('google_client_id')->nullable();
            $table->string('google_secret')->nullable();
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_secret')->nullable();
            $table->string('recaptcha_site_key')->nullable();
            $table->string('recaptcha_secret_key')->nullable();


            /* Logo & Favicon */
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('favicon_mime', 10)->nullable();


            /* Seo */
            $table->string('site_title')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_keywords')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
