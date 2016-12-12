<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 广告管理
 * @package App\Models
 */
class Site_Banner extends Model
{

    protected $table = "site_banner";
    protected $fillable = ['name', 'code', 'pic', 'url', 'target', 'state', 'sort', 'remark'];
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
