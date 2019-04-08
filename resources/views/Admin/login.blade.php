<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>图书管理系统后台登陆</title>
    <link rel="stylesheet" href="css/styleAdmin.css">
</head>

<body>

<div id="clouds">
    <div class="cloud x1"></div>
    <div class="cloud x2"></div>
    <div class="cloud x3"></div>
    <div class="cloud x4"></div>
    <div class="cloud x5"></div>
</div>

<div class="container">


    <div id="login">

        <form method="post">

            <fieldset class="clearfix">

                <p><span class="fontawesome-user"></span><input type="text" name="username" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                <p><span class="fontawesome-lock"></span><input type="password"  name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                {{--传递token--}}{{csrf_field()}}
                <p><input type="submit" value="Sign In"></p>

            </fieldset>

        </form>


    </div> <!-- end login -->

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
