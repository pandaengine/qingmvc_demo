<?php
/**
 * 本地测试配置
 */

include __DIR__.'/local.configs.php';

return
[
	//#本地环境才开启的模块
	'modules'=>
	[
		//测试模块
		'test'=>
		[
			'class'		=>'\test\Module',
			'classFile'	=>__DIR__.'/../../test/Module.php',
		]
	],
	//组件配置
	'components'=>
	[
		//默认数据库连接
		'db@default'=>include __DIR__.'/local.db.php',
		//视图组件
		'view'=>
		[
			'debug'=>true
		],
		//异常处理器
		'exception'=>
		[
			'debug'=>true
		]
	],
	//拦截器
	'interceptors'=>
	[
		//
		'qdebug'=>'\qdebug\DebugInterceptor',
		//
		'tips'=>
		[
			'class'=>'\qing\tips\TipsBuilderInterceptor',
			'coms' =>true,
			'classes'=>
			[
				['\qing\db\BaseModel',''],
				['\qing\db\Model',''],
				['\qing\db\Where',''],
				['\qing\com\Coms',''],
				['\qing\app\App','']
			],
			'dirs'=>[[__DIR__.'/../model','\main\model']]
		],
		
		'static'=>
		[
			'class'=>'\qing\webstatic\StaticInterceptor',
			'debug'=>false,
			'format'=>false
		],
		'db.backup'=>
		[
			'class'=>'qing\dbx\DbBackupInterceptor',
			'dataOn'=>true,
			'databaseAll'=>false,
			'limitRows'=>20
		],
		'qing\tips\ModelsBuilderInterceptor',
		'qing\tips\TablesBuilderInterceptor',
		//
		'qing\forms\FilterBuilderInterceptor',
		'qing\forms\ValidatorBuilderInterceptor'
	],
	//
	'configs'=>$common_config
];
?>