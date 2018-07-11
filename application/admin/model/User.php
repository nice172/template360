<?php
namespace app\admin\model;
use think\Model;
use think\Validate;

class User extends Model {
    
    protected $rule = [
        'username' => 'require|max:50|checkName:1',
        'password' => 'require',
        'email' => 'email|checkEmail:1',
        'mobile' => 'require|checkMobile:1'
    ];
    protected $message = [
        'username.require' => '请输入用户名',
        'username.checkName' => '用户名已存在',
        'password' => '请输入登录密码',
        'email' => '邮箱格式错误',
        'mobile.require' => '请输入手机号码',
    ];
    
    protected $scene = [
        'add' => ['username','password','checkName','email','checkEmail','checkMobile'],
        'edit' => ['username','checkName','email','checkEmail','checkMobile']
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
        $validate->extend([
            'checkName' => [$this,'checkName'],
            'checkEmail' => [$this,'checkEmail'],
            'checkMobile' => [$this,'checkMobile'],
        ]);
        if(!$validate->scene('add',$this->scene['add'])->check($data)){
            return $validate->getError();
        }
        if (!isset($data['status'])) $data['status'] = 0;
        if ($this->insert($data)){
            return true;
        }
        return false;
    }
    
    public function checkEmail($value,$rule,$data){
        $where = ['email' => $value];
        if (isset($data['id'])){
            $where = array(
                'email' => $value,
                'id' => ['NEQ',$data['id']]
            );
        }
        $info = $this->find($where);
        if (empty($info)) return true;
        return '邮箱已存在';
    }
    
    public function checkMobile($value,$rule,$data){
        $where = ['mobile' => $value];
        if (isset($data['id'])){
            $where = array(
                'mobile' => $value,
                'id' => ['NEQ',$data['id']]
            );
        }
        $info = $this->find($where);
        if (empty($info)) return true;
        return '手机号码已存在';
    }
    
    /**
     * 修改管理员信息
     */
    public function edit($data){
        if (empty($data['password'])){
            unset($data['password']);
            unset($this->rule['password'],$this->message['password']);
        }
        $validate = new Validate($this->rule,$this->message);
        $validate->extend(['checkName' => [$this,'checkName'],
            'checkEmail' => [$this,'checkEmail'],
            'checkMobile' => [$this,'checkMobile'],
        ]);
        if(!$validate->scene('edit',$this->scene['edit'])->check($data)){
            return $validate->getError();
        }
        if (isset($data['password']) && !empty($data['password'])){
            $passlat = password_salt();
            $data['passsalt'] = $passlat;
            $data['password'] = md5($data['password'].$passlat);
        }
        $user = session('admin_user');
        if (intval($data['id']) <= 0) return false;
        if ($user['id']!=1 && intval($data['id']) == 1) return false;
        if (!isset($data['status'])) $data['status'] = 0;
        if ($this->save($data,['id' => $data['id']])){
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
        $where = ['username' => $value];
        if (isset($data['id'])) {
            $where = array(
                'username' => $value,
                'id' => array('NEQ',$data['id'])
            );
        }
        if ($this->find($where)){
            return false;
        }
        return true;
    }
    
    
}