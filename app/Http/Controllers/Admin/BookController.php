<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Home\Book;
use App\Home\Classify;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //书籍列表展示
    public function book(){
            $db=Book::get();
        return view('Admin.book.book',compact('db'));
    }
    //书籍删除
    public function del(){
        $id = $_POST['id'];
        $deleted = Book::where('id','=',$id)->delete();
        return json_encode($deleted);
    }
    //书籍修改
    public function edit(Request $request){
        $id=$request->id;
        $db=Book::where('id',$id)->first();
        $dbclass=Classify::get();
        return view('Admin.book.modify',[
            'id'=>$id,
            'name'=> $db->book_name,
            'ISBN'=> $db->ISBN,
            'book_author'=> $db->book_author,
            'press'=> $db->press,
            'publication_time'=> $db->publication_time,
            'number'=> $db->number,
            'add_time'=> $db->add_time,
            'classify_id'=>$db->classify_id,
        ],compact('dbclass'));
    }
    public function modify(Request $request){
        $result =Book::where('id',$request->id)->update([
            'number'=>$request->number,
            'ISBN'=>$request->ISBN,
            'book_name'=>$request->name,
            'book_author'=>$request->book_author,
            'press'=>$request->press,
            'publication_time'=>$request->publication_time,
            'add_time'=>$request->add_time,
            'classify_id'=>$request->value,
            'avatar'=>$request->avatar,
        ]);
        return $result ? '1':'0';
    }
//添加图书
    public function add(Request $request){
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'ISBN' => 'unique:book,ISBN',
                'name' => 'unique:book,book_name',
            ]);
            $result =Book::insert([
                [
                    'number'=>$request->number,
                    'ISBN'=>$request->ISBN,
                    'book_name'=>$request->name,
                    'book_author'=>$request->book_author,
                    'press'=>$request->press,
                    'publication_time'=>$request->publication_time,
                    'add_time'=>$request->add_time,
                    'classify_id'=>$request->value,
                    'avatar'=>$request->avatar,
                ],
            ]);
            return $result ? '1':'0';
        }else{
            $db=Classify::get();
            return view('Admin.book.add',compact('db'));
        }
    }

    //添加图书分类
    public function classify(Request $request){
        if (Input::method() == 'POST') {
            $this->validate($request, [
                'title' => 'unique:classify,title',
            ]);
            $result =Classify::insert([
                [
                    'title'=>$request->title,
                ],
            ]);
            return $result ? '1':'0';
        }else{
            return view('Admin.book.classify');
        }
    }
    //图书分类列表
    public function title(){
        $db=Classify::get();
        return view('Admin.book.title',compact('db'));
    }
    //分类删除
    public function titledel(){
        $id = $_POST['id'];
        $deleted = Classify::where('id','=',$id)->delete();
        return json_encode($deleted);
    }
    //分类修改
    public function deltitle(Request $request){
        $id=$request->id;
        $db=Classify::where('id',$id)->first();
        return view('Admin.book.deltitle',[
            'id'=>$id,
            'title'=>$db->title,
        ]);
    }
    public function deltitle1(Request $request){
        $result =Classify::where('id',$request->id)->update([
            'title'=>$request->title,
        ]);
        return $result ? '1':'0';
    }
    //上传文件处理
    public function avatar(Request $request){
        //判断上传成功
        if ($request->hasFile('file') && $request->file('file')->isValid()){
            //文件重命名
            $filename = sha1(time().$request -> file('file') ->getClientOriginalName()).'.'.$request->file('file')->getClientOriginalExtension();
            //文件移动
            Storage::disk('public')->put($filename,file_get_contents($request->file('file')->path()));
            $result=[
                'succMsg'=>'文件上传成功',
                'path'=>'/storage/'.$filename,
            ];
        }else{
            $result=[
                'errCode'=>'404',
                'errMsg'=>$request->file('file')->getErrorMessage()
            ];
        }
        return response()->json($result);
    }
}
