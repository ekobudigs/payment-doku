<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->boolean('discount_status');
            $table->string('discount_type')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->boolean('allow_couple_photos');
            $table->boolean('allow_galleries');
            $table->boolean('allow_videos');
            $table->boolean('allow_google_maps');
            $table->boolean('allow_countdown');
            $table->boolean('allow_backsound');
            $table->boolean('allow_guest_book');
            $table->boolean('allow_guest_target');
            $table->boolean('allow_rsvp');
            $table->boolean('allow_gift');
            $table->tinyInteger('max_galleries')->nullable();
            $table->tinyInteger('max_videos')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
