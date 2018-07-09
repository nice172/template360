<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\User as userModel;

// 控制器基类

class Base extends Controller {
    
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
        $this->assign('user',$user);
    }
    
}
