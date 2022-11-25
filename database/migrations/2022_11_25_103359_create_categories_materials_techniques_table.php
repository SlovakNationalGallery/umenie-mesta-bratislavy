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

        Schema::create('materials', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_material', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('material_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('material_id')
                ->references('id')
                ->on('materials')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'material_id']);
        });

        Schema::create('techniques', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_technique', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('technique_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('technique_id')
                ->references('id')
                ->on('techniques')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'technique_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_technique');
        Schema::dropIfExists('techniques');
        Schema::dropIfExists('artwork_material');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('categories');
    }
};
