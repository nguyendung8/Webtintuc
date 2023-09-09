<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVpProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vp_products', function (Blueprint $table) {
            $table->id('prod_id');
            $table->string('prod_name');
            $table->string('prod_slug');
            $table->integer('prod_price');
            $table->string('prod_img');
            $table->string('prod_warranty'); //bảo hành
            $table->string('prod_accessories'); // phụ kiện
            $table->string('prod_condition'); // tình trạng của sản phẩm còn mới hay cũ
            $table->string('prod_promotion'); // khuyến mại
            $table->tinyInteger('prod_status'); //  còn hành hay ko
            $table->text('prod_description');
            $table->tinyInteger('prod_featured'); // sp đặc biệt
            $table->unsignedBigInteger('prod_cate');
            $table->foreign('prod_cate')
                  ->references('cate_id')
                  ->on('vp_categories')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vp_products');
    }
}
