<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_sale', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('sale_id')->unsigned();

            $table->foreign('article_id')->references('id')->on('articles')
                ->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_sale');
    }
}
