<?php
namespace app\admin\controller;

use tree\Tree;

class Category extends Base {
    
    public function index(){
        $categoryTree = self::CategoryTableTree();
        $this->assign('category_tree', $categoryTree);
        return $this->fetch();
    }
    
    /**
     * @param int|array $currentIds
     * @param string $tpl
     * @return string
     */
    private function CategoryTableTree($currentIds = 0, $tpl = '') {
        $where = ['delete_time' => 0];
        $categories = db('content_category')->order("list_order ASC")->where($where)->select();
        
        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';
        
        if (!is_array($currentIds)) {
            $currentIds = [$currentIds];
        }
        
        $newCategories = [];
        foreach ($categories as $item) {
            $item['checked'] = in_array($item['id'], $currentIds) ? "checked" : "";
            $item['url']     = url('index/List/index', ['id' => $item['id']]);;
            $item['str_action'] = '<a href="' . url("add", ["parent" => $item['id']]) . '">添加子分类</a>  <a href="' . url("edit", ["id" => $item['id']]) . '">编辑</a>  <a class="js-ajax-delete" href="' . url("delete", ["id" => $item['id']]) . '">删除</a> ';
            array_push($newCategories, $item);
        }
        
        $tree->init($newCategories);
        
        if (empty($tpl)) {
            $tpl = "<tr>
                        <td><input name='list_orders[\$id]' type='text' size='3' value='\$list_order' class='input-order'></td>
                        <td>\$id</td>
                        <td>\$spacer <a href='\$url' target='_blank'>\$name</a></td>
                        <td>\$description</td>
                        <td>\$str_action</td>
                    </tr>";
        }
        $treeStr = $tree->getTree(0, $tpl);
        
        return $treeStr;
    }
    
    public function add(){
        
        return $this->fetch();
    }
    
    public function addpost(){
        
    }
    
    public function edit(){
        
    }
    
    public function editpost(){
        
    }
    
    public function delete(){
        
    }
    
    public function listsort(){
        
    }
    
}