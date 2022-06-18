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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->text('address');
            $table->double('price');
            $table->enum('shipping_option', ['jne', 'jnt', 'sicepat']);
            $table->enum('payment_option', ['ovo', 'gopay', 'bank']);
            $table->text('payment_proof')->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('status', ['pending', 'check' , 'paid', 'process', 'delivering', 'delivered', 'done', 'cancelled']);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
