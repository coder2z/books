<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书管理系统</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="/">首页</a></li>
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

<!--轮播图-->

<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="img/lun1.jpg" alt="First slide">
        </div>
        <div class="item">
            <img src="img/lun2.jpg" alt="Second slide">
        </div>
        <div class="item">
            <img src="img/lun3.jpg" alt="Third slide">
        </div>
        <div class="item">
            <img src="img/lun4.jpg" alt="fourth slide">
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!--公告栏-->
<div class="content">
    <div class="content_top">
        <!--通知图片-->
        <div class="top_img">
            <img src="img/top1.jpg">
        </div>
        <!--通知标题-->
        <div class="top_title">
            <a href="#">
                爱掌图书消息公布栏
            </a>
        </div>
    </div>
    <div class="content_bottom">
        <div class="content_bottom_body">
            <!--头部-->
            <div class="body_title">
                <span>爱掌图书</span>
            </div>
            <!--历史通知-->
            <div id="myTabContent" class="body_text tab-content">
                <div class="text tab-pane active">
                    @foreach($db as $key=>$value)
                    <!--通知内容开始-->
                    <a href="/notice?id={{$value->id}}" class="text_body">
                        <!--通知标题-->
                        <span class="span1">{{$value->title}}</span>
                        <!--通知时间-->
                        <span class="span2">{{$value->release_time}}</span>
                        @if($key==4)
                            @break;
                        @endif
                    </a>
                    <!--通知内容结束-->
                    @endforeach
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
    </div>
</div>
<script type="text/javascript">
    function search(){
        document.getElementById("keywords").submit();
    }
</script>
</body>
</html>