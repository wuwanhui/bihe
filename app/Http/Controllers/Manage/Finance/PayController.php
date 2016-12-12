<?php

namespace App\Http\Controllers\Manage\Finance;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Facades\Weixin;
use App\Models\Finance_Pay;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PayController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $respJson = new RespJson();
        try {
            $list = Finance_Pay::where(function ($query) use ($request) {
                if (isset($request->state) && $request->state != -1) {
                    $query->where('state', $request->state);
                }

                if (isset($request->key)) {
                    $query->Where('name', 'like', '%' . $request->key . '%');
                }
            })->orderBy('id', 'desc')->paginate($this->pageSize);

            if (isset($request->json)) {
                $respJson->setData($list);
                return response()->json($respJson);
            }
            return view('manage.finance.pay.index', compact('list'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    public function getCreate(Request $request)
    {
        $respJson = new RespJson();
        try {
            $pay = new Finance_Pay();
            return view('manage.finance.pay.create', compact('pay'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    public function postCreate(Request $request)
    {
        $respJson = new RespJson();
        try {
            $pay = new Finance_Pay();
            $inputs = $request->all();
            $validator = Validator::make($inputs, $pay->Rules(), $pay->messages());
            if ($validator->fails()) {
                $respJson->setCode(2);
                $respJson->setMsg("效验失败");
                $respJson->setData($validator);
                return response()->json($respJson);
            }
            $pay->fill($inputs);
            if ($pay->save()) {
                $respJson->setData($pay);
                return response()->json($respJson);
            }
            $respJson->setCode(1);
            $respJson->setMsg("新增失败");
            return response()->json($respJson);
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    public function getEdit(Request $request)
    {
        $respJson = new RespJson();
        try {
            $id = $request->id;
            if (!$id) {
                return Redirect::route('alert')->with('message', '参数不存在！');
            }
            $id = $request->id;
            $pay = Finance_Pay::find($id);
            if (!$pay) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }

            return view('manage.finance.pay.edit', compact('pay'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    public function postEdit(Request $request)
    {
        $respJson = new RespJson();
        try {
            $id = $request->id;
            if (!$id) {
                return Redirect::route('alert')->with('message', '参数不存在！');
            }
            $id = $request->id;
            $pay = Finance_Pay::find($id);
            if (!$pay) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }
            $pay->fill($request->all());
            if ($pay->save()) {

//                $job = new CustomerChangeJob($pay);
//                $job->onQueue('emails')->delay(Carbon::now()->addMinutes(1));

//                dispatch($job);
                $respJson->setData($pay);
                return response()->json($respJson);
            }
            $respJson->setMsg("修改失败");
            return response()->json($respJson);
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }


    public function getDetail(Request $request)
    {
        $respJson = new RespJson();
        try {
            $id = $request->id;
            if (!$id) {
                return Redirect::route('alert')->with('message', '参数不存在！');
            }
            $id = $request->id;
            $pay = Finance_Pay::find($id);
            if (!$pay) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {

                $pay->fill($request->all());
                $pay->save();
                if ($pay) {
                    $respJson->setData($pay);
                    return response()->json($respJson);
                }
                $respJson->setMsg("修改失败");
                return response()->json($respJson);
            }
            return view('manage.finance.pay.detail', compact('pay'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }


    public function delete(Request $request)
    {
        $respJson = new RespJson();
        try {
            $ids = $request->ids;
            if (!$ids) {
                $respJson->setCode(2);
                $respJson->setMsg('参数错误');
                return response()->json($respJson);
            }
            $count = Finance_Pay::destroy($ids);

            if ($count > 0) {
                $respJson->setMsg('删除成功');
                $respJson->setData($count);
                return response()->json($respJson);
            }
            $respJson->setCode(1);
            $respJson->setMsg('删除失败');
            return response()->json($respJson);

        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }


    /**
     * API
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        $respJson = new RespJson();
        try {
            $list = Finance_Pay::where(function ($query) use ($request) {
                if (isset($request->createId)) {
                    $query->where('createId', $request->createId);
                }
                if (isset($request->state) && $request->state != -1) {
                    $query->where('state', $request->state);
                }
            })->orderBy('id', 'desc')->select('id', 'name')->get();

            $respJson->setData($list);
            return response()->json($respJson);
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

}