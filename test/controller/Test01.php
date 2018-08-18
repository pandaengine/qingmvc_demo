<?php
namespace test\controller;
use qing\facades\Config;
use qing\facades\App;
/**
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Test01 extends Base{
	/**
	 * index.php/.test/test01
	 */
	public function index(){
		dump(__METHOD__);
	}
	/**
	 * index.php/.test/test01/config01
	 */
	public function config01(){
		dump(__METHOD__);
		
		dump(Config::get('site_name'));
		dump(Config::getConfigs());
		
		Config::set('name2','xiaowang');
		dump(Config::get('name2'));
	}
	/**
	 * index.php/.test/test01/mod01
	 */
	public function mod01(){
		dump(App::getModules());
		dump(App::getModule('test'));
		dump(App::getMainModule());
	}
}
?>