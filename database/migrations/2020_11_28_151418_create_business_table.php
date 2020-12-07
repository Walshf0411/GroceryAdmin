<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("product_id")->unsigned()->index();
            $table->foreign("product_id")->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger("category_id")->unsigned()->index();
            $table->foreign("category_id")->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger("vendor_id")->unsigned()->index();
            $table->foreign("vendor_id")->references('id')->on('vendors')->onDelete('cascade');
            $table->string("price");
            $table->string("description");
            $table->string("images");
            $table->bigInteger("stocks");
            $table->bigInteger("discount");
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
        Schema::dropIfExists('business');
    }
}
