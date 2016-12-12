<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 栏目分类
 * @package App\Models
 */
class Site_Classify extends Model
{

    protected $table = "site_classify";
    protected $fillable = ['name', 'state', 'sort', 'remark'];
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
