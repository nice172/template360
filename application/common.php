<?php

use think\Db;

function p($data){
    header('Content-Type:text/html;charset=utf-8');
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/**
 * 获取系统配置
 * @param string $key
 * @return array
 */
function tpt360_get_config($key){
    if (!is_string($key) || empty($key)) {
        return [];
    }
    
    static $GetOption;
    
    if (empty($GetOption)) {
        $GetOption = [];
    } else {
        if (!empty($GetOption[$key])) {
            return $GetOption[$key];
        }
    }
    
    $optionValue = cache('options_' . $key);
    
    if (empty($optionValue)) {
        $optionValue = Db::name('option')->where('option_name', $key)->value('option_value');
        if (!empty($optionValue)) {
            $optionValue = json_decode($optionValue, true);
            cache('options_' . $key, $optionValue);
        }
    }
    $GetOption[$key] = $optionValue;
    return $optionValue;
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
