<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name');
            $table->boolean('menu_type');
            $table->decimal('menu_price',8,2);
            $table->text('menu_description');
            $table->string('menu_imagepath');
            $table->string('menu_status')->default(0);
            $table->integer('toko_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('toko_id')
                ->references('id')
                ->on('stores')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('menus');
    }
}
