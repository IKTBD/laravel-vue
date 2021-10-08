<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',10)->default('');
            $table->string('app_key_id',10)->default('');
            $table->string('token',100)->default('');
            $table->string('expire_time',50)->default('');
            $table->string('date',20)->default('');
            $table->string('time',20)->default('');
            $table->string('timestamp',50)->default('');
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
        Schema::dropIfExists('api_tokens');
    }
}
