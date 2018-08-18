<?php
namespace main\models;
use qing\facades\FacadeC;
/**
 *
 * @see \main\model\Sites
 */
class Sites extends FacadeC{
	/**
	 * 组件id 
	 * 
	 * @return string 
	 */
	static public function getName(){
		return 'M:Sites';
	}
}
?>