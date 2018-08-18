<?php
namespace main\controller;
use qing\mv\MV;
use qing\mv\Ajax;
use main\models\Sites;
/**
 * 编辑网站
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Edit extends Base{
	/**
	 * 默认操作首页
	 * 
	 * @route /edit/(:num)
	 * @routeConf {"params":"id","methods":"GET"}
	 */
	public function index($id){
		$this->setTitle('编辑网站');
		$id=(int)$id;
		if($id===0){
			return MV::error('网站不存在');
		}
		$site=Sites::byId($id,$this->uid);
		if(!$site){
			return MV::error('网站不存在');
		}
		return $this->render('',['site'=>$site,'isEdit'=>true]);
	}
	/**
	 * 
	 * @route /edit/save
	 * @routeConf {"methods":"POST"}
	 */
	public function save(\main\forms\Sites $vld){
		onlyPost();
		$id=(int)$_POST['id'];
		if($id===0){
			return Ajax::error('参数错误');
		}
		//#验证数据
		if(!$vld->edit_validate($_POST)){
			//#验证错误
			return Ajax::error($vld->getError());
		}
		//数据被过滤后
		$row=$vld->edit_row();
		//创建数据
		$res=Sites::updateAction($this->uid,$id,$row);
		return Ajax::message($res);
	}
}
?>