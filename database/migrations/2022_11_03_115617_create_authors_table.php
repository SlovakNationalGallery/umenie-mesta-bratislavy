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
        Schema::create('authors', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_author', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('author_id');
            $table->string('role');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'author_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_author');
        Schema::dropIfExists('authors');
    }
};
