<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller {
    
    public function _empty(){
        $this->redirect(url('index'));
    }
    
    public function index(){
        
        session('user',['uid' => 100,'username' => 'nice172']);
        
        return "";
        $this->assign('swoole_version',swoole_version());
        return $this->fetch();
    }
    
    public function test(){
        
        print_r(session('user'));
        
        return;
        return $this->fetch();
    }
    
}
