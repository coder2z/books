<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>图书管理系统用户</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css  "/>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/dataTables.bootstrap.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layui-anim layui-anim-up">
<div class="x-body">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/admin/user/add',600,400)"><i class="layui-icon"></i>添加</button>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </xblock>
    <table class="layui-table" id="datatable">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>用户名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>注册时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($db as $key=>$value)
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$value->id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$value->id}}</td>
            <td>{{$value->username}}</td>
            <td>{{$value->tel}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->time}}</td>
            <td class="td-status">
                @if($value->state)<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
            @else<span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span></td>
                @endif
            <td class="td-manage">
                @if($value->state)<a onclick="member_stop(this,'{{$value->id}}')" href="javascript:;"  title="停用"><i class="layui-icon">&#xe601;</i></a>
            @else<a onclick="member_stop(this,'{{$value->id}}')" href="javascript:;"  title="启用"><i class="layui-icon">&#xe62f;</i></a>
            @endif
                <a onclick="x_admin_show('修改密码','/admin/user/password/{{$value->id}}',600,400)" title="修改密码" href="javascript:;">
                    <i class="layui-icon">&#xe631;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$value->id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        if($(obj).attr('title')=='停用'){
            var state=1;
        layer.confirm('确认要停用吗？',function(index){
                //发异步把用户状态进行更改
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'/admin/user/state',
                data: {'id': id,'state':state},
                dataType:'json',
                success:function(data){          //data就是返回的json类型的数据
                    if(data){
                        $(obj).attr('title','启用');
                        $(obj).find('i').html('&#xe62f;');
                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!',{icon: 5,time:1000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
                error:function(data){
                    alert("失败");
                }
            });
        });}
        else {
            var state=0;
            layer.confirm('确认要启用吗？',function(index) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    layerIndex:-1,
                    beforeSend: function () {
                        this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                    },
                    type:'POST',
                    url:'/admin/user/state',
                    data: {'id': id,'state':state},
                    dataType:'json',
                    success:function(data){          //data就是返回的json类型的数据
                        if(data){
                            $(obj).attr('title', '停用');
                            $(obj).find('i').html('&#xe601;');
                            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                            layer.msg('已启用!', {icon: 1, time: 1000});
                        }
                    },
                    complete: function () {
                        layer.close(this.layerIndex);
                    },
                    error:function(data){
                        alert("失败");
                    }
                });

            });
        }
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'/admin/user/del',
                data: {'id': id},
                dataType:'json',
                success:function(data){          //data就是返回的json类型的数据
                    if(data){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
                error:function(data){
                     alert("删除失败");
                }
            });
        });
    }
</script>

<script type="text/javascript">
    $('#datatable').dataTable({
        "oLanguage": {
            "sLengthMenu": "每页显示 _MENU_ 条记录",
            "sZeroRecords": "对不起，查询不到任何相关数据",
            "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
            "sInfoEmtpy": "找不到相关数据",
            "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
            "sProcessing": "正在加载中...",
            "sSearch": "搜索",
            "oPaginate": {
                "sFirst": "第一页",
                "sPrevious":" 上一页 ",
                "sNext": " 下一页 ",
                "sLast": " 最后一页 "
            },
        },
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }],
        "aaSorting": [[ 1, "asc" ]],
        "bStateSave": true,//状态保存
        "iDisplayLength": 10000,
    });
    $('table').dataTable();
</script>
</body>

</html>