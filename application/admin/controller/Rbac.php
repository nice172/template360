<?php
namespace app\admin\controller;
class Rbac extends Base {
    
    /**
     * 角色列表
     * @return mixed|string
     */
    public function index(){
        
        $this->assign('list',[]);
        return $this->fetch();
    }
    
    /**
     * 新增角色
     * @return mixed|string
     */
    public function add(){
        
        return $this->fetch();
    }
    
}