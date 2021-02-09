<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product2', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("vendor_id")->unsigned()->index();
            $table->foreign("vendor_id")->references('id')->on('vendors')->onDelete('cascade');
            $table->bigInteger("category_id")->unsigned()->index();
            $table->foreign("category_id")->references('id')->on('categories')->onDelete('cascade');
            $table->string("name");
            $table->string("description");
            $table->float("price");
            $table->integer("unit");
            $table->string("images");
            $table->integer("discount");
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
        Schema::dropIfExists('product2');
    }
}
