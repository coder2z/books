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
//后台管理不需要认证页面
Route::group(['prefix'=>'admin'],function (){
    //后台登陆
    Route::any('/login','Admin\IndexController@login');
    //注销登陆
    Route::any('/logout','Admin\IndexController@logout');
});
//后台管理需要认证页面
Route::group(['prefix'=>'admin','middleware' =>'auth:admin'],function (){
    //后台首页
    Route::any('/index','Admin\IndexController@admin');
    Route::any('/welcome','Admin\IndexController@welcome');
    ///用户操作
    //用户列表
    Route::any('/user','Admin\UserController@user');
    //用户删除处理
    Route::post('/user/del','Admin\UserController@del');
    //用户状态处理
    Route::post('/user/state','Admin\UserController@state');
    //用户添加
    Route::any('/user/add','Admin\UserController@userAdd');
    //用户密码修改
    Route::get('/user/password/{id}','Admin\UserController@password');
    Route::any('/user/update','Admin\UserController@update');

    ///书籍操作
    /// 书籍列表
    Route::any('/book','Admin\BookController@book');
    //书籍删除
    Route::any('/book/del','Admin\BookController@del');
    //书籍编辑
    Route::any('/book/edit/{id}','Admin\BookController@edit');
    Route::any('/book/modify','Admin\BookController@modify');
    //添加图书
    Route::any('/book/add','Admin\BookController@add');
    //封面上传
    Route::post('/book/avatar','Admin\BookController@avatar');
    //添加图书分类
    Route::any('/book/classify','Admin\BookController@classify');
    //图书分类列表
    Route::any('/book/title','Admin\BookController@title');
    //删除图书分类
    Route::any('/book/titledel','Admin\BookController@titledel');
    //图书分类编辑
    Route::any('/book/deltitle/{id}','Admin\BookController@deltitle');
    Route::any('/book/deltitle','Admin\BookController@deltitle1');
    //借书订单列表
    Route::any('/borrow/index','Admin\BorrowController@index');
    //借书订单删除
    Route::any('/borrow/del','Admin\BorrowController@del');
    //借书订单归还状态
    Route::any('/borrow/state','Admin\BorrowController@state');
    //mysql备份
    Route::any('/mysql/save','Admin\IndexController@save');
    //管理员修改密码
    Route::any('/adminpw','Admin\IndexController@adminpw');
    //公告页面
    Route::any('/notice','Admin\NoticeController@notice');
    //公告删除
    Route::any('/notice/del','Admin\NoticeController@del');
    //公告添加
    Route::any('/notice/add','Admin\NoticeController@add');
    //公告修改
    Route::any('/notice/edit/{id}','Admin\NoticeController@edit');
    Route::any('/notice/modify','Admin\NoticeController@modify');
});
//网站首页
Route::any('/','Home\IndexController@index');
//用户登陆
Route::any('/login','Home\UserController@login')->name('login');
//用户注册
Route::any('/register','Home\UserController@register');
//用户注册
Route::any('/book/all','Home\IndexController@book');
//搜索
Route::any('/search','Home\IndexController@search');
//公告
Route::get('/notice','Home\IndexController@notice');
//用户需要认证页面
Route::group(['prefix'=>'user','middleware' =>'auth:user'],function (){
    Route::any('/','Home\UserController@user');
    Route::any('/logout','Home\UserController@logout');
    Route::get('/borrow','Home\UserController@borrow');
    Route::any('/borrow/submit','Home\UserController@submit');
});