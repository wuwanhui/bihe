@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            系统参数
            <small>设置</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 管理中心</a></li>
            <li class="active">系统参数</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <validator name="validator">
                    <form class="form-horizontal" :class="{ 'error': $validator.invalid && trySubmit }"
                          novalidate>

                        <fieldset>
                            <legend>基本信息</legend>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">站点名称：</label>

                                <div class="col-md-10">
                                    <input id="name" name='name' type="text" class="form-control"
                                           :class="{ 'error': $validator.name.invalid  && trySubmit}"
                                           v-model="config.name"
                                           placeholder="必填项"
                                           v-validate:name="{ required: true, minlength: 2 }">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-md-2 control-label">标志：</label>

                                <div class="col-md-10">
                                    <input id="logo" type="text" class="form-control"
                                           name="logo"
                                           v-model="config.logo">

                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="domain" class="col-md-2 control-label">平台地址：</label>

                                <div class="col-md-10">
                                    <input id="domain" name="domain" type="text" class="form-control"
                                           :class="{ 'error': $validator.domain.invalid  && trySubmit}"
                                           v-model="config.domain"
                                           placeholder="必填项"
                                           v-validate:domain="{ required: true}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keyword" class="col-md-2 control-label">关键字：</label>

                                <div class="col-md-10">
                                    <input id="keyword" type="text" class="form-control" name="keyword"
                                           v-model="config.keyword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-2 control-label">描述：</label>

                                <div class="col-md-10">
                                       <textarea id="description" type="text" class="form-control"
                                                 style="width: 100%;height:50px;"
                                                 v-model="config.description"></textarea>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="linkMan" class="col-md-2 control-label">联系人：</label>

                                <div class="col-md-10">
                                    <input id="linkMan" type="text" class="form-control" name="linkMan"
                                           style="width: auto;"
                                           v-model="config.linkMan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile" class="col-md-2 control-label">手机号：</label>

                                <div class="col-md-10">
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                           style="width: auto;"
                                           v-model="config.mobile">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tel" class="col-md-2 control-label">电话：</label>

                                <div class="col-md-10">
                                    <input id="tel" type="text" class="form-control" name="tel"
                                           style="width: auto;"
                                           v-model="config.tel">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fax" class="col-md-2 control-label">传真：</label>

                                <div class="col-md-10">
                                    <input id="fax" type="text" class="form-control" name="fax"
                                           style="width: auto;"
                                           v-model="config.fax">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qq" class="col-md-2 control-label">QQ：</label>

                                <div class="col-md-10">
                                    <input id="qq" type="text" class="form-control" name="qq"
                                           style="width: auto;"
                                           v-model="config.qq">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">Email：</label>

                                <div class="col-md-10">
                                    <input id="email" type="email" class="form-control" name="email"
                                           v-model="config.email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addres" class="col-md-2 control-label">联系地址：</label>

                                <div class="col-md-10">
                                    <input id="addres" type="text" class="form-control" name="addres"
                                           v-model="config.addres">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>系统状态</legend>
                            <div class="form-group ">
                                <label for="state" class="col-md-2 control-label">状态：</label>

                                <div class="col-md-10">
                                    <select id="state" name="state" class="form-control"
                                            style="width: auto;"
                                            v-model="config.state">
                                        <option value="0">正常</option>
                                        <option value="2">维护</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="remark" class="col-md-2 control-label">维护信息：</label>

                                <div class="col-md-10">
                                       <textarea id="remark" type="text" class="form-control"
                                                 style="width: 100%;height:50px;"
                                                 v-model="config.remark"></textarea>

                                </div>
                            </div>
                        </fieldset>
                        <div class="text-center">
                            <button type="button" class="btn btn-default"
                                    onclick="vbscript:window.history.back()">返回
                            </button>
                            <button type="button" class="btn  btn-primary ui fluid large teal submit button "
                                    v-on:click="save($validator)">保存
                            </button>
                        </div>
                    </form>
                </validator>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="application/javascript">
        var vm = new Vue({
            el: '.content',
            data: {
                trySubmit: false,
                config: {},
            },
            watch: {},
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    var _self = this;
                    //加载数据
                    this.$http.get('{{url('/manage/system/config/edit?json')}}').then(function (response) {
                        if (response.data.code == 0) {
                            if (response.data.data != null) {
                                _self.config = response.data.data;
                            }
                            return
                        }
                        layer.alert(JSON.stringify(response.data.data));

                    });
                },
                save: function (form) {
                    var _self = this;
                    if (form.invalid) {
                        //this.$log('config');
                        this.trySubmit = true;
                        return;
                    }
                    this.$http.post('{{url('/manage/system/config/edit')}}', _self.config).then(function (response) {
                        if (response.data.code == 0) {
                            _self.config = response.data.data;
                            msg('保存成功');
                            return;
                        }
                        layer.alert(JSON.stringify(response));

                    });

                }
            }
        });

    </script>
@endsection
