<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller\Admins;

use Hyperf\HttpMessage\Stream\SwooleStream;

class IndexController extends AbstractController
{   

    

    	
    

    public function home()
    {   

    	return $this->render->render('admin.home.home');
    }

    public function homeIni()
    {   
    	 

     $str = '{
  "clearInfo": {
    "clearUrl": "api/clear.json"
  },
  "homeInfo": {
    "title": "首页",
    "icon": "fa fa-home",
    "href": "index"
  },
  "logoInfo": {
    "title": "LayuiMini",
    "image": "/static/admin/images/logo.png",
    "href": ""
  },
  "menuInfo": {
    "currency": {
      "title": "系统管理",
      "icon": "fa fa-address-book",
      "child": [
        {
          "title": "后台管理",
          "href": "",
          "icon": "fa fa-calendar",
          "target": "",
          "child": [
            {
              "title": "用户管理",
              "href": "/admin/admin/",
              "icon": "fa fa-user",
              "target": "_self"
            },
            {
              "title": "角色管理",
              "href": "/admin/role/",
              "icon": "fa fa-gears",
              "target": "_self"
            },
            {
              "title": "权限管理",
              "href": "/admin/permission/",
              "icon": "fa fa-file-text",
              "target": "_self"
            }
          ]
        }
      ]
    },
    "component": {
      "title": "组件管理",
      "icon": "fa fa-lemon-o",
      "child": [
        {
          "title": "图标列表",
          "href": "page/icon.html",
          "icon": "fa fa-dot-circle-o",
          "target": "_self"
        },
        {
          "title": "图标选择",
          "href": "page/icon-picker.html",
          "icon": "fa fa-adn",
          "target": "_self"
        },
        {
          "title": "颜色选择",
          "href": "page/color-select.html",
          "icon": "fa fa-dashboard",
          "target": "_self"
        },
        {
          "title": "下拉选择",
          "href": "page/table-select.html",
          "icon": "fa fa-angle-double-down",
          "target": "_self"
        },
        {
          "title": "文件上传",
          "href": "page/upload.html",
          "icon": "fa fa-arrow-up",
          "target": "_self"
        },
        {
          "title": "富文本编辑器",
          "href": "page/editor.html",
          "icon": "fa fa-edit",
          "target": "_self"
        }
      ]
    },
    "other": {
      "title": "其它管理",
      "icon": "fa fa-slideshare",
      "child": [
        {
          "title": "多级菜单",
          "href": "",
          "icon": "fa fa-meetup",
          "target": "",
          "child": [
            {
              "title": "按钮1",
              "href": "page/button.html",
              "icon": "fa fa-calendar",
              "target": "_self",
              "child": [
                {
                  "title": "按钮2",
                  "href": "page/button.html",
                  "icon": "fa fa-snowflake-o",
                  "target": "_self",
                  "child": [
                    {
                      "title": "按钮3",
                      "href": "page/button.html",
                      "icon": "fa fa-snowflake-o",
                      "target": "_self"
                    },
                    {
                      "title": "表单4",
                      "href": "page/form.html",
                      "icon": "fa fa-calendar",
                      "target": "_self"
                    }
                  ]
                }
              ]
            }
          ]
        },
        {
          "title": "失效菜单",
          "href": "page/error.html",
          "icon": "fa fa-superpowers",
          "target": "_self"
        }
      ]
    }
  }
}';
    	return $this->response->withBody(new SwooleStream($str));
    }

    public function index()
    {
    	return $this->render->render('admin.home.index');
    }


    //递归获取子菜单
    private function buildMenuChild($pid, $menuList){
        $treeList = [];
        foreach ($menuList as $v) {
            if ($pid == $v->pid) {
                $node = (array)$v;
                $child = $this->buildMenuChild($v->id, $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return $treeList;
    }

}
