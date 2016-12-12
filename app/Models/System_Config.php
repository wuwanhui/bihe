<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 系统参数
 * @package App\Models
 */
class System_Config extends Model
{

    protected $table = "system_config";
    protected $fillable = ['name', 'logo', 'domain', 'keyword', 'description','linkMan','mobile','tel','fax','qq','email','addres','state','remark'];
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
