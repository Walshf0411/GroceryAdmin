<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger("customer_id")->unsigned()->index();
            $table->foreign("customer_id")->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger("address_id")->unsigned()->index();
            $table->foreign("address_id")->references('id')->on('address')->onDelete('cascade');
            $table->float("amount");
            $table->float("delivery_charges");
            $table->float("total_amount");
            $table->string("timeslot");
            $table->string("status");
            $table->float("rider_id");
            $table->string("mode_of_payment");
            $table->date("date_of_delivery");
            $table->string("payment_id")->nullable()->change();
            $table->string("comment")->nullable()->change();
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
        Schema::dropIfExists('order');
    }
}
