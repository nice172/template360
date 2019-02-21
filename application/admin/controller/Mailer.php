<?php
namespace app\admin\controller;
class Mailer extends Base {
    
    public function index(){
        $emailSetting = tpt360_get_config('smtp_setting');
        $this->assign($emailSetting);
        return $this->fetch();
    }
    
    public function save(){
        if ($this->request->isAjax() && $this->request->isPost()) {
            
            p($this->request->post());
            
            
        }
    }
    
}