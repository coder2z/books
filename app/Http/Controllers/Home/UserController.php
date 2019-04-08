<?php

namespace App\Http\Controllers\Home;

use App\Home\Book;
use App\Home\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Home\User;

class UserController extends Controller
{
    //用户登陆
    public function login(Request $request)
    {
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'username' => 'required|min:1|max:30',
                'password' => 'required|max:16',
            ]);
            $data =$request -> only(['username','password']);
            $result = Auth::guard('user')->attempt($data);
            if($result){
                return redirect('/');
            }else{
                return redirect('/login') -> withErrors([
                    'loginError' => '用户名或者密码错误！'
                ]);
            }
        } else {
            return view('Home.login');
        }
    }
    //用户注册
    public function register(Request $request){
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'username' => 'required|min:1|max:30|unique:user,username',
                'password' => 'required|max:16',
                'captcha' => 'required|captcha',
                'tel' => 'required|max:11|min:7',
                'email' => 'required|email',
            ]);
            //注册会员
            $model=new User();
            $model->insert([
                [
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password),
                    'tel'=>$request->tel,
                    'email'=>$request->email,
                    'time'=>date('Y-m-d H:i:s',time()),
                ],
            ]);
            return redirect('/login') -> withErrors([
                'loginError' => '注册成功！'
            ]);
        } else {
            return view('Home.register');
        }
    }
    //注销登陆
    public function logout(){
            Auth::guard('user')->logout();
            return redirect('/');
    }
    //个人中心
    public function user(){
        //获取登陆人
        $username=Auth::guard('user')->user()->username;
        $name=User::Where('username',$username)->first();
        $nameId=$name->id;
        //我的图书
        $book=Borrow::Where('lending_name',$nameId)->get();
        //未还图书
        $notbook=Borrow::Where('lending_name',$nameId)->Where('state',1)->get();
        //已经归还
        $Returned=Borrow::Where('lending_name',$nameId)->Where('state',0)->get();
        //逾期图书
        $overbook=Borrow::Where('lending_name',$nameId)->whereDate('shoule_time','<',date('Y-m-d',time()))->get();
        return view('User.user',compact('notbook','Returned','book','overbook'));
    }
    //用户借书
    public function borrow(){
        $id=$_GET["id"];
        $db=Book::Where('id',$id)->first();
        return view('User.borrow',compact('db'));
    }
    public function submit(Request $request){
        $this->validate($request, [
            'shoule_time' => 'required',
        ]);
        //获取借书
        $nameId=User::Where('username',$request->username)->first();
        $model=new Borrow();
        $result=$model->insert([
            [
                'lending_name'=>$nameId->id,
                'lending_bookname'=>$request->id,
                'lending_time'=>date('Y-m-d',time()),
                'shoule_time'=>$request->shoule_time,
                'order'=>date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8),
            ],
        ]);
        $number=$request->number;
        Book::where('id',$request->id)->update([
            'number'=>$number-1,
        ]);
        return $result ? '1':'0';
    }
}
