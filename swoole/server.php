<?php

class HttpServer {
    
    private $server = null;
    private $host = '0.0.0.0';
    private $port = 9502;
    private $daemonize = 0;
    
    private function init(){
        $this->server = new swoole_http_server($this->host, $this->port);
        $this->server->set([
            'reactor_num' => 2,
            'worker_num' => 4,
            'task_worker_num' => 8,
            'max_request' => 10000,
            'daemonize' => $this->daemonize,
            'pid_file' => __DIR__.'/server.pid',
        ]);
        $this->server->on('WorkerStart', [$this,'onWorkerStart']);
        $this->server->on('Request', [$this,'onRequest']);
        $this->server->on('Task', [$this,'onTask']);
        $this->server->on('Finish', [$this,'onFinish']);
    }
    
    public function onWorkerStart(swoole_server $server,$worker_id){
        // 定义应用目录
        define('BASE_PATH', dirname(__DIR__));
        define('APP_PATH',  BASE_PATH. '/application/');
        // ThinkPHP 引导文件
        // 1. 加载基础文件
        require_once BASE_PATH.'/thinkphp/base.php';
    }
    
    public function onRequest(swoole_http_request $request, swoole_http_response $response){
        // $this->server->task(json_encode(['controller' => 'Service','method' => 'notice','data' => ['msg' => '订单处理成功']]));
        if ($request->server['path_info'] == '/favicon.ico'){
            $response->end();
            return;
        }
        if (!$this->server->exist($request->fd)) {
            $this->server->close();
            $response->end();
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
        $_SERVER['SWOOLE_SERVER'] = $this->server;
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
    }
    
    //task任务
    public function onTask(swoole_server $server, $task_id, $src_worker_id, $data){
        //调用finish方法和return数据是相同的
        //$this->server->finish()可以多次调用
        $this->server->finish($data);
    }
    
    //Task回调函数执行完成后调用Finish方法
    public function onFinish(swoole_server $server, $task_id, $data){
        print_r($data);
    }
    
    public static function displayUI(){
        echo "Swoole+ThinkPHP5".PHP_EOL;
        echo "Swoole Version:".swoole_version().PHP_EOL;
        echo "ThinkPHP5 Version:5.0.18".PHP_EOL;
        echo "PHP Version:".PHP_VERSION.PHP_EOL;
        echo "SwooleServer启动成功...".PHP_EOL;
    }
    
    public function run(){
        // if ($this->daemonize) self::displayUI();
        self::init();
        $this->server->start();
    }
    
}

(new HttpServer())->run();












