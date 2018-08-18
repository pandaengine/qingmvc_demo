<?php
namespace qtests;
/**
 * 编辑测试
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class EditTest extends Base{
	/**
	 *
	 */
	public static function data_add(){
		return 
		[
			'url'=>'http://qingmvc.com?rand='.time(),
			'title'=>'qingmvc',
			'summ'=>'qingmvc'
		];
	}
    /**
     * 
     */
    public function test(){
    	//#添加网站
    	$url =qurl('add/save');
    	$data=self::data_add();
    	 
    	$res=Curl::post($url,$data);
    	//dump($res);
    	//qexport($res,__DIR__.'/~log.log');
    	$this->assertTrue($this->success($res));
    	$arr=(array)json_decode($res);
    	$id =(int)$arr['id'];
    	//dump($id);
    	$this->assertTrue($id>0);
    	
    	//#编辑网站
    	$this->edit($id,['title'=>'qingmvc','summ'=>'qingmvc'],true);
    	//标题不能为空
    	$this->edit($id,['title'=>'','summ'=>'qingmvc'],false);
    	//标题过长
    	$this->edit($id,['title'=>'qingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvc','summ'=>'qingmvc'],false);
    	
    	//删除网站
    	$url =qurl('remove?id='.$id);
    	$res=Curl::get($url);
    	//dump($res);
    	//qexport($res,__DIR__.'/~log.log');
    	$this->assertContains('删除成功',$res);
    }
    /**
     * @param number $id
     * @param string $data
     * @param string $succ
     */
    protected function edit($id,$data,$succ){
    	$url =qurl('edit/save');
    	$data=(array)$data;
    	$data['id']=$id;
    	$res=Curl::post($url,$data);
    	//dump($res);
    	//qexport($res,__DIR__.'/~log.log');
    	if($succ){
    		$this->assertTrue($this->success($res),$this->message($res));
    	}else{
    		$this->assertTrue(!$this->success($res),$this->message($res));
    	}
    }
}
?>