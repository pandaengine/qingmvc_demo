<?php
namespace qtests;
/**
 * 编辑测试
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class AddTest extends Base{
    /**
     * 
     */
    public function test(){
    	$url='http://qingmvc.com?rand='.time();
    	$title='qingmvc';
    	
    	//#编辑网站
    	$this->add_check(['url'=>$url,'title'=>'qingmvc','summ'=>'qingmvc'],true);
    	
    	//#url
    	$msg='url格式错误';
    	$this->add_check(['url'=>'','title'=>$title],false,'url.*不能为空');
    	$this->add_check(['url'=>'qingmvc.com','title'=>$title],false,$msg);
    	$this->add_check(['url'=>'http://qin+mvc.com','title'=>$title],false,$msg);
    	$this->add_check(['url'=>'http://qin"mvc.com','title'=>$title],false,$msg);
    	
    	//标题不能为空
    	$this->add_check(['url'=>$url,'title'=>'','summ'=>'qingmvc'],false,'标题.*不能为空');
    	//标题过长
    	$this->add_check(['url'=>$url,'title'=>'qingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvcqingmvc','summ'=>'qingmvc']
    			,false,'标题.*个字符');
    	
    	
    }
    /**
     * 验证器检测
     * 需要加载vendor/autoload.php
     * 
     * @param string $data
     * @param string $succ
     * @param string $msg 错误消息
     */
    protected function vld_check($data,$succ,$msg=''){
    	//$vld=new \main\forms\Sites();
    	//$res=$vld->validate($data);
    	//dump($res);
    }
    /**
     * 接口检测
     * 
     * @param string $data
     * @param string $succ
     * @param string $msg 错误消息
     */
    protected function add_check($data,$succ,$msg=''){
    	$this->vld_check($data,$succ,$msg);
    	//#添加网站
    	$url =qurl('add/save');
    	$res=Curl::post($url,$data);
    	//dump($res);
    	//qexport($res,__DIR__.'/~log.log');
    	if($succ){
    		$this->assertTrue($this->success($res),$this->message($res));
    	}else{
    		$this->assertTrue(!$this->success($res),$this->message($res));
    		if($msg){
    			//$this->assertContains($msg,$this->message($res));
    			$this->assertTrue(preg_match("/{$msg}/i",$this->message($res))>0);
    		}
    	}
    	$arr=(array)@json_decode($res);
    	$id =(int)@$arr['id'];
    	if($succ){
    		//删除网站
    		//dump($id);
    		$this->assertTrue($id>0);
    		//
    		$url =qurl('remove?id='.$id);
    		$res=Curl::get($url);
    		//dump($res);
    		//qexport($res,__DIR__.'/~log.log');
    		$this->assertContains('删除成功',$res);
    	}else{
    		$this->assertTrue($id==0);
    	}
    }
}
?>