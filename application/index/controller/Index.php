<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller {
        
    public function index(){
        
        echo $this->request->module();
        
        session('user',['uid' => 100,'username' => 'nice172']);
        
        return "";
        $this->assign('swoole_version',swoole_version());
        return $this->fetch();
    }
    
    public function test(){
        
        print_r(session('user'));
        echo 'session';
        return;
        return $this->fetch();
    }
    
}
