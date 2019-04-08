<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>借书详情页</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/lib/layui/css/layui.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.form.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <style>
        body{
            background: url(/img/14-15091G114312V.jpg) no-repeat;
            background-size: 100%;
        }

        .content{
            width: 64.5%;
            height: 551px;
            min-width: 1200px;
            margin: 155px auto;
            background-color: rgba(255,255,255,0.2);
        }
        .col-sm-10{
            width: 55%;
        }
        .content form{
            padding-top: 55px;
        }
    </style>
</head>
<body>
<!--导航栏-->
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">爱掌图书</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li ><a href="/">首页</a></li>
                <li ><a href="/user" >个人中心</a></li>
                <li ><a href="/book/all" >书库</a></li>
                <li><a href="#" data-toggle="modal" data-target="#about">关于</a></li>
            </ul>
            <!--搜索-->
            <form class="bs-example bs-example-form" role="form" action="/search" method="get" id="keywords" >
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keywords" id="keywords" placeholder="搜索关键词...">
                        <span class="input-group-btn">
                    <button name="button" class="btn btn-default" type="button" id="btn" onclick="search();">搜索</button>
        <           </span>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('user')->check())
                    <li><a href="/"><span class="glyphicon glyphicon-user"></span>{{Auth::guard('user')->user()->username}}</a></li>
                    <li><a href="/user/logout">注销登陆</a></li>
                @else
                    <li><a href="/login"><span class="glyphicon glyphicon-user"></span> 登录</a></li>
                    <li><a href="/register"><span class="glyphicon glyphicon-log-in"></span> 注册</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="content">
    <form class="form-horizontal" id="borrow"  onsubmit="return false" action="##" method="post">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="{{$db->id}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">确认借书人</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="{{Auth::guard('user')->user()->username}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">书名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="book_name" name="book_name" value="{{$db->book_name}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">分类</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title"  name="title" value="{{$db->classify->title}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">书籍编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ISBN" value="{{$db->ISBN}}" name="ISBN" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">作者</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="book_author" name="book_author" value="{{$db->book_author}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">出版社</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="press" name="press" value="{{$db->press}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">出版日期</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="publication_time" name="publication_time" value="{{$db->publication_time}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">库存</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="number" name="number" value="{{$db->number}}" onfocus=this.blur()>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">归还时间</label>
            <div class="col-sm-10">
                    <input id="_token" type="hidden" name="_token" value="{{ csrf_token()}}"/>
                <input type="text" class="form-control" id="shoule_time" name="shoule_time" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" class="btn btn-default" value="确认提交" onclick="borrow()">
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="about">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                <h4 class="modal-title">关于</h4>
            </div>
            <div class="modal-body">
                <p>爱掌阅读隶属于成都东软学院，是一款致力于推动学生阅读兴趣以及阅读分享的软件。秉承“创新、开拓、共享”的理念，
                    将阅读渗透到学生的生活中，方便、快捷。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">了解了</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#shoule_time' //指定元素
        });
    });
    function search(){
        document.getElementById("keywords").submit();
    }

    function borrow() {
            $.ajax({
                type: "POST",//方法类型
                url:'/user/borrow/submit',
                dataType: "json",//预期服务器返回的数据类型
                data: $('#borrow').serialize(),
                success:function(result){
                    if(result){
                        layer.msg('借书成功!', {icon: 1, time: 1000});
                    }else {
                        layer.msg('借书失败!', {icon: 2, time: 2000});
                    }
                },
                error : function() {
                    layer.msg('请求发送失败!', {icon: 2, time: 2000});
                }
            });
    }
</script>
</body>
</html>
