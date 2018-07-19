<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('email')->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->tinyInteger('status')->comment('状态: 1启用,0禁用');
            $table->integer('shop_id')->comment('所属商家');
            $table->rememberToken();
            $table->timestamps();
//            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('shop_users');
    }
}
