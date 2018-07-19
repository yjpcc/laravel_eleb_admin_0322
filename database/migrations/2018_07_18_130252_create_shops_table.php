<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_category_id')->comment('店铺分类id');
            $table->string('shop_name')->comment('名称');
            $table->string('shop_img')->default('')->comment('店铺图片');
            $table->decimal('shop_rating')->default(0)->comment('评分');
            $table->boolean('brand')->default(0)->comment('是否是品牌');
            $table->boolean('on_time')->default(0)->comment('是否准时达');
            $table->boolean('fengniao')->default(0)->comment('是否蜂鸟配送');
            $table->boolean('bao')->default(0)->comment('是否保标记');
            $table->boolean('piao')->default(0)->comment('是否票标记');
            $table->boolean('zhun')->default(0)->comment('是否准标记');
            $table->decimal('start_send')->comment('起送金额');
            $table->decimal('send_cost')->comment('配送费');
            $table->string('notice')->default('')->comment('店公告');
            $table->string('discount')->default('')->comment('优惠信息');
            $table->tinyInteger('status')->comment('状态: 1正常,0待审核,-1禁用');
            $table->timestamps();
//            $table->foreign('shop_category_id')->references('id')->on('shop_categories');
            $table->engine='InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
