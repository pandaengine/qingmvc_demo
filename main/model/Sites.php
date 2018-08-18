<?php
namespace main\model;
use qing\db\Db;
use qing\db\Model;
/**
 * 网站表
 * R:读取
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Sites extends Model{
  	public $tableName=T::sites;
  	/**
  	 * 约束只能访问自己的数据
  	 * 
  	 * @param number $id
  	 * @param number $uid
  	 */
  	public function byId($id,$uid){
  		return $this->where(['id'=>$id,'uid'=>$uid])->find();
  	}
  	/**
  	 * 检查url的唯一性
  	 * 不限制uid
  	 * 
  	 * @param string $url
  	 * @return boolean
  	 */
  	public function hasUrl($url){
  		return $this->where(['url'=>$url])->exists();
  	}
  	/**
  	 * 创建记录
  	 *
  	 * @param number $uid
  	 * @param array  $row
  	 */
  	public function createAction($uid,array $row){
  		$row['uid']     =$uid;
  		$row['addtime'] =time();
  		$row['lasttime']=$row['addtime'];
  		return $this->insert($row);
  	}
  	/**
  	 * 更新操作
  	 *
  	 * @param number $uid
  	 * @param number $id
  	 * @param array $row
  	 * @return boolean
  	 */
  	public function updateAction($uid,$id,array $row){
  		$row['lasttime']=time();
  		return $this->where(['id'=>$id,'uid'=>$uid])->update($row);
  	}
  	/**
  	 * 删除操作
  	 *
  	 * @param number $uid
  	 * @param number $id
  	 * @return boolean
  	 */
  	public function removeAction($uid,$id){
  		return $this->where(['id'=>$id,'uid'=>$uid])->delete();
  	}
  	/**
  	 * 搜索
  	 * 
  	 * @param string $keyword 不能包含_%引号等
  	 * @param number $limit
  	 * @return array
  	 */
  	public function search($keyword,$limit=12){
  		//模糊查找
  		$where=Db::where();
  		$where->like('title','%'.$keyword.'%');
  		return $this->fields('*')->where($where)->limit('0,'.$limit)->select();
  	}
  	/**
  	 * 最新列表
  	 * 
  	 * @param string $orderby
  	 * @param number $limit
  	 * @return array
  	 */
  	public function latest($orderby='lasttime desc',$limit=12){
  		return $this->fields('*')->orderby($orderby)->limit('0,'.$limit)->select();
  	}
}
?>