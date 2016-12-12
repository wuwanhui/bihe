<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 内容
 * @package App\Models
 */
class Site_Info extends Model
{

    protected $table = "site_info";
    protected $fillable = ['classify_id', 'name', 'pic', 'ico', 'author', 'content', 'stick', 'recommend', 'url', 'accessory', 'state', 'sort', 'remark'];
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
