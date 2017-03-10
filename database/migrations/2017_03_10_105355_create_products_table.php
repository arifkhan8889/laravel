<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cr_products', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title',100)->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('cr_categories')->onDelete('cascade')->onUpdate('restrict');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price',10,2)->nullable();
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
        Schema::drop('cr_products');
    }
}
