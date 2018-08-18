<?php
namespace qtests;
use PHPUnit\Framework\TestCase as UnitTestCase;
/**
 * phpunit单元测试，基类
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Base extends UnitTestCase{
	/**
	 *
	 */
	protected function setUp(){
		parent::setUp();
	}
	/**
 	 * 
	 */
    protected function tearDown(){
        parent::tearDown();
    }
	/**
	 * @see Countable::count()
	 */
	public function count(){
		return parent::count();
	}
	/**
	 * 访问私有成员
	 *
	 * @param object $obj
	 * @param string $prop
	 * @return mixed
	 */
	protected function privateProperty($obj,$prop){
		$refProperty=new \ReflectionProperty($obj,$prop);
		//设置方法是否可以访问，例如通过设置可以访问能够执行私有方法和保护方法
		$refProperty->setAccessible(true);
		return $refProperty->getValue($obj);
	}
	/**
	 * 访问私有成员
	 *
	 * @param object $obj
	 * @param string $method
	 * @param array $args
	 * @return mixed
	 */
	protected function privateMethod($obj,$method,array $args=[]){
		$refMethod=new \ReflectionMethod($obj,$method);
		//设置方法是否可以访问，例如通过设置可以访问能够执行私有方法和保护方法
		$refMethod->setAccessible(true);
		return $refMethod->invokeArgs($obj,$args);
	}
	/**
	 * @param string $text
	 */
	protected function success($text){
		$arr=json_decode($text,true);
		if(is_array($arr) && $arr['success']){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * @param string $text
	 */
	protected function error($text){
		return !$this->success($text);
	}
	/**
	 * @param string $text
	 */
	protected function message($text,$conv=false){
		$arr=(array)json_decode($text,true);
		return $arr['message'];
		//return mb_convert_encoding($arr['message'],'GB2312','UTF-8');
	}
	/**
	 * @param string $text
	 */
	protected function assertSuccess($text){
		$arr=(array)json_decode($text,true);
		$this->assertTrue($arr['success']>0,$arr['message']);
	}
}
?>