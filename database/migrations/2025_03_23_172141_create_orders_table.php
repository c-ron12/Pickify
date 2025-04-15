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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('email');
            $table->string('delivery_address');
            $table->integer('quantity'); 
            $table->decimal('total_price', 10, 2); 
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();    //nullable for COD
            $table->string('status')->default('in process');
              
            
            $table->unsignedBigInteger('user_id')->constrained('users');
            $table->unsignedBigInteger('product_id')->constrained('products');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // user_id  is connected to the id in the users table
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade'); // product_id is connected to the id in the products table

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
