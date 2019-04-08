<?php

namespace App\Http\Controllers\Admin;

use App\Home\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BorrowController extends Controller
{
    //借书订单列表
    public function index(){
        $db=Borrow::get();
        return view('Admin.borrow.index',compact('db'));
    }

    //借书订单删除
    public function del(){
        $id = $_POST['id'];
        $deleted = Borrow::where('id','=',$id)->delete();
        return json_encode($deleted);
    }
    //借书订单归还状态
    public function state(){
        $id = $_POST['id'];
        $state = $_POST['state'];
        if($state){
            $deleted = Borrow::where('id','=',$id)->update([
                'state'=>'0',
            ]);
            return json_encode($deleted);
        }else{
            $deleted = Borrow::where('id','=',$id)->update([
                'state'=>'1',
            ]);
            return json_encode($deleted);
        }
    }
}
