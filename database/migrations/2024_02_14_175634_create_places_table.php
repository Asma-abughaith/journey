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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->json('address');
            $table->enum('business_status', ['closed', 'operational', 'temporary_closed']);
            $table->text('google_map_url');
            $table->decimal('longitude',10,6);
            $table->decimal('latitude',10,6);
            $table->string('phone_number')->nullable();
            $table->enum('price_level', ['-1','0','1', '2', '3','4'])->comment('-1 do not know 0 Free 1 Inexpensive 2 Moderate 3 Expensive 4 Very Expensive');
            $table->string('website')->nullable();
            $table->decimal('rating', 3, 2);
            $table->integer('total_user_rating');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
