<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name')->nullable(true);
            $table->text('slug')->nullable(true);
            $table->text('status')->nullable(true);
            $table->text('typ')->nullable(true);
            $table->text('email')->nullable(true);
            $table->text('tel')->nullable(true);
            $table->text('adres')->nullable(true);
            $table->text('poczta_info')->nullable(true);
            $table->text('direct_patch')->nullable(true);
            $table->text('description')->nullable(true);
            
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
        Schema::dropIfExists('user_datas');
    }
}
