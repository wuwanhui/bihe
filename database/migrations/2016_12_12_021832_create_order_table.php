<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//站点名称
            $table->string('logo')->nullable();//系统Logo
            $table->string('domain')->nullable();//平台地址
            $table->string('keyword')->nullable();//关键字
            $table->string('description')->nullable();//描述
            $table->string('linkMan');//联系人
            $table->string('mobile');//手机号
            $table->string('tel')->nullable();//电话
            $table->string('fax')->nullable();//传真
            $table->string('qq')->nullable();//QQ号
            $table->string('email')->nullable();//电子邮件
            $table->string('addres')->nullable();//联系地址
            $table->integer('state')->default(0);//状态
            $table->text('remark')->nullable();//备注
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
