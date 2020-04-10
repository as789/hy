@extends('admin.layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="/static/admin/css/formSelects-v4.css" media="all">
 
@endsection

@section('content')
    <div class="layuimini-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>角色添加</legend>
        </fieldset>
          <div class="layui-row">
          	
          	<div class="layui-col-xs12 layui-col-sm12 layui-col-md8">

		        <form class="layui-form layui-form-pane" style="padding: 0 16px;text-align: center;" action="" method="post">

		        	    @csrf

		        	  
		        	    <div class="layui-form-item">
			                <label class="layui-form-label">父级权限</label>
			                <div class="layui-input-block">
			                    <input type="text" name="pid" autocomplete="off" placeholder="请输入名称" value="" class="layui-input" lay-verify="">
			                </div>
			            </div>
		        	     <div class="layui-form-item">
			                <label class="layui-form-label">权限名称</label>
			                <div class="layui-input-block">
			                    <input type="text" name="name" autocomplete="off" placeholder="请输入名称" value="" class="layui-input" lay-verify="">
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <label class="layui-form-label">显示名称</label>
			                <div class="layui-input-block">
			                    <input type="text" name="display_name" placeholder="请输入名称" autocomplete="off" class="layui-input" value="" lay-verify="">
			                </div>
			               
			            </div>
			            <div class="layui-form-item">
			                <label class="layui-form-label">路由地址</label>
			                <div class="layui-input-block">
			                    <input type="text" name="url" placeholder="路由地址" autocomplete="off" class="layui-input" value="" lay-verify="">
			                </div>
			               
			            </div>

			             <div class="layui-form-item">
			                <label class="layui-form-label">排序</label>
			                <div class="layui-input-block">
			                    <input type="text" name="sort" placeholder="图标" autocomplete="off" class="layui-input" value="" lay-verify="">
			                </div>
			            </div>

			            <div class="layui-form-item">
			                <label class="layui-form-label">图标</label>
			                <div class="layui-input-block">
			                    <input type="text" name="icon" placeholder="图标" autocomplete="off" class="layui-input" value="" lay-verify="">
			                </div>
			            </div>

			            <div class="layui-form-item layui-form-text">
			                <label class="layui-form-label">描述</label>
			                <div class="layui-input-block">
			                    <textarea placeholder="请输入内容" class="layui-textarea" name="description"></textarea>
			                </div>
			            </div>
			            
			            <div class="layui-form-item">
			                <button class="layui-btn" lay-submit="" lay-filter="permission_add">跳转式提交</button>
			            </div>
			            
		        </form>
		    </div>
	    </div>
    </div>
@endsection
@section('js')
@parent
<script>

    layui.use(['form', 'layedit'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;

       /* //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');*/

        //自定义验证规则
        form.verify({
           
        });

        // 进行登录操作
        form.on('submit(permission_add)', function (data) {
            
            dat = data.field;
             $.ajax({
            url: "/admin/permission/",
            type: 'POST',
            dataType: 'json',
            data: dat,
            success:function(data){
               
               if(data.code != 200){

                    

                    layer.msg(data.message,{icon:5});

               }else{
                   
                   layer.msg(data.message,{icon:1});
                   setTimeout(function () { 
      					window.location.href="/admin/permission/";
                   }, 1000);
                   

                   
               }
            },error:function(data){
                console.log("网络错误");
            }
          });

         return false;

        });
    });
</script>

@endsection

