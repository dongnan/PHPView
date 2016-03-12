<?php

//自动加载类文件
spl_autoload_register(function($class) {
    if (false !== strpos($class, '\\')) {
        $name = strstr($class, '\\', true);
        if ($name === 'PHPView') {
            $class = ltrim($class, 'PHPView\\');
            $filename = __DIR__ . '/' . 'src/' . str_replace('\\', '/', $class) . '.php';
            if (file_exists($filename)) {
                include $filename;
            }
        }
    }
});
