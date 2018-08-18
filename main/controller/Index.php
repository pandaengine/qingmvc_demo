<?php
namespace main\controller;
use main\models\Sites;
/**
 * 用户中心
 *
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Index extends Base{
	/**
	 * 默认操作首页
	 */
	public function index(){
		defined('QDEBUG') && qdebug_console(__METHOD__);
		defined('QDEBUG') && qdebug_node(__METHOD__);
		
		$sites=Sites::latest();
		
		defined('QDEBUG') && qdebug_node(__METHOD__);
		defined('QDEBUG') && qdebug_breakpoint();
		
		return $this->render('',['sites'=>$sites]);
	}
}
?>