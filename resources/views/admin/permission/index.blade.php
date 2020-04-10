@extends('admin.layouts.app')

@section('css')
    @parent
@endsection

@section('content')
      <div class="layuimini-main">
        <div>
            <div class="layui-btn-group">
                <button class="layui-btn" id="btn-expand">全部展开</button>
                <button class="layui-btn" id="btn-fold">全部折叠</button>
            </div>
            <table id="munu-table" class="layui-table" lay-filter="munu-table"></table>
        </div>
    </div>
    <script type="text/html" id="auth-state">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
         <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
@endsection
@section('js')
@parent
<script src="/static/admin/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
<script>
 layui.use(['table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;

        // 渲染表格
        layer.load(2);
        treetable.render({
            treeColIndex: 1,
            treeSpid: -1,
            treeIdName: 'authorityId',
            treePidName: 'parentId',
            elem: '#munu-table',
            url: "/admin/permission/list",
            page: false,
            cols: [[
                {type: 'numbers'},
                {field: 'name', minWidth: 100, title: '权限名称'},
                {field: 'display_name',  minWidth: 100,  title: '显示名称'},
                {field: 'url',  minWidth: 100,title: '路由地址'},
                {field: 'sort', minWidth: 80, align: 'center', title: '排序号'},
                {
                    field: 'is_show', minWidth: 80, align: 'center', templet: function (d) {
                        if (d.show == 0) {
                            return '<span class="layui-badge layui-bg-gray">不显示</span>';
                        }
                        else {
                            return '<span class="layui-badge layui-bg-blue">显示</span>';
                        } 
                    }, title: '是否在菜单显示'
                },
                {field: 'description', minWidth: 80, align: 'center', title: '描述'},
                {templet: '#auth-state', minWidth: 120, align: 'center', title: '操作'}
            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });

        $('#btn-expand').click(function () {
            treetable.expandAll('#munu-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#munu-table');
        });

        //监听工具条
        table.on('tool(munu-table)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.msg('删除' + data.id);
            } else if (layEvent === 'edit') {
                layer.msg('修改' + data.id);
            }
        });
    });
</script>
@endsection

