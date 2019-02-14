<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('orderable');
            $table->unsignedInteger('user_id');
            $table->string('order_no', 10);
            $table->string('status_order')->default("WAITING");
            $table->datetime('datetime_paid')->nullable();
            $table->string('shipping_code', 8)->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
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
