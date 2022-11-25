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
        Schema::create('keywords', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('keyword')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_keyword', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('keyword_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('keyword_id')
                ->references('id')
                ->on('keywords')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'keyword_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_keyword');
        Schema::dropIfExists('keywords');
    }
};
