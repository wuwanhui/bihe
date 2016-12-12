<?php

namespace App\Http\Controllers\Manage\System;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Member_User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MemberController extends BaseController
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
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $respJson = new RespJson();
        try {
            $list = Member_User::where(function ($query) use ($request) {
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
            return view('manage.system.member.index', compact('list'));
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
            $member = new Member_User();
            return view('manage.system.member.create', compact('member'));
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
            $member = new Member_User();
            $inputs = $request->all();
            $validator = Validator::make($inputs, $member->Rules(), $member->messages());
            if ($validator->fails()) {
                $respJson->setCode(2);
                $respJson->setMsg("效验失败");
                $respJson->setData($validator);
                return response()->json($respJson);
            }
            $member->fill($inputs);
            if ($member->save()) {
                $respJson->setData($member);
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
            $member = Member_User::find($id);
            if (!$member) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }

            return view('manage.system.member.edit', compact('member'));
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
            $member = Member_User::find($id);
            if (!$member) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }
            $member->fill($request->all());
            if ($member->save()) {

//                $job = new CustomerChangeJob($member);
//                $job->onQueue('emails')->delay(Carbon::now()->addMinutes(1));

//                dispatch($job);
                $respJson->setData($member);
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
            $member = Member_User::find($id);
            if (!$member) {
                return Redirect::route('alert')->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {

                $member->fill($request->all());
                $member->save();
                if ($member) {
                    $respJson->setData($member);
                    return response()->json($respJson);
                }
                $respJson->setMsg("修改失败");
                return response()->json($respJson);
            }
            return view('manage.system.member.detail', compact('member'));
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
            $count = Member_User::destroy($ids);

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
            $list = Member_User::where(function ($query) use ($request) {
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
