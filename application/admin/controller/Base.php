<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;
use app\admin\model\User as userModel;
use lib\Auth;

// 控制器基类

class Base extends Controller {
    
    protected $user;
    protected $empty = '<tr><td colspan="20" align="center">当前列表没有查到数据</td></tr>';
    
    //初始化
    public function _initialize(){
        parent::_initialize();
        
        //跳转登录
        if (empty(session('admin_user'))){
            $this->redirect(url('Login/index'));
            return;
        }
        
        $sessionUser = session('admin_user');
        
        $userModel = new userModel();
        $user = $userModel->find(['id' => $sessionUser['id']]);
        if (empty($user)) {
            session('admin_user',null);
            $this->redirect(url('Login/index'));
            return;
        }
        
        $this->user = $user;
        $request = \think\Request::instance();
        define('MODULE_NAME', $request->module());
        define('CONTROLLER_NAME', $request->controller());
        define('ACTION_NAME', $request->action());
        define('REQUEST_URL', $request->url());
        $node = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
        if (!in_array($this->user['id'], config('AUTH_CONFIG')['NO_AUTH_USER'])){
            if (!in_array($node, config('AUTH_CONFIG')['NO_AUTH_URL'])){
                $auth = new Auth();
                if(!$auth->check($node, $this->userinfo['id'])){
                    if ($node == strtolower(MODULE_NAME).'/index/index'){
                        Session::clear(); // 清除session值
                        $this->redirect(url('Login/index'));
                    }
                    $this->error('您没有权限访问！');
                }
            }
        }
        
        $this->assign('user',$user);
        
        $admin_menus = cache('admin_menus');
        if (empty($admin_menus)){
            $adminMenu = new \app\admin\model\AdminMenu();
            $admin_menus = $adminMenu->getTree(0);
            cache('admin_menus',$admin_menus);
        }
        $this->assign('admin_menus',$admin_menus);
    }
    
//     public function _empty(){
//         $this->redirect(url('index'));
//     }
    
    
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
