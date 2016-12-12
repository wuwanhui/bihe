<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classify_id');//所属栏目
            $table->string('name');//标题
            $table->string('pic')->nullable();//标题图片
            $table->string('ico')->nullable();//标题图标
            $table->string('author')->nullable();//作者
            $table->string('content')->nullable();//内容
            $table->integer('stick')->default(0);//置顶
            $table->integer('recommend')->default(0);//推荐
            $table->string('url')->nullable();//连接
            $table->string('accessory')->nullable();//附件信息
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
        Schema::drop('site_info');
    }
}
