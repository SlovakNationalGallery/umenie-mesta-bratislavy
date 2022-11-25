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

        Schema::create('signatures', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_signature', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('signature_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('signature_id')
                ->references('id')
                ->on('signatures')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'signature_id']);
        });

        Schema::create('conditions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_condition', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('condition_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('condition_id')
                ->references('id')
                ->on('conditions')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'condition_id']);
        });

        Schema::create('registrations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_registration', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('registration_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('registration_id')
                ->references('id')
                ->on('registrations')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'registration_id']);
        });

        Schema::create('proprietors', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_proprietor', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('proprietor_id');
            $table->string('role');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('proprietor_id')
                ->references('id')
                ->on('proprietors')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'proprietor_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_proprietor');
        Schema::dropIfExists('proprietors');
        Schema::dropIfExists('artwork_registration');
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('artwork_condition');
        Schema::dropIfExists('conditions');
        Schema::dropIfExists('artwork_signature');
        Schema::dropIfExists('signatures');
        Schema::dropIfExists('artwork_technique');
        Schema::dropIfExists('techniques');
        Schema::dropIfExists('artwork_material');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('categories');
    }
};
