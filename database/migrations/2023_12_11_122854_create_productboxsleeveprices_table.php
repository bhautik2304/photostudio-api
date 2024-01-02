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
        Schema::create('productboxsleeveprices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productboxsleeve_id')->constrained()->onDelete('cascade');
            $table->foreignId('countryzone_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('price');
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
        Schema::dropIfExists('productboxsleeveprices');
    }
};
