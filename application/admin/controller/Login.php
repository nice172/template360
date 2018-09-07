<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\Validate;
use app\admin\model\User;
// 后台登录控制器
class Login extends Controller {
    
    /**
     * 登录页面
     * @return mixed|string
     */
    public function index(){
        return $this->fetch();
    }
    
    public function _empty(){
        $this->redirect(url('index'));
    }
    
    /**
     * 登录
     */
    public function dologin(){
        if ($this->request->isAjax()){
            $data = $this->request->post();
            $validate = new Validate([
                'username' => ['require','token'],
                'password' => ['require'],
                'verifycode' => ['require']
            ],[
                'username' => '请输入用户名','username.token' => '用户验证失败','password' => '请输入登录密码','verifycode' => '请输入验证码'
            ]);
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $verify = new Captcha();
            if (!$verify->check($data['verifycode'])) $this->error('请输入正确的验证码','',1);
            $userModel = new User();
            $user = $userModel->find(['username' => $data['username']]);
            if (empty($user) || $user['password'] != md5($data['password'].$user['passsalt'])){
                $this->error('登录失败，请重试');
            }
            if (!$user['status']) $this->error('用户被禁止登录');
            $admin_user = ['id' => $user->id,'username' => $user['username']];
            $status = $userModel->loginUpdate($user->id, ['last_login_time' => time(),'last_login_ip' => $this->request->ip()]);
            session('admin_user',$admin_user);
            if (!empty(session('admin_user')) && $status){
                $this->success('登录成功',url('index/index'));
            }
            session('admin_user',null);
            $this->error('登录失败，请重试');
        }
    }
    
    /**
     * 生成验证码
     * @return \think\Response
     */
    public function verify(){
        return create_code();
    }
    
}