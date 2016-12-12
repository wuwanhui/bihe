<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Create table for storing permissions
        Schema::create('site_classify', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//名称
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
        Schema::drop('site_classify');
    }
}
