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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->foreignId('city_id')->constrained('cities');

            $table->string('postcode', 10);
            $table->string('address', 100);
            $table->string('district', 50);
            $table->string('number', 15);
            $table->string('info', 100)->nullable();
            $table->string('complement', 100)->nullable();
            $table->boolean('condominium')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
