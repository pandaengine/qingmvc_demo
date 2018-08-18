<?php
namespace main\models;
use qing\facades\FacadeC;
exit('do not use it! only for tip! '.__FILE__);
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
	/**
	 * 获取组件 
	 * 
	 * @return \main\model\Sites 
	 */
	static public function getInstance(){
		
	}
	/**
	 * 
	 */
	static public function byId($id,$uid){
		return static::getInstance()->byId($id,$uid);
	}
	/**
	 * 
	 */
	static public function hasUrl($url){
		return static::getInstance()->hasUrl($url);
	}
	/**
	 * 
	 */
	static public function search($keyword,$limit=12){
		return static::getInstance()->search($keyword,$limit);
	}
	/**
	 * 
	 */
	static public function createAction($uid,$row){
		return static::getInstance()->createAction($uid,$row);
	}
	/**
	 * 
	 */
	static public function updateAction($uid,$id,$row){
		return static::getInstance()->updateAction($uid,$id,$row);
	}
	/**
	 *
	 */
	static public function removeAction($uid,$id){
		return static::getInstance()->removeAction($uid,$id);
	}
	/**
	 *
	 */
	static public function latest($orderby='lasttime desc',$limit=12){
		return static::getInstance()->latest($orderby,$limit);
	}
}
?>