<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_products', function (Blueprint $table) {

                $table->id();
                $table->bigInteger("vendor_id")->unsigned()->index();
                $table->foreign("vendor_id")->references('id')->on('vendors')->onDelete('cascade');
                $table->bigInteger("category_id")->unsigned()->index();
                $table->foreign("category_id")->references('id')->on('categories')->onDelete('cascade');
                $table->string("temp_product_name");
                $table->string("images");
                $table->string("unit");
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
        Schema::dropIfExists('temp_products');
    }
}
