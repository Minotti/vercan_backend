<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\Supplier\Enums\SupplierTypeEnum;
use App\Modules\Supplier\Enums\SupplierIeIndicatorEnum;
use App\Modules\Supplier\Enums\SupplierTypeGatheringEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('name')->nullable();
            $table->string('nickname')->nullable();
            $table->enum('type', array_column(SupplierTypeEnum::cases(), 'value'))->default(SupplierTypeEnum::Fisica->value);
            $table->string('cpf_cnpj', 14);
            $table->string('rg', 10)->nullable();
            $table->boolean('active')->default(true);
            $table->enum('ie_indicator', array_column(SupplierIeIndicatorEnum::cases(), 'value'))->nullable();
            $table->string('ie', 50)->nullable();
            $table->string('im', 50)->nullable();
            $table->enum('gathering', array_column(SupplierTypeGatheringEnum::cases(), 'value'))->nullable();
            $table->text('observation')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
