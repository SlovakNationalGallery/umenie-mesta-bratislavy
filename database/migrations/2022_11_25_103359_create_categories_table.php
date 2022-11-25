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
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_category', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('category_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('categories');
    }
};
