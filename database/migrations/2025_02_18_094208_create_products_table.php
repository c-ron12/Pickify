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
        Schema::create('products', function (Blueprint $table) {  // this is the product table which will be created in the database with this column name
            $table->id(); // this id is connected to the user_id in the cart table
            $table->string('category', 50);
            $table->string('product_name', 50);
            $table->string('brand', 50);
            $table->string('image')->nullable();
            $table->longText('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
