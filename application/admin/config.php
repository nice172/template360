<?php
return [
    
    // AUTH 权限配置
    'AUTH_CONFIG' => array(
        'NO_AUTH_USER' => array(1,2),
        'AUTH_ON' => true,
        'AUTH_USER' => config('database.prefix').'user',
        'NO_AUTH_URL' => array(
        ),
    ),
    'PAGE_SIZE' => 10,
    'UPLOAD_DIR' => 'uploads',
    
    //模板替换
    'view_replace_str' => [
        '__PUBLIC__'=>'/static',
        '__IMG__' => '/static/admin/images',
        '__JS__' => '/static/admin/js',
        '__CSS__' => '/static/admin/css',
        '__LAYUI__' => '/static/layui',
        '__ROOT__' => '/',
    ]
    
];