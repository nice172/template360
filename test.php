<?php

//合并递归或目录分层递归
function get_all_file1($path){
    if($path != '.' && $path != '..' && is_dir($path)){     //判断是否是目录,并且不是. 和..
        $files = [];                                        //存储文件信息
        if($handle = opendir($path)){                       //打开
            while($file = readdir($handle)){                //读取
                if($file != '.' && $file != '..'){
                    $file_name = ($path . DIRECTORY_SEPARATOR . $file);
                    if(is_dir($file_name)){                 //判断是否是目录
                        $files = array_merge($files,get_all_file1($file_name));      //合并递归
                        //$files[$file] = get_all_file1($file_name); //目录分层
                    }else{
                        $files[] = $file_name;
                    }
                }
            }
        }
    }
    closedir($handle);                                          //关闭句柄
    return $files;
}

//print_r(get_all_file1(__DIR__.'/application'));

// for($i=0; $i<3;$i++){
//     print_r(get_all_file1(__DIR__.'/application'));
// }


//合并递归
function get_file($path){
    $files = [];
    $fp = opendir($path);
    while (($file = readdir($fp)) !== false){
        if ($file != '.' && $file != '..'){
            if (is_dir($path.'/'.$file)){
                $files = array_merge($files,get_file($path.'/'.$file));
            }else{
                $files[] = $path.'/'.$file;
            }
        }
    }
    closedir($fp);
    return $files;
}

print_r(get_file(__DIR__.'/application'));



print_r(get_file(__DIR__.'/application'));

print_r(get_file(__DIR__.'/application'));















