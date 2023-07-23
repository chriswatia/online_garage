<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->text('description');
            $table->float('rate');
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('service_id');
            $table->float('rate');
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
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_items');
    }
}
