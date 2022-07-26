<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('item_code')->unique();
            $table->string('item_name');
            $table->enum('order_status', ['O', 'P', 'D'])->default('O');
            $table->integer('pickup_address_id');
            $table->integer('delivery_address_id');
            $table->dateTime('picked_at')->nullable();
            $table->integer('picked_by')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->integer('delivered_by')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
