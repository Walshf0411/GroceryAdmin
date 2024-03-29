<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_vendors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("shop_name");
            $table->string("address");
            $table->string("email_id")->unique();
            $table->string("password");
            $table->string("mobile_number")->unique();
            $table->string("gst_number");
            $table->string("message");
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
        Schema::dropIfExists('temp_vendors');
    }
}
