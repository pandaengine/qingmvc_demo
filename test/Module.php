<?php
namespace test;
/**
 * 模块
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Module extends \qing\app\Module{
	/**
	 * @var string
	 */
	public $namespace='\test';
	/**
	 * 模块目录
	 *
	 * @var string
	 */
	protected $basePath=__DIR__;
}
?>