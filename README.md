
# QingMVC官方案例

# 使用方法

- 创建数据库'qingmvc_demo'
- 导入数据库文件database.sql

# 访问

- 设置根目录为public
- 或访问目录public

```
index.php
index.php/add
index.php/.test/Com01
```

# HelloWorld-创建第一个应用

qingmvc官方案例

# 获取源码

https://github.com/qingmvc/qingmvc_demo

- 下载源码压缩包，解压
- 克隆仓库到本地

# 安装

- comporser : php composer.phar install
- 或手动加载qingmvc依赖

# 应用目录

## 常用应用目录介绍

详见 [1.3.应用目录](http://books.qingmvc.com/qingmvc/1.3.应用目录.md)

## 案例应用目录介绍

- **main** (主模块根目录)
	- **config** (配置目录)
		- **local.configs.php** (本地环境配置子包含文件)
		- **local.db.php** (本地环境配置子包含文件)
		- **main.configs.php** (用户配置组件)
		- **main.db.php** (数据库组件配置)
		- **main.php** (主配置文件，所以环境使用这些配置为基础)
	- **run.php** (入口文件，可修改，public包含该文件)
- **public** (公开访问目录，存放可以访问的php/js/css/图片等文件)
	- **static** (前端静态文件目录，js/css/图片)
	- **index.php** (应用入口文件)
- **test** (测试用例目录)
- **tests** (第三方依赖目录，composer)
- **tests** (测试用例目录)
- **vendor** (第三方依赖目录，composer)
- **composer.json** (composer配置文件)
- **composer.sh** (composer脚本帮助文件)
- **database.sql** (数据库文件，表创建语句和测试数据语句)

# 入口文件

## 应用目录

- **main** (应用根目录/主模块根目录)
	- **run.php** (入口文件，可修改，public包含该文件)
- **public** (公开访问目录，存放可以访问的php/js/css/图片等文件)
	- **static** (前端静态文件目录，js/css/图片)
	- **index.php** (应用入口文件)

## 启动流程

```
//#访问公开文件
/pulic/index.php

//#包含run.php文件
require __DIR__.'/../main/run.php';

//#debug模式
define('APP_DEBUG'			,true);
//#自定义错误报告等级
define('APP_ERROR_LEVEL'	,E_ALL ^E_NOTICE);

//#加载qingmvc框架
//composer加载
$Q_composer=require __DIR__.'/../vendor/autoload.php';
//qingmvc自动加载器
//require_once __DIR__.'/../../qingmvc2018/qingmvc07/autoload.php';

//#主配置文件
$configFile=__DIR__.'/config/main.php';
//\qing\Qing::runWebApp($configFile);
//#创建应用实例
$app=new \qing\app\WebApp($configFile);
//#执行应用，解析http请求
$app->run();

```


# 应用部署

## 创建数据库

- 创建数据库： qingmvc_demo
- 导入表和数据：**database.sql** 
- 修改数据库用户名和密码: **config/main.db.php**

# 部署框架和依赖

- 应用依赖：qingmvc框架和qingtpl模版编译引擎
- 加载方式: composer模式或qingmvc模式

## 使用composer部署

- composer用法这里不做具体介绍

```
//#安装依赖包
php composer.phar install

//#注册类自动加载器
//注意：$Q_composer必须，不可改名；如果改名或者该全局变量未定义；其他的类自动加载将使用qingmvc模式。
$Q_composer=require __DIR__.'/../vendor/autoload.php';

```

## 使用qingmvc部署

- 下载依赖包到本地解压
- 比如/vendor/qingmvc和/vendor/qingtpl

### 1. 注册类自动加载器

```
require_once '/vendor/qingmvc/autoload.php';
```

### 2. 依赖命名空间自动加载映射

```
//命名空间自动加载映射
'namespaces' =>
[
	'qingtpl'=>'vendor/qingtpl/src',
	//'FastRoute'=>'FastRoute/src'	
],
```

# 访问入口文件

- 至此部署完毕
- 访问入口文件：public/index.php
