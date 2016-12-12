@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <validator name="validator">
                <form enctype="multipart/form-data" class="form-horizontal" customer="form" method="POST"
                      novalidate>
                    <div class="box-body">
                        <div class="col-xs-12">

                            <fieldset>
                                <legend>基本信息</legend>
                                <input type="hidden" id="customer_id" v-model="menu.parent_id">
                                <div class="form-group">
                                    <label for="customer_id" class="col-sm-2 control-label">所属上级：</label>
                                    <div class="col-sm-10">
                                        <select id="parent_id" name="sex" class="form-control"
                                                v-model="menu.customer_id"
                                                :class="{ 'error': $validator.parent_id.invalid && trySubmit }" number
                                                v-validate:parent_id="{ required: true}">
                                            <option value="0" selected>顶级</option>
                                            <option v-bind:value="item.id" v-for="item in menuList"
                                                    v-text="item.name"></option>
                                        </select>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">栏目名称：</label>
                                    <div class="col-sm-4">
                                        <input id="name" type="text" class="form-control" name="name"
                                               v-model="menu.name"
                                               :class="{ 'error': $validator.name.invalid && trySubmit }"
                                               v-validate:name="{ required: true}" placeholder="不能为空">

                                    </div>
                                    <label for="code" class="col-sm-2 control-label">标识：</label>

                                    <div class="col-sm-4">
                                        <input id="code" type="text" class="form-control" name="code"
                                               v-model="menu.code">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="url" class="col-sm-2 control-label">连接地址：</label>

                                    <div class="col-sm-4">
                                        <input id="url" name="url" type="text" class="form-control "
                                               v-model="menu.url">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="target" class="col-sm-2 control-label">打开方式：</label>
                                    <div class="col-sm-4">
                                        <select id="target" name="target" class="form-control"
                                                style="width: auto;" v-model="menu.target">
                                            <option value="" selected>当前窗口</option>
                                            <option value="_blank">新窗口</option>
                                        </select>
                                    </div>
                                    <label for="isShow" class="col-sm-2 control-label">是否显示：</label>
                                    <div class="col-sm-4">
                                        <select id="isShow" name="isShow" class="form-control"
                                                style="width: auto;" v-model="menu.isShow">
                                            <option value="0" selected>显示</option>
                                            <option value="1">不显示</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="icon" class="col-sm-2 control-label">图标：</label>
                                    <div class="col-sm-4">
                                        <input id="icon" name="icon" type="text" class="form-control "
                                               v-model="menu.icon"
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="col-sm-2 control-label">状态：</label>
                                    <div class="col-sm-4">
                                        <select id="state" name="state" class="form-control"
                                                style="width: auto;" v-model="menu.state">
                                            <option value="0" selected>正常</option>
                                            <option value="1">禁用</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="remark" class="col-sm-2 control-label">内部备注：</label>

                                    <div class="col-sm-10">
                                            <textarea id="remark" type="text" class="form-control"
                                                      style="width: 100%;height:50px;"
                                                      v-model="menu.remark"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-xs-12  text-center">
                                <button type="button" class="btn btn-default" onclick="parent.layer.close(frameindex)">
                                    关闭
                                </button>
                                <button type="button" class="btn  btn-primary"
                                        v-bind:class="{disabled1:$validator.invalid}" v-on:click="save($validator)">保存
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </validator>
        </div>
    </section>
@endsection
@section('script')
    <script type="application/javascript">
        var frameindex = parent.layer.getFrameIndex(window.name);
        parent.layer.iframeAuto(frameindex);
        var vm = new Vue({
            el: '.content',
            data: {
                trySubmit: false,
                menu: jsonFilter('{{json_encode($menu)}}'),
                menuList: []
            },
            watch: {},
            ready: function () {
                this.initParent();
                if (parent.vm.menu) {
                    this.menu.parent_id = parent.vm.menu.id;
                }
            },

            methods: {

                initParent: function () {
                    var _self = this;
                    this.$http.get("{{url('/manage/site/menu/api/list')}}")
                            .then(function (response) {
                                        if (response.data.code == 0) {
                                            _self.menuList = response.data.data;
                                            return
                                        }
                                        parent.layer.alert(JSON.stringify(response));
                                    }
                            );
                },

                save: function (form) {
                    var _self = this;

                    if (form.invalid) {
                        //this.$log('menu');
                        this.trySubmit = true;
                        return;
                    }

                    this.$http.post("{{url('/manage/site/menu/create')}}", this.menu)
                            .then(function (response) {
                                        if (response.data.code == 0) {
                                            parent.msg('新增成功');
                                            parent.layer.close(frameindex);
                                            parent.vm.init();
                                            return
                                        }
                                        parent.layer.alert(JSON.stringify(response));
                                    }
                            );
                }

            }
        });
    </script>
@endsection
