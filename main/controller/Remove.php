<?php
namespace main\controller;
use main\models\Sites;
use qing\mv\MV;
/**
 * 删除记录
 *
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Remove extends Base{
	/**
	 * 默认操作首页
	 */
	public function index($id){
		$id=(int)$id;
		if($id===0){
			return MV::error('网站不存在');
		}
		$res=Sites::removeAction($this->uid,$id);
		$url=U('index');
		if($res){
			return MV::success('删除成功',[MV::redirect=>$url,MV::autojump=>true]);
		}else{
			return MV::error('删除失败',[MV::redirect=>$url]);
		}
	}
}
?>