<?php
namespace main;
use qing\app\MainModule as MM;
use qing\mv\ModelAndView;
/**
 * 模块
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class MainModule extends MM{
	/**
	 * @return boolean
	 */
	public function beforeModule($routeBag){
		/*@var $_USESS \qing\session\User */
		global $_USESS;
		$_USESS=$this->getUser();
		return true;
	}
	/**
	 * 消息提示
	 *
	 * @return \qing\mv\ModelAndView
	 */
	public function getMessage(array $params){
		$mv=new ModelAndView();
		$mv->type(ModelAndView::VIEW_MSG);
		$mv->vars($params);
		$mv->viewName('error/index');
		return $mv;
	}
}
?>