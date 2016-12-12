<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 站点
 */
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@home');
    /**
     * 栏目
     */
    Route::group(['prefix' => 'classify'], function () {
        Route::get('/{id}', 'ClassifyController@index');


    });
    /**
     * 信息
     */
    Route::group(['prefix' => 'info'], function () {
        Route::get('/{id}', 'InfoController@index');

    });

    /**
     * 充值
     */
    Route::group(['prefix' => 'pay'], function () {
        Route::get('/', 'PayController@index');
        Route::any('/create/', 'PayController@create');
        Route::any('/edit/{id?}', 'PayController@edit');
        Route::get('/detail', 'PayController@detail');
        Route::post('/delete', 'PayController@delete');

    });

    /**
     * 提现
     */
    Route::group(['prefix' => 'take'], function () {
        Route::get('/', 'TakeController@index');
        Route::any('/create/', 'TakeController@create');
        Route::any('/edit/{id?}', 'TakeController@edit');
        Route::get('/detail', 'TakeController@detail');
        Route::post('/delete', 'TakeController@delete');

    });


    /**
     * 1、业务操作
     */
    Route::group(['prefix' => 'business', 'middleware' => 'auth.manage', 'namespace' => 'Business'], function () {
        Route::get('/', 'HomeController@index');

        //成本管理
        Route::group(['prefix' => 'cost'], function () {
            Route::get('/', 'CostController@index');
            Route::any('/create/', 'CostController@create');
            Route::any('/edit/{id?}', 'CostController@edit');
            Route::get('/detail', 'CostController@detail');
            Route::post('/delete', 'CostController@delete');
        });

        //团期管理
        Route::group(['prefix' => 'group'], function () {
            Route::get('/', 'TourGroupController@index');
            Route::get('/tourline', 'TourGroupController@tourline'); //团期线路表
            Route::get('/createsan', 'TourGroupController@createSan'); //增加散拼
            Route::get('/chooseline', 'TourGroupController@chooseLine'); //选择线路
            Route::get('/choosetraffic', 'TourGroupController@chooseTraffic'); //选择大交通
            Route::get('/choosegatherplace', 'TourGroupController@chooseGatherPlace'); //选择集合地
            Route::post('/tourline/save', 'TourGroupController@saveLine');  //保存线路信息
            Route::post('/save', 'TourGroupController@saveGroup');  //保存团队信息
            Route::post('/tourline/travel/save', 'TourGroupController@saveTravel'); //保存线路行程信息
            Route::post('/tourline/otherinfo/save', 'TourGroupController@saveOtherInfo'); //保存线路其他信息
        });

        //订单管理
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index'); //订单列表
            Route::get('/signup', 'OrderController@signUp'); //收客报名
        });


    });


    /**
     * 2、客户关系
     */
    Route::group(['prefix' => 'crm', 'middleware' => 'auth.manage', 'namespace' => 'CRM'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 客户档案
         */
        Route::group(['prefix' => 'customer', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'CustomerController@index');
            Route::get('/create', 'CustomerController@getCreate');
            Route::post('/create', 'CustomerController@postCreate');
            Route::get('/edit', 'CustomerController@getEdit');
            Route::post('/edit', 'CustomerController@postEdit');
            Route::get('/detail', 'CustomerController@getDetail');
            Route::post('/delete', 'CustomerController@delete');
            Route::get('/api/list', 'CustomerController@getList');
            /**
             * 客户-联系人
             */
            Route::group(['prefix' => 'linkman', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerLinkManController@index');
                Route::get('/create', 'CustomerLinkManController@getCreate');
                Route::post('/create', 'CustomerLinkManController@postCreate');
                Route::get('/edit', 'CustomerLinkManController@getEdit');
                Route::post('/edit', 'CustomerLinkManController@postEdit');
                Route::post('/delete', 'CustomerLinkManController@delete');
                Route::get('/api/list', 'CustomerLinkManController@getList');

            });
            /**
             * 客户-联系记录
             */
            Route::group(['prefix' => 'follow', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerFollowController@index');
                Route::get('/create', 'CustomerFollowController@getCreate');
                Route::post('/create', 'CustomerFollowController@postCreate');
                Route::get('/edit', 'CustomerFollowController@getEdit');
                Route::post('/edit', 'CustomerFollowController@postEdit');
                Route::post('/delete', 'CustomerFollowController@delete');

            });
            /**
             * 客户-积分
             */
            Route::group(['prefix' => 'integral', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerIntegralController@index');
                Route::get('/create', 'CustomerIntegralController@getCreate');
                Route::post('/create', 'CustomerIntegralController@postCreate');
                Route::get('/edit', 'CustomerIntegralController@getEdit');
                Route::post('/edit', 'CustomerIntegralController@postEdit');
                Route::post('/delete', 'CustomerIntegralController@delete');

            });

            /**
             * 客户-任务
             */
            Route::group(['prefix' => 'task', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerTaskController@index');
                Route::get('/create', 'CustomerTaskController@getCreate');
                Route::post('/create', 'CustomerTaskController@postCreate');
                Route::get('/edit', 'CustomerTaskController@getEdit');
                Route::post('/edit', 'CustomerTaskController@postEdit');
                Route::post('/delete', 'CustomerTaskController@delete');
                Route::get('/api/list', 'CustomerTaskController@getList');


            });
        });

        /**
         * 微信营销
         */
        Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinAttentionController@index');
            Route::get('/create', 'WeixinAttentionController@getCreate');
            Route::post('/create', 'WeixinAttentionController@postCreate');
            Route::get('/edit', 'WeixinAttentionController@getEdit');
            Route::post('/edit', 'WeixinAttentionController@postEdit');
            Route::post('/delete', 'WeixinAttentionController@delete');
        });

    });


    /**
     * 2、微信营销
     */
    Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage', 'namespace' => 'Weixin'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 关注者
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinUserController@index');
            Route::get('/create', 'WeixinUserController@getCreate');
            Route::post('/create', 'WeixinUserController@postCreate');
            Route::get('/edit', 'WeixinUserController@getEdit');
            Route::post('/edit', 'WeixinUserController@postEdit');
            Route::get('/detail', 'WeixinUserController@getDetail');
            Route::post('/delete', 'WeixinUserController@delete');
            Route::get('/api/list', 'WeixinUserController@getList');
            Route::post('/sync', 'WeixinUserController@sync');
            Route::post('/update', 'WeixinUserController@update');
            Route::post('/remark', 'WeixinUserController@remark');

            /**
             * 用户标签
             */
            Route::group(['prefix' => 'tags', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'WeixinUserTagsController@index');
                Route::get('/create', 'WeixinUserTagsController@getCreate');
                Route::post('/create', 'WeixinUserTagsController@postCreate');
                Route::get('/edit', 'WeixinUserTagsController@getEdit');
                Route::post('/edit', 'WeixinUserTagsController@postEdit');
                Route::post('/delete', 'WeixinUserTagsController@delete');
                Route::post('/sync', 'WeixinUserTagsController@sync');
                Route::post('/update', 'WeixinUserTagsController@update');

            });

        });

        /**
         * 二维码
         */
        Route::group(['prefix' => 'qrcode', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinQrcodeController@index');
            Route::get('/create', 'WeixinQrcodeController@getCreate');
            Route::post('/create', 'WeixinQrcodeController@postCreate');
            Route::get('/edit', 'WeixinQrcodeController@getEdit');
            Route::post('/edit', 'WeixinQrcodeController@postEdit');
            Route::post('/delete', 'WeixinQrcodeController@delete');

        });
    });


    /**
     * 3、资源管理
     */
    Route::group(['prefix' => 'resources', 'middleware' => 'auth.manage', 'namespace' => 'Resources'], function () {
        Route::get('/', 'HomeController@index');

        //线路类别管理
        Route::group(['prefix' => 'lineclass'], function () {
            Route::get('/', 'LineClassController@index');
            Route::any('/create', 'LineClassController@create');
            Route::any('/edit/{id?}', 'LineClassController@edit');
            Route::get('/detail', 'LineClassController@detail');
            Route::post('/delete', 'LineClassController@delete');
        });
        //线路管理
        Route::group(['prefix' => 'line'], function () {
            Route::get('/', 'LineController@index');
            Route::get('/create', 'LineController@create'); //新增页面
            Route::post('/line/save', 'LineController@saveLine');  //保存线路基本信息
            Route::post('/travel/save', 'LineController@saveTravel'); //保存线路行程信息
            Route::post('/otherinfo/save', 'LineController@saveOtherInfo'); //保存线路其他信息
            Route::any('/edit/{id?}', 'LineController@edit');
            Route::get('/detail', 'LineController@detail');
            Route::post('/delete', 'LineController@delete');
        });
        //资源商管理
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', 'SupplierController@index'); //资源商列表
            Route::get('/create', 'SupplierController@create'); //新增页面
            Route::post('/save', 'SupplierController@saveSupplier');  //保存资源商基本信息
            Route::post('/travel/save', 'SupplierController@saveTravel'); //保存线路行程信息
            Route::post('/otherinfo/save', 'SupplierController@saveOtherInfo'); //保存线路其他信息
            Route::any('/edit/{id?}', 'SupplierController@edit');
            Route::post('/delete', 'SupplierController@delete');

            //资源商-联系人管理
            Route::group(['prefix' => 'contacts'], function () {
                Route::get('/', 'SupplierContactController@index'); //供应商联系人管理
                Route::get('/create', 'SupplierContactController@create'); //新增页面
                Route::post('/save', 'SupplierContactController@save');  //保存联系人信息
                Route::any('/edit', 'SupplierContactController@edit');
                Route::post('/delete', 'SupplierContactController@delete');
            });
            //资源商-银行账户管理
            Route::group(['prefix' => 'bank'], function () {
                Route::get('/', 'SupplierBankController@index'); //列表
                Route::get('/create', 'SupplierBankController@create'); //新增页面
                Route::any('/edit', 'SupplierBankController@edit'); //编辑页面
                Route::post('/save', 'SupplierBankController@save');  //保存
                Route::post('/delete', 'SupplierBankController@delete'); //删除
            });

        });

        //常用集合地管理
        Route::group(['prefix' => 'gatherplace'], function () {
            Route::get('/', 'GatherPlaceController@index'); //列表
            Route::get('/create', 'GatherPlaceController@create'); //新增页面
            Route::any('/edit', 'GatherPlaceController@edit'); //编辑页面
            Route::post('/save', 'GatherPlaceController@save');  //保存
            Route::post('/delete', 'GatherPlaceController@delete'); //删除
        });
        //常用大交通管理
        Route::group(['prefix' => 'bigtraffic'], function () {
            Route::get('/', 'BigTrafficController@index'); //列表
            Route::get('/create', 'BigTrafficController@create'); //新增页面
            Route::any('/edit', 'BigTrafficController@edit'); //编辑页面
            Route::post('/save', 'BigTrafficController@save');  //保存
            Route::post('/delete', 'BigTrafficController@delete'); //删除
        });
        //常用公司抬头管理
        Route::group(['prefix' => 'letterhead'], function () {
            Route::get('/', 'LetterheadController@index'); //列表
            Route::get('/create', 'LetterheadController@create'); //新增页面
            Route::any('/edit', 'LetterheadController@edit'); //编辑页面
            Route::post('/save', 'LetterheadController@save');  //保存
            Route::post('/delete', 'LetterheadController@delete'); //删除
        });
        //常用酒店管理
        Route::group(['prefix' => 'hotel'], function () {
            Route::get('/', 'HotelController@index'); //列表
            Route::get('/create', 'HotelController@create'); //新增页面
            Route::any('/edit', 'HotelController@edit'); //编辑页面
            Route::post('/save', 'HotelController@save');  //保存
            Route::post('/delete', 'HotelController@delete'); //删除
        });
        //常用景点管理
        Route::group(['prefix' => 'scenicspot'], function () {
            Route::get('/', 'ScenicspotController@index'); //列表
            Route::get('/create', 'ScenicspotController@create'); //新增页面
            Route::any('/edit', 'ScenicspotController@edit'); //编辑页面
            Route::post('/save', 'ScenicspotController@save');  //保存
            Route::post('/delete', 'ScenicspotController@delete'); //删除
        });
        //团期推荐管理
        Route::group(['prefix' => 'recommend'], function () {
            Route::get('/', 'RecommendController@index'); //列表
            Route::get('/create', 'RecommendController@create'); //新增页面
            Route::any('/edit', 'RecommendController@edit'); //编辑页面
            Route::post('/save', 'RecommendController@save');  //保存
            Route::post('/delete', 'RecommendController@delete'); //删除
        });
        //导游领队管理
        Route::group(['prefix' => 'guide'], function () {
            Route::get('/', 'GuideController@index'); //列表
            Route::get('/create', 'GuideController@create'); //新增页面
            Route::any('/edit', 'GuideController@edit'); //编辑页面
            Route::post('/save', 'GuideController@save');  //保存
            Route::post('/delete', 'GuideController@delete'); //删除
        });
        //游客黑名单管理
        Route::group(['prefix' => 'blacklist'], function () {
            Route::get('/', 'BlacklistController@index'); //列表
            Route::get('/create', 'BlacklistController@create'); //新增页面
            Route::any('/edit', 'BlacklistController@edit'); //编辑页面
            Route::post('/save', 'BlacklistController@save');  //保存
            Route::post('/delete', 'BlacklistController@delete'); //删除
        });
    });


    /**
     * 4、财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth.manage', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 公司银行账号维护
         */
        Route::group(['prefix' => 'bank', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'BankController@index');

            Route::get('/aa', 'aaController@index');
            Route::any('/create', 'BankController@create');
            Route::any('/edit', 'BankController@edit');
        });
    });


    /**
     * 5、系统设置
     */
    Route::group(['prefix' => 'system', 'middleware' => 'auth.manage', 'namespace' => 'System'], function () {

        Route::get('/', 'HomeController@index');


        /**
         * 系统参数
         */
        Route::group(['prefix' => 'config', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'ConfigController@index');
        });
        /**
         * 全局参数
         */
        Route::group(['prefix' => 'basemaps', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'BaseMapsController@index');
            Route::any('/create', 'BaseMapsController@create');
            Route::any('/edit', 'BaseMapsController@edit');
            Route::post('/delete', 'BaseMapsController@delete');
        });

        /**
         * 区域管理
         */
        Route::group(['prefix' => 'area', 'middleware' => 'auth.manage'], function () {

            Route::get('/', 'AreaController@index');
            Route::get('/create', 'AreaController@getCreate');
            Route::post('/create', 'AreaController@postCreate');
            Route::get('/edit', 'AreaController@getEdit');
            Route::post('/edit', 'AreaController@postEdit');
            Route::post('/delete', 'AreaController@delete');

        });
        /**
         * 企业管理
         */
        Route::group(['prefix' => 'enterprise', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'EnterpriseController@index');
        });


        /**
         * 部门管理
         */
        Route::group(['prefix' => 'dept', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'DeptController@index');
            Route::any('/create', 'DeptController@create');
            Route::any('/edit', 'DeptController@edit');
            Route::post('/delete', 'DeptController@delete');

        });
        /**
         * 用户用户
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'UserController@index');
            Route::any('/create', 'UserController@create');
            Route::any('/edit', 'UserController@edit');
            Route::get('/delete', 'UserController@delete');
            Route::get('/authorize', 'UserController@getAuthorize');
            Route::post('/authorize', 'UserController@postAuthorize');

        });
        /**
         * 权限定义
         */
        Route::group(['prefix' => 'permission', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'PermissionController@index');
            Route::get('/create', 'PermissionController@getCreate');
            Route::post('/create', 'PermissionController@postCreate');
            Route::get('/edit', 'PermissionController@getEdit');
            Route::post('/edit', 'PermissionController@postEdit');
            Route::post('/delete', 'PermissionController@delete');


        });
        /**
         * 角色
         */
        Route::group(['prefix' => 'role', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'RoleController@index');
            Route::get('/create', 'RoleController@getCreate');
            Route::post('/create', 'RoleController@postCreate');
            Route::get('/edit', 'RoleController@getEdit');
            Route::post('/edit', 'RoleController@postEdit');
            Route::get('/authorize', 'RoleController@getAuthorize');
            Route::post('/authorize', 'RoleController@postAuthorize');
            Route::post('/delete', 'RoleController@delete');

        });

        /**
         * 授权管理
         */
        Route::group(['prefix' => 'authorization', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'AuthorizationController@index');
            Route::get('/create', 'AuthorizationController@getCreate');
            Route::post('/create', 'AuthorizationController@postCreate');
            Route::get('/edit', 'AuthorizationController@getEdit');
            Route::post('/edit', 'AuthorizationController@postEdit');
            Route::post('/delete', 'AuthorizationController@delete');

        });


        /**
         * 附件资源
         */
        Route::group(['prefix' => 'attachment', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'AttachmentController@index');
            Route::get('/create', 'AttachmentController@getCreate');
            Route::post('/create', 'AttachmentController@postCreate');
            Route::get('/edit', 'AttachmentController@getEdit');
            Route::post('/edit', 'AttachmentController@postEdit');
            Route::post('/delete', 'AttachmentController@delete');

        });


        /**
         * 基础数据
         */
        Route::group(['prefix' => 'basedata', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'BaseDataController@index');
            Route::post('/create', 'BaseDataController@create');
            Route::any('/edit/{id}', 'BaseDataController@edit');
            Route::get('/delete', 'BaseDataController@delete');
            Route::any('/type', 'BaseDataController@type');

        });

        /**
         * 公告信息
         */
        Route::group(['prefix' => 'notices', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'NoticesController@index');
            Route::get('/create', 'NoticesController@getCreate');
            Route::post('/create', 'NoticesController@postCreate');
            Route::get('/edit', 'NoticesController@getEdit');
            Route::post('/edit', 'NoticesController@postEdit');
            Route::post('/delete', 'NoticesController@delete');

        });
    });


    /**
     * 6、开放平台
     */
    Route::group(['prefix' => 'open', 'middleware' => 'auth.manage', 'namespace' => 'Open'], function () {
        Route::get('/', 'HomeController@index');
    });


});


/**
 * 会员中心
 */
Route::group(['prefix' => 'member', 'namespace' => 'Member'], function () {
    Auth::routes();


    Route::post('/clear/cache', 'HomeController@postClearCache');

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@home');
    /**
     * Demo演示
     */
    Route::group(['prefix' => 'demo'], function () {
        Route::get('/', 'DemoController@index');
        Route::get('/create', 'DemoController@getCreate');
        Route::post('/create', 'DemoController@postCreate');
        Route::get('/edit/{id}', 'DemoController@getEdit');
        Route::post('/edit/{id}', 'DemoController@postEdit');
        Route::get('/detail/{id}', 'DemoController@getDetail');
        Route::get('/delete/{id}', 'DemoController@getDelete');

    });


    /**
     * 1、业务操作
     */
    Route::group(['prefix' => 'business', 'middleware' => 'auth.manage', 'namespace' => 'Business'], function () {
        Route::get('/', 'HomeController@index');

        //成本管理
        Route::group(['prefix' => 'cost'], function () {
            Route::get('/', 'CostController@index');
            Route::any('/create/', 'CostController@create');
            Route::any('/edit/{id?}', 'CostController@edit');
            Route::get('/detail', 'CostController@detail');
            Route::post('/delete', 'CostController@delete');
        });

        //团期管理
        Route::group(['prefix' => 'group'], function () {
            Route::get('/', 'TourGroupController@index');
            Route::get('/tourline', 'TourGroupController@tourline'); //团期线路表
            Route::get('/createsan', 'TourGroupController@createSan'); //增加散拼
            Route::get('/chooseline', 'TourGroupController@chooseLine'); //选择线路
            Route::get('/choosetraffic', 'TourGroupController@chooseTraffic'); //选择大交通
            Route::get('/choosegatherplace', 'TourGroupController@chooseGatherPlace'); //选择集合地
            Route::post('/tourline/save', 'TourGroupController@saveLine');  //保存线路信息
            Route::post('/save', 'TourGroupController@saveGroup');  //保存团队信息
            Route::post('/tourline/travel/save', 'TourGroupController@saveTravel'); //保存线路行程信息
            Route::post('/tourline/otherinfo/save', 'TourGroupController@saveOtherInfo'); //保存线路其他信息
        });

        //订单管理
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index'); //订单列表
            Route::get('/signup', 'OrderController@signUp'); //收客报名
        });


    });


    /**
     * 2、客户关系
     */
    Route::group(['prefix' => 'crm', 'middleware' => 'auth.manage', 'namespace' => 'CRM'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 客户档案
         */
        Route::group(['prefix' => 'customer', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'CustomerController@index');
            Route::get('/create', 'CustomerController@getCreate');
            Route::post('/create', 'CustomerController@postCreate');
            Route::get('/edit', 'CustomerController@getEdit');
            Route::post('/edit', 'CustomerController@postEdit');
            Route::get('/detail', 'CustomerController@getDetail');
            Route::post('/delete', 'CustomerController@delete');
            Route::get('/api/list', 'CustomerController@getList');
            /**
             * 客户-联系人
             */
            Route::group(['prefix' => 'linkman', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerLinkManController@index');
                Route::get('/create', 'CustomerLinkManController@getCreate');
                Route::post('/create', 'CustomerLinkManController@postCreate');
                Route::get('/edit', 'CustomerLinkManController@getEdit');
                Route::post('/edit', 'CustomerLinkManController@postEdit');
                Route::post('/delete', 'CustomerLinkManController@delete');
                Route::get('/api/list', 'CustomerLinkManController@getList');

            });
            /**
             * 客户-联系记录
             */
            Route::group(['prefix' => 'follow', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerFollowController@index');
                Route::get('/create', 'CustomerFollowController@getCreate');
                Route::post('/create', 'CustomerFollowController@postCreate');
                Route::get('/edit', 'CustomerFollowController@getEdit');
                Route::post('/edit', 'CustomerFollowController@postEdit');
                Route::post('/delete', 'CustomerFollowController@delete');

            });
            /**
             * 客户-积分
             */
            Route::group(['prefix' => 'integral', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerIntegralController@index');
                Route::get('/create', 'CustomerIntegralController@getCreate');
                Route::post('/create', 'CustomerIntegralController@postCreate');
                Route::get('/edit', 'CustomerIntegralController@getEdit');
                Route::post('/edit', 'CustomerIntegralController@postEdit');
                Route::post('/delete', 'CustomerIntegralController@delete');

            });

            /**
             * 客户-任务
             */
            Route::group(['prefix' => 'task', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerTaskController@index');
                Route::get('/create', 'CustomerTaskController@getCreate');
                Route::post('/create', 'CustomerTaskController@postCreate');
                Route::get('/edit', 'CustomerTaskController@getEdit');
                Route::post('/edit', 'CustomerTaskController@postEdit');
                Route::post('/delete', 'CustomerTaskController@delete');
                Route::get('/api/list', 'CustomerTaskController@getList');


            });
        });

        /**
         * 微信营销
         */
        Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinAttentionController@index');
            Route::get('/create', 'WeixinAttentionController@getCreate');
            Route::post('/create', 'WeixinAttentionController@postCreate');
            Route::get('/edit', 'WeixinAttentionController@getEdit');
            Route::post('/edit', 'WeixinAttentionController@postEdit');
            Route::post('/delete', 'WeixinAttentionController@delete');
        });

    });


    /**
     * 2、微信营销
     */
    Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage', 'namespace' => 'Weixin'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 关注者
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinUserController@index');
            Route::get('/create', 'WeixinUserController@getCreate');
            Route::post('/create', 'WeixinUserController@postCreate');
            Route::get('/edit', 'WeixinUserController@getEdit');
            Route::post('/edit', 'WeixinUserController@postEdit');
            Route::get('/detail', 'WeixinUserController@getDetail');
            Route::post('/delete', 'WeixinUserController@delete');
            Route::get('/api/list', 'WeixinUserController@getList');
            Route::post('/sync', 'WeixinUserController@sync');
            Route::post('/update', 'WeixinUserController@update');
            Route::post('/remark', 'WeixinUserController@remark');

            /**
             * 用户标签
             */
            Route::group(['prefix' => 'tags', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'WeixinUserTagsController@index');
                Route::get('/create', 'WeixinUserTagsController@getCreate');
                Route::post('/create', 'WeixinUserTagsController@postCreate');
                Route::get('/edit', 'WeixinUserTagsController@getEdit');
                Route::post('/edit', 'WeixinUserTagsController@postEdit');
                Route::post('/delete', 'WeixinUserTagsController@delete');
                Route::post('/sync', 'WeixinUserTagsController@sync');
                Route::post('/update', 'WeixinUserTagsController@update');

            });

        });

        /**
         * 二维码
         */
        Route::group(['prefix' => 'qrcode', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinQrcodeController@index');
            Route::get('/create', 'WeixinQrcodeController@getCreate');
            Route::post('/create', 'WeixinQrcodeController@postCreate');
            Route::get('/edit', 'WeixinQrcodeController@getEdit');
            Route::post('/edit', 'WeixinQrcodeController@postEdit');
            Route::post('/delete', 'WeixinQrcodeController@delete');

        });
    });


    /**
     * 3、资源管理
     */
    Route::group(['prefix' => 'resources', 'middleware' => 'auth.manage', 'namespace' => 'Resources'], function () {
        Route::get('/', 'HomeController@index');

        //线路类别管理
        Route::group(['prefix' => 'lineclass'], function () {
            Route::get('/', 'LineClassController@index');
            Route::any('/create', 'LineClassController@create');
            Route::any('/edit/{id?}', 'LineClassController@edit');
            Route::get('/detail', 'LineClassController@detail');
            Route::post('/delete', 'LineClassController@delete');
        });
        //线路管理
        Route::group(['prefix' => 'line'], function () {
            Route::get('/', 'LineController@index');
            Route::get('/create', 'LineController@create'); //新增页面
            Route::post('/line/save', 'LineController@saveLine');  //保存线路基本信息
            Route::post('/travel/save', 'LineController@saveTravel'); //保存线路行程信息
            Route::post('/otherinfo/save', 'LineController@saveOtherInfo'); //保存线路其他信息
            Route::any('/edit/{id?}', 'LineController@edit');
            Route::get('/detail', 'LineController@detail');
            Route::post('/delete', 'LineController@delete');
        });
        //资源商管理
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', 'SupplierController@index'); //资源商列表
            Route::get('/create', 'SupplierController@create'); //新增页面
            Route::post('/save', 'SupplierController@saveSupplier');  //保存资源商基本信息
            Route::post('/travel/save', 'SupplierController@saveTravel'); //保存线路行程信息
            Route::post('/otherinfo/save', 'SupplierController@saveOtherInfo'); //保存线路其他信息
            Route::any('/edit/{id?}', 'SupplierController@edit');
            Route::post('/delete', 'SupplierController@delete');

            //资源商-联系人管理
            Route::group(['prefix' => 'contacts'], function () {
                Route::get('/', 'SupplierContactController@index'); //供应商联系人管理
                Route::get('/create', 'SupplierContactController@create'); //新增页面
                Route::post('/save', 'SupplierContactController@save');  //保存联系人信息
                Route::any('/edit', 'SupplierContactController@edit');
                Route::post('/delete', 'SupplierContactController@delete');
            });
            //资源商-银行账户管理
            Route::group(['prefix' => 'bank'], function () {
                Route::get('/', 'SupplierBankController@index'); //列表
                Route::get('/create', 'SupplierBankController@create'); //新增页面
                Route::any('/edit', 'SupplierBankController@edit'); //编辑页面
                Route::post('/save', 'SupplierBankController@save');  //保存
                Route::post('/delete', 'SupplierBankController@delete'); //删除
            });

        });

        //常用集合地管理
        Route::group(['prefix' => 'gatherplace'], function () {
            Route::get('/', 'GatherPlaceController@index'); //列表
            Route::get('/create', 'GatherPlaceController@create'); //新增页面
            Route::any('/edit', 'GatherPlaceController@edit'); //编辑页面
            Route::post('/save', 'GatherPlaceController@save');  //保存
            Route::post('/delete', 'GatherPlaceController@delete'); //删除
        });
        //常用大交通管理
        Route::group(['prefix' => 'bigtraffic'], function () {
            Route::get('/', 'BigTrafficController@index'); //列表
            Route::get('/create', 'BigTrafficController@create'); //新增页面
            Route::any('/edit', 'BigTrafficController@edit'); //编辑页面
            Route::post('/save', 'BigTrafficController@save');  //保存
            Route::post('/delete', 'BigTrafficController@delete'); //删除
        });
        //常用公司抬头管理
        Route::group(['prefix' => 'letterhead'], function () {
            Route::get('/', 'LetterheadController@index'); //列表
            Route::get('/create', 'LetterheadController@create'); //新增页面
            Route::any('/edit', 'LetterheadController@edit'); //编辑页面
            Route::post('/save', 'LetterheadController@save');  //保存
            Route::post('/delete', 'LetterheadController@delete'); //删除
        });
        //常用酒店管理
        Route::group(['prefix' => 'hotel'], function () {
            Route::get('/', 'HotelController@index'); //列表
            Route::get('/create', 'HotelController@create'); //新增页面
            Route::any('/edit', 'HotelController@edit'); //编辑页面
            Route::post('/save', 'HotelController@save');  //保存
            Route::post('/delete', 'HotelController@delete'); //删除
        });
        //常用景点管理
        Route::group(['prefix' => 'scenicspot'], function () {
            Route::get('/', 'ScenicspotController@index'); //列表
            Route::get('/create', 'ScenicspotController@create'); //新增页面
            Route::any('/edit', 'ScenicspotController@edit'); //编辑页面
            Route::post('/save', 'ScenicspotController@save');  //保存
            Route::post('/delete', 'ScenicspotController@delete'); //删除
        });
        //团期推荐管理
        Route::group(['prefix' => 'recommend'], function () {
            Route::get('/', 'RecommendController@index'); //列表
            Route::get('/create', 'RecommendController@create'); //新增页面
            Route::any('/edit', 'RecommendController@edit'); //编辑页面
            Route::post('/save', 'RecommendController@save');  //保存
            Route::post('/delete', 'RecommendController@delete'); //删除
        });
        //导游领队管理
        Route::group(['prefix' => 'guide'], function () {
            Route::get('/', 'GuideController@index'); //列表
            Route::get('/create', 'GuideController@create'); //新增页面
            Route::any('/edit', 'GuideController@edit'); //编辑页面
            Route::post('/save', 'GuideController@save');  //保存
            Route::post('/delete', 'GuideController@delete'); //删除
        });
        //游客黑名单管理
        Route::group(['prefix' => 'blacklist'], function () {
            Route::get('/', 'BlacklistController@index'); //列表
            Route::get('/create', 'BlacklistController@create'); //新增页面
            Route::any('/edit', 'BlacklistController@edit'); //编辑页面
            Route::post('/save', 'BlacklistController@save');  //保存
            Route::post('/delete', 'BlacklistController@delete'); //删除
        });
    });


    /**
     * 4、财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth.manage', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 公司银行账号维护
         */
        Route::group(['prefix' => 'bank', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'BankController@index');

            Route::get('/aa', 'aaController@index');
            Route::any('/create', 'BankController@create');
            Route::any('/edit', 'BankController@edit');
        });
    });


    /**
     * 5、系统设置
     */
    Route::group(['prefix' => 'system', 'middleware' => 'auth.manage', 'namespace' => 'System'], function () {

        Route::get('/', 'HomeController@index');


        /**
         * 系统参数
         */
        Route::group(['prefix' => 'config', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'ConfigController@index');
        });
        /**
         * 全局参数
         */
        Route::group(['prefix' => 'basemaps', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'BaseMapsController@index');
            Route::any('/create', 'BaseMapsController@create');
            Route::any('/edit', 'BaseMapsController@edit');
            Route::post('/delete', 'BaseMapsController@delete');
        });

        /**
         * 区域管理
         */
        Route::group(['prefix' => 'area', 'middleware' => 'auth.manage'], function () {

            Route::get('/', 'AreaController@index');
            Route::get('/create', 'AreaController@getCreate');
            Route::post('/create', 'AreaController@postCreate');
            Route::get('/edit', 'AreaController@getEdit');
            Route::post('/edit', 'AreaController@postEdit');
            Route::post('/delete', 'AreaController@delete');

        });
        /**
         * 企业管理
         */
        Route::group(['prefix' => 'enterprise', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'EnterpriseController@index');
        });


        /**
         * 部门管理
         */
        Route::group(['prefix' => 'dept', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'DeptController@index');
            Route::any('/create', 'DeptController@create');
            Route::any('/edit', 'DeptController@edit');
            Route::post('/delete', 'DeptController@delete');

        });
        /**
         * 用户用户
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::any('/', 'UserController@index');
            Route::any('/create', 'UserController@create');
            Route::any('/edit', 'UserController@edit');
            Route::get('/delete', 'UserController@delete');
            Route::get('/authorize', 'UserController@getAuthorize');
            Route::post('/authorize', 'UserController@postAuthorize');

        });
        /**
         * 权限定义
         */
        Route::group(['prefix' => 'permission', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'PermissionController@index');
            Route::get('/create', 'PermissionController@getCreate');
            Route::post('/create', 'PermissionController@postCreate');
            Route::get('/edit', 'PermissionController@getEdit');
            Route::post('/edit', 'PermissionController@postEdit');
            Route::post('/delete', 'PermissionController@delete');


        });
        /**
         * 角色
         */
        Route::group(['prefix' => 'role', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'RoleController@index');
            Route::get('/create', 'RoleController@getCreate');
            Route::post('/create', 'RoleController@postCreate');
            Route::get('/edit', 'RoleController@getEdit');
            Route::post('/edit', 'RoleController@postEdit');
            Route::get('/authorize', 'RoleController@getAuthorize');
            Route::post('/authorize', 'RoleController@postAuthorize');
            Route::post('/delete', 'RoleController@delete');

        });

        /**
         * 授权管理
         */
        Route::group(['prefix' => 'authorization', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'AuthorizationController@index');
            Route::get('/create', 'AuthorizationController@getCreate');
            Route::post('/create', 'AuthorizationController@postCreate');
            Route::get('/edit', 'AuthorizationController@getEdit');
            Route::post('/edit', 'AuthorizationController@postEdit');
            Route::post('/delete', 'AuthorizationController@delete');

        });


        /**
         * 附件资源
         */
        Route::group(['prefix' => 'attachment', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'AttachmentController@index');
            Route::get('/create', 'AttachmentController@getCreate');
            Route::post('/create', 'AttachmentController@postCreate');
            Route::get('/edit', 'AttachmentController@getEdit');
            Route::post('/edit', 'AttachmentController@postEdit');
            Route::post('/delete', 'AttachmentController@delete');

        });


        /**
         * 基础数据
         */
        Route::group(['prefix' => 'basedata', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'BaseDataController@index');
            Route::post('/create', 'BaseDataController@create');
            Route::any('/edit/{id}', 'BaseDataController@edit');
            Route::get('/delete', 'BaseDataController@delete');
            Route::any('/type', 'BaseDataController@type');

        });

        /**
         * 公告信息
         */
        Route::group(['prefix' => 'notices', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'NoticesController@index');
            Route::get('/create', 'NoticesController@getCreate');
            Route::post('/create', 'NoticesController@postCreate');
            Route::get('/edit', 'NoticesController@getEdit');
            Route::post('/edit', 'NoticesController@postEdit');
            Route::post('/delete', 'NoticesController@delete');

        });
    });


    /**
     * 6、开放平台
     */
    Route::group(['prefix' => 'open', 'middleware' => 'auth.manage', 'namespace' => 'Open'], function () {
        Route::get('/', 'HomeController@index');
    });


});
Route::post('/clear/cache', 'HomeController@postClearCache');

/**
 * 管理后台
 */
Route::group(['prefix' => 'manage', 'namespace' => 'Manage'], function () {
    Auth::routes();


    Route::post('/clear/cache', 'HomeController@postClearCache');

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@home');


    /**
     * 1、业务操作
     */
    Route::group(['prefix' => 'business', 'middleware' => 'auth.manage', 'namespace' => 'Business'], function () {
        Route::get('/', 'HomeController@index');

        //成本管理
        Route::group(['prefix' => 'cost'], function () {
            Route::get('/', 'CostController@index');
            Route::any('/create/', 'CostController@create');
            Route::any('/edit/{id?}', 'CostController@edit');
            Route::get('/detail', 'CostController@detail');
            Route::post('/delete', 'CostController@delete');
        });

        //团期管理
        Route::group(['prefix' => 'group'], function () {
            Route::get('/', 'TourGroupController@index');
            Route::get('/tourline', 'TourGroupController@tourline'); //团期线路表
            Route::get('/createsan', 'TourGroupController@createSan'); //增加散拼
            Route::get('/chooseline', 'TourGroupController@chooseLine'); //选择线路
            Route::get('/choosetraffic', 'TourGroupController@chooseTraffic'); //选择大交通
            Route::get('/choosegatherplace', 'TourGroupController@chooseGatherPlace'); //选择集合地
            Route::post('/tourline/save', 'TourGroupController@saveLine');  //保存线路信息
            Route::post('/save', 'TourGroupController@saveGroup');  //保存团队信息
            Route::post('/tourline/travel/save', 'TourGroupController@saveTravel'); //保存线路行程信息
            Route::post('/tourline/otherinfo/save', 'TourGroupController@saveOtherInfo'); //保存线路其他信息
        });

        //订单管理
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index'); //订单列表
            Route::get('/signup', 'OrderController@signUp'); //收客报名
        });


    });


    /**
     * 2、客户关系
     */
    Route::group(['prefix' => 'crm', 'middleware' => 'auth.manage', 'namespace' => 'CRM'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 客户档案
         */
        Route::group(['prefix' => 'customer', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'CustomerController@index');
            Route::get('/create', 'CustomerController@getCreate');
            Route::post('/create', 'CustomerController@postCreate');
            Route::get('/edit', 'CustomerController@getEdit');
            Route::post('/edit', 'CustomerController@postEdit');
            Route::get('/detail', 'CustomerController@getDetail');
            Route::post('/delete', 'CustomerController@delete');
            Route::get('/api/list', 'CustomerController@getList');
            /**
             * 客户-联系人
             */
            Route::group(['prefix' => 'linkman', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerLinkManController@index');
                Route::get('/create', 'CustomerLinkManController@getCreate');
                Route::post('/create', 'CustomerLinkManController@postCreate');
                Route::get('/edit', 'CustomerLinkManController@getEdit');
                Route::post('/edit', 'CustomerLinkManController@postEdit');
                Route::post('/delete', 'CustomerLinkManController@delete');
                Route::get('/api/list', 'CustomerLinkManController@getList');

            });
            /**
             * 客户-联系记录
             */
            Route::group(['prefix' => 'follow', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerFollowController@index');
                Route::get('/create', 'CustomerFollowController@getCreate');
                Route::post('/create', 'CustomerFollowController@postCreate');
                Route::get('/edit', 'CustomerFollowController@getEdit');
                Route::post('/edit', 'CustomerFollowController@postEdit');
                Route::post('/delete', 'CustomerFollowController@delete');

            });
            /**
             * 客户-积分
             */
            Route::group(['prefix' => 'integral', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerIntegralController@index');
                Route::get('/create', 'CustomerIntegralController@getCreate');
                Route::post('/create', 'CustomerIntegralController@postCreate');
                Route::get('/edit', 'CustomerIntegralController@getEdit');
                Route::post('/edit', 'CustomerIntegralController@postEdit');
                Route::post('/delete', 'CustomerIntegralController@delete');

            });

            /**
             * 客户-任务
             */
            Route::group(['prefix' => 'task', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'CustomerTaskController@index');
                Route::get('/create', 'CustomerTaskController@getCreate');
                Route::post('/create', 'CustomerTaskController@postCreate');
                Route::get('/edit', 'CustomerTaskController@getEdit');
                Route::post('/edit', 'CustomerTaskController@postEdit');
                Route::post('/delete', 'CustomerTaskController@delete');
                Route::get('/api/list', 'CustomerTaskController@getList');


            });
        });

        /**
         * 微信营销
         */
        Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinAttentionController@index');
            Route::get('/create', 'WeixinAttentionController@getCreate');
            Route::post('/create', 'WeixinAttentionController@postCreate');
            Route::get('/edit', 'WeixinAttentionController@getEdit');
            Route::post('/edit', 'WeixinAttentionController@postEdit');
            Route::post('/delete', 'WeixinAttentionController@delete');
        });

    });


    /**
     * 2、微信营销
     */
    Route::group(['prefix' => 'weixin', 'middleware' => 'auth.manage', 'namespace' => 'Weixin'], function () {
        Route::get('/', 'HomeController@index');
        /**
         * 关注者
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinUserController@index');
            Route::get('/create', 'WeixinUserController@getCreate');
            Route::post('/create', 'WeixinUserController@postCreate');
            Route::get('/edit', 'WeixinUserController@getEdit');
            Route::post('/edit', 'WeixinUserController@postEdit');
            Route::get('/detail', 'WeixinUserController@getDetail');
            Route::post('/delete', 'WeixinUserController@delete');
            Route::get('/api/list', 'WeixinUserController@getList');
            Route::post('/sync', 'WeixinUserController@sync');
            Route::post('/update', 'WeixinUserController@update');
            Route::post('/remark', 'WeixinUserController@remark');

            /**
             * 用户标签
             */
            Route::group(['prefix' => 'tags', 'middleware' => 'auth.manage'], function () {
                Route::get('/', 'WeixinUserTagsController@index');
                Route::get('/create', 'WeixinUserTagsController@getCreate');
                Route::post('/create', 'WeixinUserTagsController@postCreate');
                Route::get('/edit', 'WeixinUserTagsController@getEdit');
                Route::post('/edit', 'WeixinUserTagsController@postEdit');
                Route::post('/delete', 'WeixinUserTagsController@delete');
                Route::post('/sync', 'WeixinUserTagsController@sync');
                Route::post('/update', 'WeixinUserTagsController@update');

            });

        });

        /**
         * 二维码
         */
        Route::group(['prefix' => 'qrcode', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'WeixinQrcodeController@index');
            Route::get('/create', 'WeixinQrcodeController@getCreate');
            Route::post('/create', 'WeixinQrcodeController@postCreate');
            Route::get('/edit', 'WeixinQrcodeController@getEdit');
            Route::post('/edit', 'WeixinQrcodeController@postEdit');
            Route::post('/delete', 'WeixinQrcodeController@delete');

        });
    });


    /**
     * 站点管理
     */
    Route::group(['prefix' => 'site', 'middleware' => 'auth.manage', 'namespace' => 'Site'], function () {
        Route::get('/', 'HomeController@index');

        //菜单管理
        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', 'MenuController@getIndex');
            Route::get('/create', 'MenuController@getCreate');
            Route::post('/create', 'MenuController@postCreate');
            Route::get('/edit/{id?}', 'MenuController@getEdit');
            Route::post('/edit/{id?}', 'MenuController@postEdit');
            Route::get('/detail', 'MenuController@getDetail');
            Route::post('/delete', 'MenuController@postDelete');
            Route::get('/api/list', 'MenuController@getList');
        });
        //分类管理
        Route::group(['prefix' => 'classify'], function () {
            Route::get('/', 'ClassifyController@getIndex');
            Route::get('/create', 'ClassifyController@getCreate');
            Route::post('/create', 'ClassifyController@postCreate');
            Route::get('/edit/{id?}', 'ClassifyController@getEdit');
            Route::post('/edit/{id?}', 'ClassifyController@postEdit');
            Route::get('/detail', 'ClassifyController@getDetail');
            Route::post('/delete', 'ClassifyController@postDelete');
        });

        //信息管理
        Route::group(['prefix' => 'info'], function () {
            Route::get('/', 'InfoController@getIndex');
            Route::get('/create', 'InfoController@getCreate');
            Route::post('/create', 'InfoController@postCreate');
            Route::get('/edit/{id?}', 'InfoController@getEdit');
            Route::post('/edit/{id?}', 'InfoController@postEdit');
            Route::get('/detail', 'InfoController@getDetail');
            Route::post('/delete', 'InfoController@postDelete');
        });

        //广告管理
        Route::group(['prefix' => 'banner'], function () {
            Route::get('/', 'BannerController@getIndex');
            Route::get('/create', 'BannerController@getCreate');
            Route::post('/create', 'BannerController@postCreate');
            Route::get('/edit/{id?}', 'BannerController@getEdit');
            Route::post('/edit/{id?}', 'BannerController@postEdit');
            Route::get('/detail', 'BannerController@getDetail');
            Route::post('/delete', 'BannerController@postDelete');
        });


    });


    /**
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth.manage', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');

        //充值管理
        Route::group(['prefix' => 'pay'], function () {
            Route::get('/', 'PayController@getIndex');
            Route::get('/create', 'PayController@getCreate');
            Route::post('/create', 'PayController@postCreate');
            Route::get('/edit/{id?}', 'PayController@getEdit');
            Route::post('/edit/{id?}', 'PayController@postEdit');
            Route::get('/detail', 'PayController@getDetail');
            Route::post('/delete', 'PayController@postDelete');
        });

        //提现管理
        Route::group(['prefix' => 'take'], function () {
            Route::get('/', 'TakeController@getIndex');
            Route::get('/create', 'TakeController@getCreate');
            Route::post('/create', 'TakeController@postCreate');
            Route::get('/edit/{id?}', 'TakeController@getEdit');
            Route::post('/edit/{id?}', 'TakeController@postEdit');
            Route::get('/detail', 'TakeController@getDetail');
            Route::post('/delete', 'TakeController@postDelete');
        });
    });


    /**
     * 系统设置
     */
    Route::group(['prefix' => 'system', 'middleware' => 'auth.manage', 'namespace' => 'System'], function () {

        Route::get('/', 'HomeController@index');


        /**
         * 系统参数
         */
        Route::group(['prefix' => 'config', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'ConfigController@getIndex');
            Route::get('/edit', 'ConfigController@getEdit');
            Route::post('/edit', 'ConfigController@postEdit');
        });

        /**
         * 用户用户
         */
        Route::group(['prefix' => 'user', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'UserController@getIndex');
            Route::get('/create', 'UserController@getCreate');
            Route::post('/create', 'UserController@postCreate');
            Route::get('/edit/{id?}', 'UserController@getEdit');
            Route::post('/edit/{id?}', 'UserController@postEdit');
            Route::get('/detail', 'UserController@getDetail');
            Route::post('/delete', 'UserController@postDelete');

        });


        /**
         * 会员管理
         */
        Route::group(['prefix' => 'member', 'middleware' => 'auth.manage'], function () {
            Route::get('/', 'MemberController@getIndex');
            Route::get('/create', 'MemberController@getCreate');
            Route::post('/create', 'MemberController@postCreate');
            Route::get('/edit/{id?}', 'MemberController@getEdit');
            Route::post('/edit/{id?}', 'MemberController@postEdit');
            Route::get('/detail', 'MemberController@getDetail');
            Route::post('/delete', 'MemberController@postDelete');

        });
    });


});


