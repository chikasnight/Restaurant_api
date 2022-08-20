<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('table_1', ['available', 'unavailable']);
            $table->enum('table_2', ['available', 'unavailable']);
            $table->enum('table_3', ['available', 'unavailable']);
            $table->enum('table_4', ['available', 'unavailable']);
            $table->enum('table_5', ['available', 'unavailable']);
            $table->enum('table_6', ['available', 'unavailable']);
            $table->enum('table_7', ['available', 'unavailable']);
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
        Schema::dropIfExists('tables');
    }
};
