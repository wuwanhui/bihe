<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_take', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trader_account');//操盘账号
            $table->float('money')->default(0);//提现金额
            $table->string('open_name')->nullable();//开户姓名
            $table->string('bank')->nullable();//银行
            $table->string('account')->nullable();//帐户
            $table->string('mobile')->nullable();//手机号
            $table->integer('manage_id')->default(0);//审核人
            $table->string('accessory')->nullable();//凭证
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
        Schema::drop('finance_take');
    }
}
