<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sku_property_option')) {
            Schema::create('sku_property_option', function (Blueprint $table) {
                $table->id();
                $table->foreignId('property_option_id')
                    ->constrained('property_options')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId('sku_id')
                    ->constrained('skus')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_product');
    }
};
