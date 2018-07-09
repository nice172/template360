<?php

//生成加密盐
function password_salt(){
    $uniqid = uniqid();
    $salt = str_shuffle(mt_rand(10000,99999).$uniqid);
    return mb_substr($salt, 0,6);
}


