<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>图书管理系统后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/css/dataTables.bootstrap.css  "/>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/dataTables.bootstrap.js"></script>
</head>
<body>
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{Auth::guard('admin')->user()->username}}</span>当前时间:{{date('Y-m-d H:i:s',time())}}

        <button  class="layui-btn" onclick="member()" href="javascript:;">
            数据库备份
        </button>

    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 140px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>图书数量</h3>
                                            <p>
                                                <cite>{{$book}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>用户数量</h3>
                                            <p>
                                                <cite>{{$user}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>管理员数量</h3>
                                            <p>
                                                <cite>{{$admin}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>借出数据数量</h3>
                                            <p>
                                                <cite>{{$borrow}}</cite></p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>系统信息</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>服务器解译引擎</th>
                    <td>{{$_SERVER['SERVER_SOFTWARE']}}</td></tr>
                <tr>
                    <th>php版本号</th>
                    <td>{{PHP_VERSION}}</td></tr>
                <tr>
                    <th>Http版本号</th>
                    <td>{{$_SERVER['SERVER_PROTOCOL']}}</td></tr>
                <tr>
                    <th>网站根目录</th>
                    <td>{{$_SERVER['DOCUMENT_ROOT']}}</td></tr>
                <tr>
                    <th>PHP脚本最大执行时间</th>
                    <td>{{ini_get('max_execution_time').' Seconds'}}</td></tr>
                <tr>
                    <th>客户端IP</th>
                    <td>{{$_SERVER['REMOTE_ADDR']}}</td></tr>
                <tr>
                    <th>请求IP</th>
                    <td>{{GetHostByName($_SERVER['SERVER_NAME'])}}</td></tr>
                <tr>
                    <th>服务器域名</th>
                    <td>{{$_SERVER['HTTP_HOST']}}</td></tr>
                <tr>
                    <th>服务器Web端口</th>
                <td>{{$_SERVER['SERVER_PORT']}}</td></tr>
                <tr>
                <th>系统类型</th>
                <td>{{php_uname('s')}}</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
<script>
    function member(){
        layer.confirm('确认要备份数据库吗？',function(index){

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'/admin/mysql/save',
                success:function(data){          //data就是返回的json类型的数据
                    if(data){
                        layer.msg('备份成功!',{icon:1,time:1000});
                    }else{
                        layer.msg('备份失败!',{icon:2,time:1000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
                error:function(data){
                    layer.msg('请求失败!',{icon:2,time:1000});
                }

            });
        });
    }
</script>
</body>
</html>