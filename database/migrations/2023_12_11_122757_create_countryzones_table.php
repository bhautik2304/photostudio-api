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
        Schema::create('countryzones', function (Blueprint $table) {
            $table->id();
            $table->string('zonename');
            $table->unsignedBigInteger('shipingcharge');
            $table->enum('currency_sign', ['$', '€', '£', '¥', '₹'])->default('$');
            $table->text('img')->nullable();
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
        Schema::dropIfExists('countryzones');
    }
};