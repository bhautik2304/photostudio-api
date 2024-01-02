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
        Schema::create('coversupgradecolors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coversupgrade_id')->constrained('coversupgrades')->onDelete('cascade');
            $table->string('name');
            $table->string('colorcode')->nullable();
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
        Schema::dropIfExists('coversupgradecolors');
    }
};
