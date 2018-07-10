<?php
namespace app\admin\model;
use think\Model;
use think\Validate;

class User extends Model {
    
    protected $rule = [
        'username' => 'require|max:50|checkName:1',
        'password' => 'require',
        'email' => 'email',
    ];
    protected $message = [
        'username.require' => '请输入用户名',
        'username.checkName' => '用户名已存在',
        'password' => '请输入登录密码',
        'email' => '邮箱格式错误',
    ];
    
    protected $scene = [
        'add' => ['username','password','checkName','email'],
        'edit' => ['username','email']
    ];
    
    
    public function lists(){
    	return $this->order('id ASC')->select();
    }

    //获取一条数据
    public function find($where){
        if (empty($where)) return null;
        $result = $this->where($where)->find();
        return $result;
    }
    
    //登录更新数据
    public function loginUpdate($id,$data){
        return $this->save($data,['id' => $id]);
    }
    
    /**
     * 新增管理员
     * @param array $data
     * @return array|mixed|string|boolean|boolean
     */
    public function add($data){
        $validate = new Validate($this->rule,$this->message);
        $validate->extend(['checkName' => [$this,'checkName']]);
        if(!$validate->scene('add',$this->scene['add'])->check($data)){
            return $validate->getError();
        }
        if ($this->insert($data)){
            return true;
        }
        return false;
    }
    
    /**
     * 验证用户名是否存在
     * @param String $value
     * @param String $rule
     * @param Array $data
     * @return bool
     */
    public function checkName($value, $rule, $data){
        if ($this->find(['username' => $value])){
            return false;
        }
        return true;
    }
    
    
}