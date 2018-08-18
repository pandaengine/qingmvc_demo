<?php
namespace test\controller;
use qing\facades\Coms;
/**
 * 测试案例1
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Com01 extends Base{
	/**
	 * 组件测试
	 */
	public function index(){
		dump(__METHOD__);
		
		$demo01=Coms::get('demo01');
		dump($demo01);
		dump($demo01->name);
		//
		$demo01=Coms::get('demo0101');
		dump($demo01);
		dump($demo01->name);
	}
}
?>