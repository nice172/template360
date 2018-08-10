<?php
namespace app\admin\controller;

class Clear extends Base {
    
    // 清空缓存
    public function cache(){
        if ($this->request->isAjax()){
            //清空admin_menus后台菜单
            cache('admin_menus',null);
            if ($this->each([TEMP_PATH,CACHE_PATH])){
                $this->success('清空缓存成功');
            }else{
                $this->error('清空缓存失败');
            }
        }
    }
    
    /**
     * 遍历删除目录和文件
     * @param array|string $paths
     */
    private function each($paths){
        if (!is_array($paths)) $paths = [$paths];
        static $i = 0;
        foreach ($paths as $path){
            if (is_dir($path)) {
                if ($handle = opendir($path)){
                    while (($file = readdir($handle)) !== false){
                        if ($file != '.' && $file != '..'){
                            $subPath = $path.$file;
                            if (is_dir($subPath)){
                                $this->each($subPath);
                                continue;
                            }
                            if(@unlink($path.$file)) $i++;
                            
                        }
                    }
                    //if(!@rmdir($path.$file)) $i++;
                }
            }
        }
        return $i;
    }
    
}