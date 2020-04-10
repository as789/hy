@extends('admin.layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="/static/admin/css/formSelects-v4.css" media="all">
 
@endsection

@section('content')
    <div class="layuimini-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>用户修改</legend>
        </fieldset>
          <div class="layui-row">
          	
          	<div class="layui-col-xs12 layui-col-sm12 layui-col-md8">

		        <form class="layui-form layui-form-pane" style="padding: 0 16px;text-align: center;" action="" method="post">
		        	   
						<input type="hidden" name="id" autocomplete="off"  value="{{$data->id}}" class="layui-input" lay-verify="">

			           <div class="layui-form-item">
			                <label class="layui-form-label">用户名</label>
			                <div class="layui-input-block">
			                    <input type="text" name="username" autocomplete="off" placeholder="请输入用户名" value="{{$data->username}}" class="layui-input" lay-verify="">
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <label class="layui-form-label">邮箱</label>
			                <div class="layui-input-block">
			                    <input type="text" name="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{$data->email}}" lay-verify="">
			                </div>
			               
			            </div>
			            <div class="layui-form-item">
	                        <label class="layui-form-label">角色</label>
	                        <div class="layui-input-block">
	                            <select name="role" xm-select="role" lay-verify="">
	                                <option value=""></option>
	                                <option value="5">北京</option>
	                                <option value="6">上海</option>
	                                <option value="3">天津</option>
	                                <option value="4">重庆</option>
	                            </select>
	                        </div>
                    	</div>
			            <div class="layui-form-item">
			                <button class="layui-btn" lay-submit="" lay-filter="save_admin">跳转式提交</button>
			            </div>
		        </form>
		    </div>
	    </div>
    </div>
@endsection
@section('js')
@parent
<script src="/static/admin/js/formSelects-v4.js" charset="utf-8"></script>
<script>

	var formSelects = layui.formSelects;

	formSelects.value('role', "{{$data->role}}".split(","));

    layui.use(['form', 'layedit'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            username: function(value, item){ 
            	   if(value.trim(" ").length == 0){
            	   	    return "请输入用户名"
            	   }
            	   var reg = /[a-zA-Z0-9]{1,20}/;
				    if(!reg.test(value)){
				        
				        return "请输入1-20位字母或者数字";
				    }

				},

		    email: function(value, item){ 
        	 	
        	 	if(value.trim(" ").length == 0){
            	   	return "请输入邮箱";
            	}
            
			    var reg = /[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/;
				if(!reg.test(value)){
				        
				    return "请输入正确的邮箱";
				}

			},
			password: function(value, item){

        	  if(value.trim(" ").length == 0){

            	   	return "请输入密码";
            	}
			    var reg = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}/;
				if(!reg.test(value)){
				        
				    return "请输入6-18位字母和数字的组合";
				}

			},

			password_confirmation: function(value, item){

        	    if(value.trim(" ").length == 0){
        	   	
            	   	return "请确认密码";
            	}
            
			    var password = $("#password").val();
			   
				if(password != value){
				        
				    return "密码不一致请重新输入";
				}

			},

			role: function(value, item){ 
        	    
        	    if(value.trim(" ").length == 0){
                    $(".layui-form-pane .xm-select-title").addClass('layui-form-danger')/*({
                    	"border": '1px #FF5722 solid',
                    });*/
            	   	return "至少选择一个角色";
            	}

            	
			}
              
			
        });


        // 进行登录操作
        form.on('submit(save_admin)', function (data) {
            
            dat = data.field;
             $.ajax({
            url: "/admin/admin/"+dat.id,
            type: 'PUT',
            dataType: 'json',
            data: dat,
            success:function(data){
               
               if(data.code != 200){

                    if(data.code == 4233||data.code == 4224){

                        $('#captchaPic').click();
                    }

                    layer.msg(data.message,{icon:5});

               }else{
                   
                   layer.msg(data.message,{icon:1});
                   setTimeout(function () { 
      					window.location.href="/admin/admin/";
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

