<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\User as userModel;

// 控制器基类

class Base extends Controller {
    
    protected $user;
    
    //初始化
    public function _initialize(){
        parent::_initialize();
        
        //跳转登录
        if (empty(session('admin_user'))){
            $this->redirect(url('Login/index'));
            exit;
        }
        
        $sessionUser = session('admin_user');
        
        $userModel = new userModel();
        $user = $userModel->find(['id' => $sessionUser['id']]);
        if (empty($user)) {
            session('admin_user',null);
            $this->redirect(url('Login/index'));
            exit;
        }
        
        $this->user = $user;
        $this->assign('user',$user);
        
        $admin_menus = cache('admin_menus');
        if (empty($admin_menus)){
            $adminMenu = new \app\admin\model\AdminMenu();
            $admin_menus = $adminMenu->getTree(0);
            cache('admin_menus',$admin_menus);
        }
//         p($admin_menus);
//         exit;
        $this->assign('admin_menus',$admin_menus);
        
    }
    
    
    /**
     *  排序 排序字段为list_orders数组 POST 排序字段为：list_order
     */
    protected function listOrders($model){
        if (!is_object($model)) {
            return false;
        }
        
        $pk  = $model->getPk(); //获取主键名称
        $ids = $this->request->post("list_orders/a");
        
        if (!empty($ids)) {
            foreach ($ids as $key => $r) {
                $data['list_order'] = $r;
                $model->where([$pk => $key])->update($data);
            }
            
        }
        
        return true;
    }
    
    
}
