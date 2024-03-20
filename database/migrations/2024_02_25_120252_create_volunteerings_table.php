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
        Schema::create('volunteerings', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->json('address');
            $table->unsignedBigInteger('region_id');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('status', ['0', '1']);
            $table->decimal('hours_worked', 8, 2)->nullable();
            $table->string('link');
            $table->integer('attendance_number')->nullable();
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('regions')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteerings');
    }
};
