<?php
namespace app\admin\model;
use think\Model;

class User extends Model {
    
    protected $rule = [
        'username' => 'require|max:50',
        'password' => 'require',
        'email' => 'email',
        'verify' => 'require'
    ];
    protected $message = [
        'username.require' => '请输入用户名',
        'password' => '请输入登录密码',
        'email' => '邮箱格式错误',
        'verify' => '请输入验证码',
    ];
    
    protected $scene = [
        'add' => ['username','password','email'],
        'edit' => ['username','email']
    ];
    
    
    public function lists(){
    	return $this->order('id ASC')->select();
    }

    //登录获取一条数据
    public function find($data){
        if (isset($data['id'])){
            $where = ['id' => $data['id']];
        }else{
            $where = ['username' => $data['username']];
        }
        $result = $this->where($where)->find();
        return $result;
    }
    
    //登录更新数据
    public function loginUpdate($id,$data){
        return $this->save($data,['id' => $id]);
    }
    
    
    
    
}