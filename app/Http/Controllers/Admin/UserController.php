<?php

namespace App\Http\Controllers\Admin;

use App\Home\Classify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Home\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //删除用户
    public function del(){
        $id = $_POST['id'];
        $deleted = User::where('id','=',$id)->delete();
        return json_encode($deleted);
    }
    //删除修改用户状态
    public function state(){    
        $id = $_POST['id'];
        $state = $_POST['state'];
        if($state){
            $deleted = User::where('id','=',$id)->update([
                'state'=>'0',
            ]);
            return json_encode($deleted);
        }else{
            $deleted = User::where('id','=',$id)->update([
                'state'=>'1',
            ]);
            return json_encode($deleted);
        }
    }
    //后台添加会员列表
    public function userAdd(Request $request){
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'username' => 'unique:user,username',
            ]);
            $result =User::insert([
                [
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password),
                    'tel'=>$request->tel,
                    'email'=>$request->email,
                    'time'=>date('Y-m-d',time()),
                ],
            ]);
            return $result ? '1':'0';
        }else{
            return view('Admin.user.add');
        }
    }

    //后台会员列表展示
    public function user(){
        $db=User::get();
        return view('Admin.user.user',compact('db'));
    }

    //管理员修改用户密码密码修改
    public function password(Request $request){
            $id=$request->id;
            $db=User::where('id',$id)->value('username');
            return view('Admin.user.password',[
                'name'=> $db,
                'id'=> $id
            ]);
    }
    public function update(Request $request){
            $result =User::where('id',$request->id)->update([
                    'password'=>bcrypt($request->password),
            ]);
            return $result ? '1':'0';
    }


}
