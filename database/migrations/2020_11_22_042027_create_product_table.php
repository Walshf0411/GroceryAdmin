<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->integer("banner_rank")->unique();
            $table->bigInteger("category_id")->unsigned()->index();
            $table->foreign("category_id")->references('id')->on('categories')->onDelete('cascade');
            $table->string("name");
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
        Schema::dropIfExists('products');

    }
}
