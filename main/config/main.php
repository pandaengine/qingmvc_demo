<?php
/**
 * 应用配置文件
 */
$__basePath=realpath(__DIR__.DS.'..');

include __DIR__.'/main.configs.php';

// require_once './FastRoute/src/functions.php';

//
return array(
	//模块基础路径
	'basePath'	 =>$__basePath,
	'runtimePath'=>$__basePath.'/../~runtime',
	//应用命名空间
	'namespace'  =>'\main',
	//命名空间自动加载映射
	'namespaces' =>
	[
		//'qingtpl'=>'./qingmvc/qingtpl\src',
		//'qdebug' =>'./qingmvc/qdebug/src',
		//'FastRoute'=>'./FastRoute/src'
	],
	//类别名
	'aliases'=>
	[
		'Config'	=>'\qing\facades\Config',
		'Event'		=>'\qing\facades\Event',
		'Json'		=>'\qing\facades\Json',
		'Log'		=>'\qing\facades\Log',
		'MV'		=>'\qing\facades\MV',
		'Request'	=>'\qing\facades\Request',
		'Db'		=>'\qing\db\Db',
		'L'			=>'\qing\lang\L',
	],
	//设置可侦测环境|只有在主配置有效
	'environments'=>
	[
		'local' =>['hostname','tp-xiaowang']
	],
	//模块列表
	'modules'	=>['main'=>['class'=>'\main\MainModule']],
	//拦截器
	'interceptors'=>
	[
		
	],
	//组件列表
	'components'=>
	[
		//默认数据库连接
		'db@main'=>include __DIR__.'/main.db.php',
		//url别名
		'url_alias'=>
		[
			'class'=>'\qing\url\creators\UrlAlias',
			'maps' =>
			[
				'login2@index'=>'login2',
				'u@Index@index'=>'user',
				'reg@index'=>'reg',
				'home@index'=>function(&$params){
					$url=vsprintf('home/%s/%s',[$params['id'],$params['username']]);
					unset($params['id']);
					unset($params['username']);
					return $url;
				}
			]
		],
		//视图组件
		'view'=>
		[
			'class'=>'\qing\view\CachedView'
		],
		//视图编译组件
		'view.compiler'=>
		[
			'creator'=>'\qingtpl\CompilerCreator',
		],
		//容器，分类实例
		'container'=>
		[
			'cats'=>['M'=>'\main\model\%s','C'=>'\main\controller\%s']
		],
		//异常处理器
		'exception'=>
		[
			'debug'=>false
		],
		//路由器
// 		'router'=>
// 		[
// 			'creator'=>'\qing\routers\FastRouteCreator'
// 		],
		//自定义组件
		//demo01组件
		'demo01'=>
		[
			'class'=>'\main\coms\Demo01',//指定组件类
			'name'=>'xianwang',//属性1
			'nickname'=>'小旺'//属性2
		],
		//demo0101组件
		'demo0101'=>
		[
			'creator'=>'\main\coms\Demo01Creator',//指定组件创建器
			'name'=>'qingmvc',//属性，优先级高，会覆盖组件创建器设置的属性
			'nickname'=>'qingcms'
		],
	],
	//一些配置信息
	'configs'=>$common_config
);
?>