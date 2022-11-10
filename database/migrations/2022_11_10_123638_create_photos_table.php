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
        Schema::create('photos', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_photo', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('photo_id');
            $table->smallInteger('order');
            $table->timestamps();

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('photo_id')
                ->references('id')
                ->on('photos')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_photo');
        Schema::dropIfExists('photos');
    }
};
