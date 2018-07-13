<?php

function get_current_admin_id(){
    $user = session('admin_user');
    if (empty($user)) return null;
    return $user['id'];
}


/**
 * 检查权限
 * @param $userId  int        要检查权限的用户 ID
 * @param $name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
 * @param $relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
 * @return boolean            通过验证返回true;失败返回false
 */
function auth_check($userId, $name = null, $relation = 'or'){
    if (empty($userId)) {
        return false;
    }
    
    if ($userId == 1) {
        return true;
    }
    
    $authObj = new \lib\Auth();
    if (empty($name)) {
        $request    = request();
        $module     = $request->module();
        $controller = $request->controller();
        $action     = $request->action();
        $name       = strtolower($module . "/" . $controller . "/" . $action);
    }
    return $authObj->check($userId, $name, $relation);
}

/**
 * 生成访问插件的url
 * @param string $url url格式：插件名://控制器名/方法
 * @param array $param 参数
 * @param bool $domain 是否显示域名 或者直接传入域名
 * @return string
 */
function plugin_url($url, $param = [], $domain = false){
    $url              = parse_url($url);
    $case_insensitive = true;
    $plugin           = $case_insensitive ? \think\Loader::parseName($url['scheme']) : $url['scheme'];
    $controller       = $case_insensitive ? \think\Loader::parseName($url['host']) : $url['host'];
    $action           = trim($case_insensitive ? strtolower($url['path']) : $url['path'], '/');
    
    /* 解析URL带的参数 */
    if (isset($url['query'])) {
        parse_str($url['query'], $query);
        $param = array_merge($query, $param);
    }
    
    /* 基础参数 */
    $params = [
        '_plugin'     => $plugin,
        '_controller' => $controller,
        '_action'     => $action,
    ];
    $params = array_merge($params, $param); //添加额外参数
    
    return url('\\cmf\\controller\\PluginController@index', $params, true, $domain);
}