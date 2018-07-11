<?php

function p($data){
    header('Content-Type:text/html;charset=utf-8');
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/**
 * 生成加密盐
 * @return string
 */
function password_salt(){
    $uniqid = uniqid();
    $salt = str_shuffle(mt_rand(10000,99999).$uniqid);
    return mb_substr($salt, 0,6);
}

/**
 * 生成验证码
 * @return \think\Response
 */
function create_code(){
    $verify = new \think\captcha\Captcha([
        'imageH' => 35,
        'imageW' => 140,
        'fontSize' => 16,
        'codeSet' => '1234567890ABCDE']);
    return $verify->entry();
}
