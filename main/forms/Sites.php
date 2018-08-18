<?php
namespace main\forms;
use qing\forms\Form;
use qing\validator\filter\Url;
use qing\validator\Chars;
use qing\validator\filter\SafeText;
/**
 * 表单验证
 * 
 * @author xiaowang <736523132@qq.com>
 * @copyright Copyright (c) 2013 http://qingmvc.com
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
class Sites extends Form{
	/**
	 * 链接地址
	 *
	 * @var string
	 */
	public $url='';
	/**
	 * 链接标题
	 *
	 * @var string
	 */
	public $title='';
	/**
	 * 链接描述
	 *
	 * @var string
	 */
	public $summ='';
	/**
	 * validate/setField/getRow完成数据验证过滤和获取的一条龙服务 
	 * 
	 * @param array $row 
	 */
	public function validate(array $row){
		$res=$this->setUrl(@$row['url'])
		 && $this->setTitle(@$row['title'])
		 && $this->setSumm(@$row['summ']);
		return $res;
	}
	/**
	 * @return array
	 */
	public function getRow(){
		$row=[];
		$row['url']		=$this->url;
		$row['title']	=$this->title;
		$row['summ']	=$this->summ;
		//更多数据解析
		//获取host
		$parts=(array)parse_url($row['url']);
		$row['host']=(string)$parts['host'];
		if('https'==strtolower($parts['scheme'])){
			$row['is_https']=1;
		}else{
			$row['is_https']=0;
		}
		return $row;
	}
	/**
	 * @param array $row
	 */
	public function edit_validate(array $row){
		$res=$this->setTitle(@$row['title'])
		  && $this->setSumm(@$row['summ']);
		return $res;
	}
	/**
	 * @return array
	 */
	public function edit_row(){
		$row=[];
		$row['title']	=$this->title;
		$row['summ']	=$this->summ;
		return $row;
	}
	/**
	 * @param string $url
	 */
	public function setUrl($url){
		//#必需
		if(!$url){
			$this->error_required('Url');
			return false;
		}
		//#格式错误,url安全过滤
		$url=Url::filter($url);
		if(!$url){
			$this->setError('url格式错误');
			return false;
		}
		//#长度
		if(!Chars::validate($url,1,200)){
			$this->setError('Url: 1~200个字符');
			return false;
		}
		//#过滤？
		$this->url=$url;
		return true;
	}
	/**
	 * @param string $title
	 */
	public function setTitle($title){
		//#必需
		if(!$title){
			$this->error_required('标题');
			return false;
		}
		//#长度
		if(!Chars::validate($title,2,50)){
			$this->setError('标题: 2~50个字符');
			return false;
		}
		//#必须过滤数据
		$this->title=(string)SafeText::filter($title);
		return true;
	}
	/**
	 * @param string $summ
	 */
	public function setSumm($summ){
		//#可以为空
		if(!$summ){
			return true;
		}
		//#长度
		if(!Chars::validate($summ,2,140)){
			$this->setError('简介: 2~140个字符');
			return false;
		}
		//#必须过滤数据
		$this->summ=(string)SafeText::filter($summ);
		return true;
	}
}
?>