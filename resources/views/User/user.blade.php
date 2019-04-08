<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style>
        body{
            background:url("img/lun2.jpg") no-repeat;
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
                <li class="active"><a href="/user" >个人中心</a></li>
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


<!--个人中心-->
<div class="container personal">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">
                我的图书
            </a>
        </li>
        <li><a href="#not" data-toggle="tab">未还图书</a></li>
        <li><a href="#yes" data-toggle="tab">已还图书</a></li>
        <li><a href="#chaochu" data-toggle="tab">逾期图书</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <ul class="pagination">
                <div class="row">
                @foreach($book as $key=>$value)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{$value->borrow->avatar}}"
                                 alt="{{$value->borrow->book_name}}">
                            <div class="caption">
                                <h3>{{$value->borrow->book_name}}</h3>
                                <p>分类：{{$value->borrow->classify->title}}</p>
                                <p>订单号：{{$value->order}}</p>
                                <p>借书时间：{{$value->lending_time}}</p>
                                <p>应还时间：{{$value->shoule_time}}</p>
                                <p>
                                    <a href="https://www.baidu.com/s?ie=UTF-8&wd={{$value->borrow->book_name}}" class="btn btn-primary" role="button">
                                        图书详情
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </ul>
        </div>
        <div class="tab-pane fade" id="not">
            <div class="container">
                <div class="row">
                @foreach($notbook as $key=>$value)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{$value->borrow->avatar}}"
                                 alt="{{$value->borrow->book_name}}">
                            <div class="caption">
                                <h3>{{$value->borrow->book_name}}</h3>
                                <p>分类：{{$value->borrow->classify->title}}</p>
                                <p>订单号：{{$value->order}}</p>
                                <p>借书时间：{{$value->lending_time}}</p>
                                <p>应还时间：{{$value->shoule_time}}</p>
                                <p>
                                    <a href="https://www.baidu.com/s?ie=UTF-8&wd={{$value->borrow->book_name}}" class="btn btn-primary" role="button">
                                        图书详情
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="yes">
            <div class="container">
                <div class="row">
                    @foreach($Returned as $key=>$value)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{$value->borrow->avatar}}"
                                 alt="{{$value->borrow->book_name}}">
                            <div class="caption">
                                <h3>{{$value->borrow->book_name}}</h3>
                                <p>分类：{{$value->borrow->classify->title}}</p>
                                <p>订单号：{{$value->order}}</p>
                                <p>借书时间：{{$value->lending_time}}</p>
                                <p>应还时间：{{$value->shoule_time}}</p>
                                <p>
                                    <a href="https://www.baidu.com/s?ie=UTF-8&wd={{$value->borrow->book_name}}" class="btn btn-primary" role="button">
                                        图书详情
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="chaochu">
            <div class="container">
                <div class="row">
                    @foreach($overbook as $key=>$value)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{$value->borrow->avatar}}"
                                 alt="{{$value->borrow->book_name}}">
                            <div class="caption">
                                <h3>{{$value->borrow->book_name}}</h3>
                                <p>分类：{{$value->borrow->classify->title}}</p>
                                <p>订单号：{{$value->order}}</p>
                                <p>借书时间：{{$value->lending_time}}</p>
                                <p>应还时间：{{$value->shoule_time}}</p>
                                <p>
                                    <a href="https://www.baidu.com/s?ie=UTF-8&wd={{$value->borrow->book_name}}" class="btn btn-primary" role="button">
                                        图书详情
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
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