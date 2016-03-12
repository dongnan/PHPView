# PHPView

PHPView 是以PHP作为模板引擎的View工具类。

# 环境要求

- PHP >= 5.3

# 安装

## composer 安装
PHPView 可以通过 `composer` 安装，使用以下命令从 `composer` 下载安装 PHPView。

``` bash
$ composer require dongnan/phpview
```
## 手动下载安装
### 下载地址
- 在 `Git@OSC` 下载 http://git.oschina.net/dongnan/PHPView/tags
- 在 `GitHub` 下载 https://github.com/dongnan/PHPView/releases

### 安装方法
在你的入口文件中引入
```
<?php 
	//引入 PHPView 的自动加载文件
	include("path_to_linkcache/autoload.php");
```

# 如何使用

PHP代码：(假如模板文件的路径为 view\template.html)
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$view = new \PHPView\View();

//模板变量赋值
$view->assign('name','Dong Nan');

//数组赋值
$view->assign(array('gender'=>'male' 'birthday'=>'1986'));

//输出页面内容
$view->render('view\template.html');
```

模板：
```html
<html>
	<head>
		<meta charset='utf-8'>
	</head>
	<body>
		<div>name:<?=$name?></div>
		<div>gender:<?=$gender?></div>
		<div>birthday:<?=$birthday?></div>
	</body>
</html>
```

# LICENSE

使用非常灵活宽松的 [New BSD License](http://opensource.org/licenses/BSD-3-Clause) 协议
