<?php
namespace app\admin\controller;
class Setting extends Base {
    
    public function site(){
        
        return $this->fetch();
    }
    
}