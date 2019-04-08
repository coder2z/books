<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>全部书籍</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            background: url(/img/bgn2.jpg) no-repeat;
            background-size: 100%;
        }

        .personal{
            margin-top: 200px;
            background-color: rgba(1,1,1,0.15);
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
                <li class="active"><a href="/book/all" >书库</a></li>
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

<div class="container personal">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">
                全部图书
            </a>
        </li>
    </ul>
    <div class="container">
        <div class="row">
            @foreach($db as $key=>$value)
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="{{$value->avatar}}"
                         alt="{{$value->book_name}}">
                    <div class="caption">
                        <h3>{{$value->book_name}}</h3>
                        <p>分类：{{$value->classify->title}}</p>
                        <p>作者：{{$value->book_author}}</p>
                        <p>ISBN：{{$value->ISBN}}</p>
                        <p>出版社：{{$value->press}}</p>
                        <p>出版时间：{{$value->publication_time}}</p>
                        <p>剩余库存：{{$value->number}}</p>
                        <p>
                            <a href="https://www.baidu.com/s?ie=UTF-8&wd={{$value->book_name}}" class="btn btn-primary" role="button">
                                图书详情
                            </a>

                        @if(Auth::guard('user')->check())
                            <a href="/user/borrow?id={{$value->id}}" class="btn btn-primary" role="button">
                                借这本书
                            </a>
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
                {{ $db->links() }}
        </div>
    </div>
</div>
</div>
</div>


<!--关于-->
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
    function search(){
        document.getElementById("keywords").submit();
    }
</script>
</body>
</html>
