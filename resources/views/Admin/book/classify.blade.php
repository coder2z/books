<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>添加图书分类</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <script src="/js/jquery.form.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" id="form">
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
                分类
            </label>
            <div class="layui-input-inline">
                <input type="text" id="title" name="title" required="" value=""  lay-verify="title" class="layui-input" lay-verify="title">
            </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="save" lay-submit="">
                添加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            title: [/\S/, '分类不能为空'],
        });

        //监听提交
        form.on('submit(save)', function(data){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'',
                data:$('#form').serialize(),
                dataType:'json',
                success:function(result){
                    if(result){
                        layer.msg('添加成功!', {icon: 1, time: 1000});
                        $("form")[0].reset(); //清空表单
                    }else {
                        layer.msg('添加失败!', {icon: 2, time: 2000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
                error:function(){
                    layer.msg('增加失败!', {icon: 2, time: 2000});
                }
            });
            return false;
        });


    });
</script>
</body>

</html>