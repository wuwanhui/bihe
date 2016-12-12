<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Create table for storing permissions
        Schema::create('site_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//显示名称
            $table->string('code')->unique();//模块标识
            $table->string('parent_id')->nullable();//所属父级
            $table->string('url')->nullable();//栏目地址
            $table->string('target')->nullable();//连接打开方式
            $table->integer('isShow')->default(0);//是否显示
            $table->string('icon')->nullable();//图标标识
            $table->integer('state')->default(0);//状态
            $table->integer('sort')->default(0);//排序
            $table->text('remark')->nullable();//备注
            $table->softDeletes(); //软删除
            $table->timestamps(); //默认添加创建和更新时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_menu');
    }
}
