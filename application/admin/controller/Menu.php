<?php

namespace app\admin\controller;

use think\Db;
use tree\Tree;
use app\admin\model\AdminMenu;
class Menu extends Base {
    
    /**
     * 后台菜单管理
     * @adminMenu(
     *     'name'   => '后台菜单',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单管理',
     *     'param'  => ''
     * )
     */
    public function index(){
        session('admin_menu_index', 'Menu/index');
        $result = Db::name('AdminMenu')->order(["list_order" => "ASC"])->select();
        $tree = new Tree();
        $tree->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $newMenus = [];
        foreach ($result as $m) {
            $newMenus[$m['id']] = $m;
        }
        foreach ($result as $key => $value) {

            $result[$key]['parent_id_node'] = ($value['parent_id']) ? ' data-tt-parent-id="node-' . $value['parent_id'] . '"' : '';
            $result[$key]['style'] = empty($value['parent_id']) ? '' : 'display:none;';
            $result[$key]['str_manage'] = '<a href="' . url("Menu/add", ["parent_id" => $value['id'], "menu_id" => $this->request->param("menu_id")])
                . '">添加子菜单</a> <span class="text-explode">|</span> <a href="' . url("Menu/edit", ["id" => $value['id'], "menu_id" => $this->request->param("menu_id")])
                . '">编辑</a> <span class="text-explode">|</span> <a class="js-ajax-delete" href="' . url("Menu/delete", ["id" => $value['id'], "menu_id" => $this->request->param("menu_id")]) . '">删除</a>';
                $result[$key]['status'] = $value['status'] ? '<input type="checkbox" checked="checked" value="'.$value['id'].'" name="open" lay-skin="switch" lay-filter="switchTest" title="显示">' : '<input type="checkbox" value="'.$value['id'].'" name="open" lay-skin="switch" lay-filter="switchTest" title="隐藏">';
            if (config('APP_DEBUG')) {
                $result[$key]['app'] = $value['app'] . "/" . $value['controller'] . "/" . $value['action'];
            }
        }

        $tree->init($result);
        $str = "<tr data-tt-id='node-\$id' \$parent_id_node style='\$style'>
                        <td style='padding-left:10px;'><input name='list_orders[\$id]' type='text' size='3' value='\$list_order' class='layui-input' style='display:inline-block;width:80px;height:30px;'></td>
                        <td>\$id</td>
                        <td>\$spacer\$name</td>
                        <td>\$app</td>
                        <td>\$status</td>
                        <td>\$str_manage</td>
                    </tr>";
        $category = $tree->getTree(0, $str);
        $this->assign("category", $category);
        return $this->fetch();
    }

    /**
     * 后台所有菜单列表
     * @adminMenu(
     *     'name'   => '所有菜单',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台所有菜单列表',
     *     'param'  => ''
     * )
     */
    public function lists(){
        session('admin_menu_index', 'Menu/lists');
        $result = Db::name('AdminMenu')->order(["app" => "ASC", "controller" => "ASC", "action" => "ASC"])->select();
        $this->assign("menus", $result);
        return $this->fetch();
    }

    /**
     * 后台菜单添加
     * @adminMenu(
     *     'name'   => '后台菜单添加',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单添加',
     *     'param'  => ''
     * )
     */
    public function add(){
        $tree     = new Tree();
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $result   = Db::name('AdminMenu')->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);
        $this->assign("select_category", $selectCategory);
        return $this->fetch();
    }

    /**
     * 后台菜单添加提交保存
     * @adminMenu(
     *     'name'   => '后台菜单添加提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单添加提交保存',
     *     'param'  => ''
     * )
     */
    public function doadd(){
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            if (isset($data['status'])) {
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $result = $this->validate($data, 'AdminMenu');
            if ($result !== true) {
                $this->error($result);
            } else {
                Db::name('AdminMenu')->strict(false)->field(true)->insert($data);
                $app          = $this->request->param("app");
                $controller   = $this->request->param("controller");
                $action       = $this->request->param("action");
                $param        = $this->request->param("param");
                $authRuleName = "$app/$controller/$action";
                $menuName     = $this->request->param("name");

                $findAuthRuleCount = Db::name('auth_rule')->where([
                    'app'  => $app,
                    'name' => $authRuleName,
                    'type' => 'admin_url'
                ])->count();
                if (empty($findAuthRuleCount)) {
                    Db::name('AuthRule')->insert([
                        "name"  => $authRuleName,
                        "app"   => $app,
                        "type"  => "admin_url", //type 1-admin rule;2-user rule
                        "title" => $menuName,
                        'param' => $param,
                    ]);
                }
                $sessionAdminMenuIndex = session('admin_menu_index');
                $to = empty($sessionAdminMenuIndex) ? "Menu/index" : $sessionAdminMenuIndex;
                cache('admin_menus',null);// 删除后台菜单缓存
                $this->success("添加成功！", url($to));
            }
        }
    }

    /**
     * 后台菜单编辑
     * @adminMenu(
     *     'name'   => '后台菜单编辑',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单编辑',
     *     'param'  => ''
     * )
     */
    public function edit(){
        $tree   = new Tree();
        $id     = $this->request->param("id", 0, 'intval');
        $rs     = Db::name('AdminMenu')->where(["id" => $id])->find();
        $result = Db::name('AdminMenu')->order(["list_order" => "ASC"])->select();
        $array  = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $rs['parent_id'] ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);
        $this->assign("data", $rs);
        $this->assign("select_category", $selectCategory);
        return $this->fetch();
    }

    /**
     * 后台菜单编辑提交保存
     * @adminMenu(
     *     'name'   => '后台菜单编辑提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单编辑提交保存',
     *     'param'  => ''
     * )
     */
    public function editdo(){
        if ($this->request->isAjax()) {
            $id  = $this->request->param('id', 0, 'intval');
            $oldMenu = Db::name('AdminMenu')->where(['id' => $id])->find();

            $data = $this->request->param();
            if (isset($data['status'])) {
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            
            $result = $this->validate($data, 'AdminMenu.edit');

            if ($result !== true) {
                $this->error($result);
            } else {
                Db::name('AdminMenu')->strict(false)->field(true)->update($data);
                $app          = $this->request->param("app");
                $controller   = $this->request->param("controller");
                $action       = $this->request->param("action");
                $param        = $this->request->param("param");
                $authRuleName = "$app/$controller/$action";
                $menuName     = $this->request->param("name");

                $findAuthRuleCount = Db::name('auth_rule')->where([
                    'app'  => $app,
                    'name' => $authRuleName,
                    'type' => 'admin_url'
                ])->count();
                if (empty($findAuthRuleCount)) {
                    $oldApp        = $oldMenu['app'];
                    $oldController = $oldMenu['controller'];
                    $oldAction     = $oldMenu['action'];
                    $oldName       = "$oldApp/$oldController/$oldAction";
                    $findOldRuleId = Db::name('AuthRule')->where(["name" => $oldName])->value('id');
                    if (empty($findOldRuleId)) {
                        Db::name('AuthRule')->insert([
                            "name"  => $authRuleName,
                            "app"   => $app,
                            "type"  => "admin_url",
                            "title" => $menuName,
                            "param" => $param
                        ]);//type 1-admin rule;2-user rule
                    } else {
                        Db::name('AuthRule')->where(['id' => $findOldRuleId])->update([
                            "name"  => $authRuleName,
                            "app"   => $app,
                            "type"  => "admin_url",
                            "title" => $menuName,
                            "param" => $param]);//type 1-admin rule;2-user rule
                    }
                } else {
                    Db::name('AuthRule')->where([
                        'app'  => $app,
                        'name' => $authRuleName,
                        'type' => 'admin_url'
                    ])->update(["title" => $menuName, 'param' => $param]);//type 1-admin rule;2-user rule
                }
                cache('admin_menus',null);// 删除后台菜单缓存
                $this->success("保存成功！");
            }
        }
    }

    /**
     * 后台菜单删除
     * @adminMenu(
     *     'name'   => '后台菜单删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单删除',
     *     'param'  => ''
     * )
     */
    public function delete(){
        $id    = $this->request->param("id", 0, 'intval');
        $count = Db::name('AdminMenu')->where(["parent_id" => $id])->count();
        if ($count > 0) {
            $this->error("该菜单下还有子菜单，无法删除！");
        }
        if (Db::name('AdminMenu')->delete($id) !== false) {
            $this->success("删除菜单成功！");
        } else {
            $this->error("删除失败！");
        }
    }

    public function status(){
        $id = $this->request->param("id", 0, 'intval');
        $status = $this->request->param("status", 0, 'intval');
        if (Db::name('AdminMenu')->where(['id' => $id])->setField('status',$status)) {
            $this->success("设置成功");
        } else {
            $this->error("设置失败");
        }
    }
    
    /**
     * 后台菜单排序
     * @adminMenu(
     *     'name'   => '后台菜单排序',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台菜单排序',
     *     'param'  => ''
     * )
     */
    public function listorder(){
        $adminMenuModel = new AdminMenu();
        parent::listOrders($adminMenuModel);
        $this->success("排序更新成功！");
    }

}