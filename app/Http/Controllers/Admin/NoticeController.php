<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class NoticeController extends Controller
{
    //显示后台显示公告列表
    public function notice(){
        $db=Notice::get();
        return view('Admin.notice.notice',compact('db'));
    }
    //删除公告
    public function del(){
        $id = $_POST['id'];
        $deleted = Notice::where('id','=',$id)->delete();
        return json_encode($deleted);
    }
    //添加公告
    public function add(Request $request){
        if (Input::method() == 'POST') {
            $result =Notice::insert([
                [
                    'title'=>$request->title,
                    'text'=>$request->text,
                    'release_time'=>$request->release_time,
                    'form'=>$request->form,
                ],
            ]);
            return $result ? '1':'0';
        }else{
            return view('Admin.notice.add');
        }
    }
    //修改公告
    public function edit(Request $request){
        $id=$request->id;
        $db=Notice::where('id',$id)->first();
        return view('Admin.notice.modify',[
            'id'=>$id,
            'title'=> $db->title,
            'text'=> $db->text,
            'release_time'=> $db->release_time,
            'form'=> $db->form,
        ]);
    }
    public function modify(Request $request){
        $result =Notice::where('id',$request->id)->update([
            'title'=>$request->title,
            'text'=>$request->text,
            'release_time'=>$request->release_time,
            'form'=>$request->form,
        ]);
        return $result ? '1':'0';
    }
}
