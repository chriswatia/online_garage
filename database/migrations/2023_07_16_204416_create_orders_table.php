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
            $table->date('order_date');
            $table->integer('user_id');
            $table->integer('mechanic_id');
            $table->string('supervisor');
            $table->integer('vehicle_type');
            $table->float('sub_total');
            $table->float('vat')->nullable();
            $table->float('total_amount');
            $table->float('discount')->nullable();
            $table->float('grand_total');
            $table->float('paid')->nullable();
            $table->float('due')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->float('rate');
            $table->float('total');
            $table->integer('created_by');
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
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_items');
    }
}
