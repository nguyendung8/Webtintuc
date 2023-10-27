<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateVpCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vp_comments', function (Blueprint $table) {
            $table->id('com_id');
            $table->string('com_email');
            $table->string('com_name');
            $table->string('com_content');
            $table->unsignedBigInteger('com_product');
            $table->foreign('com_product')
                  ->references('prod_id')
                  ->on('vp_products')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('vp_users')->onDelete('cascade');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vp_comments');
    }
}
