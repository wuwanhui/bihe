<?php

namespace App\Http\Service;

use App\Models\Base_Maps;
use App\Models\Base_Type;
use App\Models\Site_Menu;
use App\Models\System_Config;
use App\Models\Enterprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * 基础服务
 * @package App\Http\Service
 */
class BaseService
{
    private $user = null;

    public function __construct()
    {

    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function user($key = null)
    {
        $this->user = Auth::guard('manage')->user();
        if ($key) {
            return $this->user->$key;
        } else {
            return $this->user;
        }

    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function manage($key = null)
    {
        $this->user = Auth::guard('manage')->user();
        if ($key) {
            return $this->user->$key;
        } else {
            return $this->user;
        }

    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function member($key = null)
    {
        $this->user = Auth::guard('member')->user();
        if ($key) {
            return $this->user->$key;
        } else {
            return $this->user;
        }

    }


    /**
     * 获取企业参数配置
     * @param $key
     * @return mixed
     */
    public function config($key = null)
    {
        $config = Cache::get('config', function () {
            $value = System_Config::first();
            if (isset($value)) {
                Cache::put(['config' => $value], 100);
                return $value;
            }
            return new System_Config();
        });

        if ($key) {
            return $config->$key;
        }
        return $config;

    }


    /**
     * 获取菜单
     * @param $key
     * @return mixed
     */
    public function menu($panent = null)
    {
        $menus = Cache::get('menu', function () {
            $value = Site_Menu::all();
            if (isset($value)) {
                Cache::put(['menu' => $value], 100);
                return $value;
            }
        });

        if (isset($panent)) {
            $menus->where('panent_id', $panent);
        }
        return $menus;

    }

}