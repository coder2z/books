<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书管理系统登陆</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
    <div class="info">
        <h1>图书管理系统</h1><span>会员注册 </span>
    </div>
</div>
<div class="form">
    <div class="thumbnail"><img src="css/hat.svg"/></div>
    <form id="register" class="login-form" action="" method="post">
        <input type="text" placeholder="用户名" name="username"/>
        <input type="number" placeholder="电话" name="tel"/>
        <input type="email" placeholder="邮箱" name="email"/>
        <input type="password" placeholder="密码" name="password"/>
        <input type="password" placeholder="确认密码" name="password2"/>
        <input type="text" placeholder="验证码" name="captcha"/>
        {{--传递token--}}{{csrf_field()}}<p><img id="btn_searc" src="{{captcha_src()}}" width="300px"></p>
        <button>注册</button>
        <p class="message">已经注册 ?<a href="/login">登陆</a></p>
    </form>
</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/layer.js"></script>
<script type="text/javascript">
            @if(count($errors)>0)
    var allerror ='';
    @foreach($errors->all() as $error)
        allerror += "{{$error}}<br>";
    @endforeach
    layer.alert(allerror,{title:'提示',icon:0});
    @endif
</script>
</body>
</html>
