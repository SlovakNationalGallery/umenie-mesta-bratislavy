<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('earliest')->nullable();
            $table->integer('latest')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();

            $table->index('type');
        });

        Schema::create('artwork_year', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('year_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('year_id')
                ->references('id')
                ->on('years')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'year_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_year');
        Schema::dropIfExists('years');
    }
};
