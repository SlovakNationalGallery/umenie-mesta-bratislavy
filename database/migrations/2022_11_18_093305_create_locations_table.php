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
        Schema::create('locations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('borough')->nullable();
            $table->string('district')->nullable();
            $table->string('plot')->nullable();
            $table->string('description')->nullable();
            $table->decimal('gps_lon', 10, 7)->nullable();
            $table->decimal('gps_lat', 10, 7)->nullable();
            $table->boolean('is_current')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_location', function (Blueprint $table) {
            $table->string('artwork_id');
            $table->string('location_id');
            $table->smallInteger('order');

            $table
                ->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->cascadeOnDelete();
            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->cascadeOnDelete();

            $table->unique(['artwork_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_location');
        Schema::dropIfExists('locations');
    }
};
