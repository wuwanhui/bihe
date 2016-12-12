<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 菜单管理
 * @package App\Models
 */
class Site_Menu extends Model
{

    protected $table = "site_menu";
    protected $fillable = ['name', 'code', 'parent_id', 'url', 'isShow', 'icon', 'state', 'sort', 'remark'];
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
