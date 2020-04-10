@extends('admin.layouts.app')

@section('css')
    @parent
@endsection

@section('content')
      <div class="layuimini-main">

        <fieldset class="layui-elem-field layuimini-search">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">用户名/邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <a class="layui-btn" lay-submit="" lay-filter="data-search-btn">搜索</a>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <!-- <div class="layui-btn-group">
            <button class="layui-btn data-add-btn">添加</button>
            <button class="layui-btn layui-btn-danger data-delete-btn">删除</button>
        </div> -->
        <table class="layui-hide" id="tableId" lay-filter="tableFilter"></table>
        <script type="text/html" id="tableToolBar">
		  <div class="layui-btn-container">
		    <button class="layui-btn " lay-event="create">添加</button>
		    <!-- <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
		    <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button> -->
		  </div>
		</script>
		 
		<script type="text/html" id="tableBar">
		  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
		  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
		</script>
    </div>
@endsection
@section('js')
@parent
<script>
layui.use('table', function(){
  var table = layui.table;
  
  table.render({
    elem: '#tableId'
    ,url:"/admin/role/list"
    ,toolbar: '#tableToolBar' //开启头部工具栏，并为其绑定左侧模板
    ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
      title: '提示'
      ,layEvent: 'LAYTABLE_TIPS'
      ,icon: 'layui-icon-tips'
    }]
    ,title: '用户数据表'
    ,cols: [[
      	{type: "checkbox", width: 50, fixed: "left"},
	    {field: 'id', width: 120, title: 'ID', sort: true},
	    {field: 'name', width: 200, title: '名称'},
	    {field: 'display_name', width: 240, title: '显示名称'},
	    {field: 'description', title: '描述', minWidth: 150},
	    {field: 'created_at', title: '创建时间', minWidth: 150},
	    {field: 'updated_at', title: '修改时间', minWidth: 150},
	    {title: '操作', minWidth: 50, templet: '#tableBar', fixed: "right", align: "center"}
    ]]
    ,page: true
  });
  
  //头工具栏事件
  table.on('toolbar(tableFilter)', function(obj){
    var checkStatus = table.checkStatus(obj.config.id);
    switch(obj.event){
      case 'create':
        window.location.href="/admin/role/create";
      break;
    };
  });
  
  //监听行工具事件
  table.on('tool(tableFilter)', function(obj){
    var data = obj.data;
    //console.log(obj)
    if(obj.event === 'del'){
      layer.confirm('确定要删除吗？', function(index){
        
        $.ajax({
        	url: "/admin/role/"+data.id,
        	type: 'DELETE',
        	dataType: 'json',
        	success:function($data){
               
                 if($data.code == 200){
                  layer.msg('删除成功',{icon: 1});
              obj.del();
                }else{
                  layer.msg('删除失败',{icon: 5});
                }
        		
        	}
        	,error:function($data){
        		layer.msg('网络错误',{icon: 5});
        	}
        })
        
        
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
    	
      	window.location.href="/admin/role/"+data.id+"/edit";
    }
  });
});
</script>
@endsection

