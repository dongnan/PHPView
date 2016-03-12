<?php

/**
 * PHPView
 *
 * @author      Dong Nan <hidongnan@gmail.com>
 * @copyright   (c) Dong Nan http://idongnan.cn All rights reserved.
 * @link        https://github.com/dongnan/PHPView
 * @license     BSD (http://opensource.org/licenses/BSD-3-Clause)
 */

namespace PHPView;

use \Exception;

/**
 * PHPView
 *
 * @author DongNan <dongyh@126.com>
 * @date 2016-03-11
 */
class View {

    /**
     * 模板输出变量
     * @var vars
     * @access protected
     */
    protected $vars = array();

    /**
     * 模板变量赋值
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name, $value = '') {
        if (is_array($name)) {
            $this->vars = array_merge($this->vars, $name);
        } else {
            $this->vars[$name] = $value;
        }
    }

    /**
     * 取得模板变量的值
     * @param string $name
     * @return mixed
     */
    public function get($name = '') {
        if ('' === $name) {
            return $this->vars;
        }
        return isset($this->vars[$name]) ? $this->vars[$name] : false;
    }

    /**
     * 解析并获取模板内容
     * @param string $templateFile 模板文件名
     * @param array $data 模板数据
     * @return string
     */
    public function fetch($templateFile, $data = array()) {
        // 模板文件不存在直接返回
        if (!is_file($templateFile)) {
            throw new Exception("TEMPLATE '{$templateFile}' IS NOT EXIST!");
        }
        //如果传入了数据
        if (!empty($data) && is_array($data)) {
            $this->vars = array_merge($this->vars, $data);
        }

        // 页面缓存
        ob_start();
        ob_implicit_flush(0);

        // 模板阵列变量分解成为独立变量
        extract($this->vars, EXTR_OVERWRITE);
        // 直接载入PHP模板
        include $templateFile;

        // 获取并清空缓存
        $content = ob_get_clean();

        // 返回内容
        return $content;
    }

    /**
     * 输出内容文本
     * @param string $templateFile 模板文件名
     * @param array $data 模板数据
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @param string $cacheControl 缓存控制
     * @param string $xPoweredBy X-Powered-By
     * @return mixed
     */
    public function render($templateFile, $data = array(), $charset = 'utf-8', $contentType = 'text/html', $cacheControl = 'private', $xPoweredBy = '') {
        // 网页字符编码
        header('Content-Type:' . $contentType . '; charset=' . $charset);
        // 页面缓存控制
        header('Cache-control: ' . $cacheControl);
        $xPoweredBy && header('X-Powered-By:' . $xPoweredBy);
        //解析并获取模板内容
        $content = $this->fetch($templateFile, $data);
        // 输出模板文件
        echo $content;
    }

}
