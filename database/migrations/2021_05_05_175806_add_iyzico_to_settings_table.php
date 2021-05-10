<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIyzicoToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('iyzico_api_key')->nullable();
            $table->string('iyzico_secret_key')->nullable();
            $table->boolean('iyzico_sandbox')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('iyzico_api_key', 'iyzico_secret_key', 'iyzico_sandbox');
        });
    }
}
