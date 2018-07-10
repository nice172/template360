<?php
namespace app\admin\controller;
use app\admin\model\User as userModel;
class User extends Base {
    
    private $userModel = null;
    
    public function _initialize(){
        parent::_initialize();
        $this->userModel = new userModel();
    }
    
    public function index(){
    	$this->assign('list',$this->userModel->lists());
        return $this->fetch();
    }
    
    public function status(){
    	if ($this->request->isAjax()){
    		$data = $this->request->post();
    		if (!empty($data) && intval($data['id']) > 0){
    			if(intval($data['id']) == 1) $this->error('超级管理员不能设置');
    			$status = intval($data['status']) == 1 ? 1 : 0;
    			if (db('user')->where(['id' => intval($data['id'])])->setField('status',$status)){
    				$this->success('设置成功');
    			}
    		}
    		$this->error('设置失败');
    	}
    }
    
    public function adduser(){
        if ($this->request->isAjax()){
            $data = input('post.');
            $result = $this->userModel->add($data);
            if ($result === true){
                $this->success('新增管理员成功');
            }
            if (!$result) $this->error('新增管理员失败');
            $this->error($result);
        }else{
           return $this->fetch(); 
        }
    }
    
    //退出系统
    public function logout(){
        session('admin_user',null);
        session_unset();
        $this->redirect(url('login/index'));
    }
    
    
}