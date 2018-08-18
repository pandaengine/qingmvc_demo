<?php
namespace main\widget;
use qing\widget\Widget;
/**
 * 口号
 *
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Slogan extends Widget{
	/**
	 * @see \qing\widget\Widget::run()
	 */
	public function run($data){
		return $this->render();
	}
}
?>