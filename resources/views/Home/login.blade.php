<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>图书管理系统登陆</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
    <div class="info">
        <h1>图书管理系统</h1><span>会员登陆 </span>
    </div>
</div>
<div class="form">
    <div class="thumbnail"><img src="css/hat.svg"/></div>
    <form id="login" class="login-form" action="" method="post">
        <input type="text" placeholder="用户名" name="username"/>
        <input type="password" placeholder="密码" name="password"/>
        {{--传递token--}}{{csrf_field()}}
        <button>登陆</button>
        <p class="message">没有用户名 ?<a href="/register">注册</a>管理员<a href="/admin/login">登陆</a></p>

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
