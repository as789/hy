@extends('admin.layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="/static/admin/css/formSelects-v4.css" media="all">
 
@endsection

@section('content')
    <div class="layuimini-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>角色修改</legend>
        </fieldset>
          <div class="layui-row">
          	
          	<div class="layui-col-xs12 layui-col-sm12 layui-col-md8">

		        <form class="layui-form layui-form-pane" style="padding: 0 16px;text-align: center;" action="" method="post">
		        	    @method('PUT')
		        	    @csrf

			           <div class="layui-form-item">
			                <label class="layui-form-label">名称</label>
			                <div class="layui-input-block">
			                    <input type="text" name="name" autocomplete="off" placeholder="请输入名称" value="{{$data->name}}" class="layui-input" lay-verify="">
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <label class="layui-form-label">显示名称</label>
			                <div class="layui-input-block">
			                    <input type="text" name="display_name" placeholder="请输入名称" autocomplete="off" class="layui-input" value="{{$data->display_name}}" lay-verify="">
			                </div>
			               
			            </div>
			            <div class="layui-form-item layui-form-text">
			                <label class="layui-form-label">描述</label>
			                <div class="layui-input-block">
			                    <textarea placeholder="请输入内容" class="layui-textarea" name="description">{{$data->description}}</textarea>
			                </div>
			            </div>
			            
			            <div class="layui-form-item">
			                <button class="layui-btn" lay-submit="" lay-filter="save_permission">跳转式提交</button>
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

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

         // 进行登录操作
        form.on('submit(save_permission)', function (data) {
            
            dat = data.field;
             $.ajax({
            url: "/admin/permission/"+dat.id,
            type: 'PUT',
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

