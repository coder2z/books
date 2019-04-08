<?php

namespace App\Http\Controllers\Home;

use App\Admin\Notice;
use App\Home\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Home\User;

class IndexController extends Controller
{
    //首页
    public function index(){
        $db=Notice::orderBy('release_time', 'desc')->get();
        return view('Home.index',compact('db'));
    }
    //搜索
    public function search(){
        $keywords = $_GET["keywords"];
        $results = Book::where('book_name', 'like', "%{$keywords}%")->get();
        return view('Home.search',compact('results'));
    }
    //书库
    public function book(){
        $db=Book::paginate(4);
        return view('Home.book',compact('db'));
    }
    //公告详情
    public function notice(){
        $id=$_GET["id"];
        $db=Notice::Where('id',$id)->first();
        return view('Home.notice',compact('db'));
    }
}
