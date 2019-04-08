<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Home\Book;
use App\Home\Borrow;
use App\Home\User;
use App\Admin\Admin;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{
    //登陆验证
    public function login(Request $request){
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'username' => 'required|min:1|max:30',
                'password' => 'required|max:16',
                // 'captcha' => 'required|captcha',
            ]);
            $data =$request -> only(['username','password']);
            $result = Auth::guard('admin')->attempt($data);
            if($result){
                return redirect('/admin/index');
            }else{
                return redirect('/admin/login') -> withErrors([
                    'loginError' => '用户名或者密码错误！'
                ]);
            }
        } else {
            return view('Admin.login');
        }
    }
    //后台首页展示
    public function admin(){
        return view('Admin.admin');
    }
    //管理员注销登陆
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
    //后台welcome展示
    public function welcome(){
        $book=Book::count();
        $user=User::count();
        $admin=Admin::count();
        $borrow=Borrow::count();
        return view('Admin.welcome',[
            'book'=>$book,
            'user'=>$user,
            'admin'=>$admin,
            'borrow'=>$borrow,
        ]);
    }
    //备份
    public function save(){
        $DB_HOST = getenv('DB_HOST');
        $DB_DATABASE = getenv('DB_DATABASE'); //从配置文件中获取数据库信息
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');
        $dumpfname = $DB_DATABASE . "_" . date("Y-m-d_H-i-s")."_" .encrypt(rand(0, 9)).".sql";
        $command = "G:\\phpStudy\\PHPTutorial\\MySQL\\bin\\mysqldump --add-drop-table --host=$DB_HOST --user=$DB_USERNAME ";
        if ($DB_PASSWORD) $command.= "--password=". $DB_PASSWORD ." ";
        $command.= $DB_DATABASE;
        $command.= " > " . $dumpfname;
        $result=system($command);
        return $result ? '1':'0';
    }
    //后台密码修改
    public function adminpw(Request $request){
        if (Input::method() == 'POST') {
            $result =Admin::where('username',$request->name)->update([
                'password'=>bcrypt($request->password),
            ]);
            return $result ? '1':'0';
        }else{
            $name = $_GET['name'];
            return view('Admin.adminpw',[
                'name'=>$name,
            ]);
        }
    }
}