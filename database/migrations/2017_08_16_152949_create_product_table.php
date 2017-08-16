<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{

    public function up()
    {
       Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->text('description')->nullable();
            $table->string('quantity');
            $table->decimal('price', 5, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
  
    public function down()
    {
        Schema::drop('product');
    }
}
