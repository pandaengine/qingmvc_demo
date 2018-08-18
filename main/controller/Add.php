<?php
namespace main\controller;
use qing\mv\Ajax;
use main\models\Sites;
/**
 * 添加网站
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Add extends Base{
	/**
	 * 默认操作首页
	 * 
	 * @route /add
	 */
	public function index(){
		$this->setTitle('添加网站');
		return $this->render('',['site'=>[],'isEdit'=>false]);
	}
	/**
	 * 
	 * @route /add/save
	 * @routeConf {"methods":"POST"}
	 */
	public function save(\main\forms\Sites $vld){
		onlyPost();
		//#验证数据
		if(!$vld->validate($_POST)){
			//#验证错误
			return Ajax::error($vld->getError());
		}
		//数据被过滤后
		$row=$vld->getRow();
		//域名是否已存在
		if(Sites::hasUrl($row['url'])){
			return Ajax::error('域名已经存在');
		}
		//创建数据
		$id=Sites::createAction($this->uid,$row);
		if($id!==false){
			return Ajax::success('',['id'=>$id]);
		}else{
			return Ajax::error(Sites::getError());
		}
	}
}
?>