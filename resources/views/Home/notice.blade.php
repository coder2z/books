<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>通知页面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style>

        body{
            background: url("/img/bgn.jpg") no-repeat;
            background-size: 100%;
        }

        /*内容开始*/
        .content{
            width: 62.5%;
            height: 791px;
            min-width: 1200px;
            margin: 55px auto;
            background-color: rgba(255,255,255,0.1);
        }
        .content_title{
            width: 73.5%;
            height: 75px;
            margin: 0 auto  ;
            text-align: center;
        }
        .content_title span{
            display: inline-block;
            height: 100%;
            width: 100%;
            color: #FFFFFF;
            font-size: 24px;
            line-height: 75px;
        }

        .content_body{
            width: 73.5%;
            height: 82%;
            margin: 4% auto 0 auto;
        }

        .content_body .body_img{
            width: 100%;
            height: 45%;
        }
        .content_body .body_img img{
            width: 100%;
            height: 100%;
        }

        .content_body .body_text{
            width: 100%;
            height: 52.3%;
            margin-top: 35px;
        }
        .content_body .body_text p{
            text-indent: 40px;
            font-size: 18px;
            color: #FFFFFF;
            line-height: 22px;
            letter-spacing: 1px;
            overflow: hidden;
        }
        .user{
            height:55px;
            color: #FFFFFF;
            font-size: 20px;
            line-height: 55px;
            text-align: center;
        }

        .user .span4{
            margin-right: 55px;
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
<!--通知栏详细信息-->
<div class="content">
    <div class="content_title">
        <span>{{$db->title}}</span>
    </div>
    <div class="user">
        <span class="span4">发布人：{{$db->form}}</span>
        <span>{{$db->release_time}}</span>
    </div>
    <div class="content_body">
        <div class="body_img">
            <img src="/img/bode-img.jpg">
        </div>
        <div class="body_text">
            <p>
                {{$db->text}}
            </p>
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