<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//标题
            $table->string('code');//标识
            $table->string('pic')->nullable();//图片
            $table->string('url')->nullable();//连接
            $table->string('target')->nullable();//连接打开方式
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
        Schema::drop('site_banner');
    }
}
