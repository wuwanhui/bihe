<?php

namespace App\Http\Controllers\Manage\System;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Manage\BaseController;
use App\Models\System_Config;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ConfigController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * 编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $respJson = new RespJson();
        try {
            return response()->redirectTo('/manage/system/config/edit');
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    /**
     * 编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit(Request $request)
    {
        $respJson = new RespJson();
        try {
            $config = System_Config::first();

            if (isset($request->json)) {
                $respJson->setData($config);
                return response()->json($respJson);
            }
            return view('manage.system.config.edit', compact('config'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    /**
     * 编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        $respJson = new RespJson();
        try {
            $config = new System_Config();
            $input = $request->all();
            $validator = Validator::make($input, $config->Rules(), $config->messages());
            if ($validator->fails()) {
                $respJson->setCode(2);
                $respJson->setMsg("效验失败");
                Log::info(json_encode($validator));
                $respJson->setData($validator);
                return response()->json($respJson);
            }
            $config->fill($input);
            if ($config->save()) {
                Cache::pull('config');
                $respJson->setData($config);
                return response()->json($respJson);
            }
            $respJson->setCode(1);
            $respJson->setMsg("失败");
            return response()->json($respJson);

        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

}
