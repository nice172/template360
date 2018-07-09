<?php

//define('AUTO_RELOAD', true);
//require_once 'autoReload.php';

$http = new swoole_http_server('0.0.0.0', 9502);
$http->set([
    'reactor_num' => 2,
    'worker_num' => 4,
    'task_worker_num' => 8,
    'max_request' => 10000,
    'pid_file' => __DIR__.'/server.pid',
]);

$http->on('WorkerStart', function(swoole_server $server,$worker_id) {
    
    // 定义应用目录
    define('BASE_PATH', dirname(__DIR__));
    define('APP_PATH',  BASE_PATH. '/application/');
    // ThinkPHP 引导文件
    // 1. 加载基础文件
    require_once BASE_PATH.'/thinkphp/base.php';
    
});

$http->on('Request', function(swoole_http_request $request, swoole_http_response $response) use ($http){
    //$http->task(json_encode(['username' => 'nice172','uid' => 100]));
    if ($request->server['path_info'] == '/favicon.ico'){
        $response->end();
        return;
    }

    if (!$http->exist($request->fd)) {
        $response->end();
        $http->close();
        return;
    }
    $_GET = $_POST = $_REQUEST = $_SERVER = $_FILES = [];
    if (isset($request->get)) {
        foreach ($request->get as $key => $value){
            $_GET[$key] = $value;
        }
    }
    
    if (isset($request->post)) {
        foreach ($request->post as $key => $value){
            $_POST[$key] = $value;
        }
    }
    
    $_REQUEST = array_merge($_GET, $_POST);
    
    foreach ($request->header as $key => $value){
        $_SERVER[strtoupper($key)] = $value;
    }
    
    foreach ($request->server as $key => $value){
        $_SERVER[strtoupper($key)] = $value;
    }
    $_SERVER['SWOOLE_CLI'] = true;
    $_SERVER['SWOOLE_SERVER'] = $http;
    $_SERVER['SWOOLE_REQUEST'] = $request;
    $_SERVER['SWOOLE_RESPONSE'] = $response;
    
    if (isset($request->files)) {
        
    }
    
    ob_start();
    try {
        // 2. 执行应用
        \think\App::run()->send();
    } catch (Exception $e) {
        echo "<pre>".$e->__toString()."</pre>";
    }
    $content = ob_get_contents();
    ob_end_clean();
    $response->end($content);
});

$http->on('Task', function (swoole_server $server, $task_id, $src_worker_id, $data) use ($http){
    
    //调用finish方法和return数据是相同的
    //$http->finish()可以多次调用
    $http->finish($data);
    
});

//Task回调函数执行完成后调用Finish方法
$http->on('Finish', function(swoole_server $server, $task_id, $data){
    print_r($data);
});


$http->start();















