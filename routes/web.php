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

Route::get('/', function () {
	// 设置session
	// 存储一条数据至 Session 中...
    session(['admin_login' => true]);

	Config::set('app.title','hello');
	// dd(date('Y-m-d H:i:s',time()));	
	// 加载模版
    return view('welcome');
});


Route::get('/admin/user',function(){
	// date_default_timezone_set('Asia/Shanghai');
	date_default_timezone_set('PRC');
		
	// dump(date('Y-m-d H:i:s',time()));
	// dd(date('Y-m-d H:i:s',time()));	
	// echo '后台用户管理';
	dump(Config::get('app.timezone'));
	dump(Config::get('app.name'));
	dump(Config::get('database.default'));
	dump(Config::get('app.title'));
});


// 定义基本get路由 并且传递参数 进行参数限定
Route::get('user/edit/{id}/{name}',function($id,$name){
	echo '用户修改：id---'.$id.'--------'.$name;
})->where('id','[0-9]+')->where('name','[a-z]+');



Route::get('user/add',function(){
	// 加载视图
	return view('add');
});

// 定义post路由
Route::post('user/insert',function(){
	echo 'post';	
});
Route::get('info',function(){
	echo 'info';
	// $url = '/admin/user/delete';
	// $url = route('aud'); //route 通过别名创建url地址
	$url = url('admin/user/delete',['id'=>3000]); //通过字符串创建url地址	
	dump($url);
	// return redirect()->route('aud');
	// return redirect($url);
	dump(route('ad',['id'=>200]));
});
// 带别名的路由
/*Route::get('admin/user/delete',function(){
	echo '后台 用户 删除';
})->name('aud');
*/
Route::get('admin/user/delete/{id}',['as'=>'ad','uses'=>function($id){
	echo '后台 用户 删除---------'.$id;
}]);


Route::get('login',function(){
	dump('登录页面');
});

// 通过路由组 对一组进行限定
Route::group(['middleware'=>'login'],function(){
	Route::get('admin/goods/index',function(){
		dump('后台 商品 列表');
	});

	Route::get('admin/goods/add',function(){
		dump('后台 商品 添加');
	});

	Route::get('admin/goods/edit',function(){
		dump('后台 商品 修改');
	});

	Route::get('admin/goods/delete',function(){
		dump('后台 商品 删除');
	});
});

