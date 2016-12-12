<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 提现记录
 * @package App\Models
 */
class Finance_Take extends Model
{

    protected $table = "finance_take";
    protected $fillable = ['name', 'domain', 'key', 'authNum', 'endTime', 'state'];
    protected $guarded = ['_token'];

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function Rules()
    {
        return [
            'name' => 'required|max:255|min:2',
        ];
    }


    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '系统名称为必填项',
        ];
    }

}
