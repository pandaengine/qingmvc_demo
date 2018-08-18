var QAlert={};
/**
 * 成功自动关闭时间|0为不自动关闭|false为不自动关闭
 */
QAlert.successClose=900;
/**
 * 失败自动关闭时间|0为不自动关闭|false为不自动关闭
 */
QAlert.errorClose=false;
/**
 * 当前是错误提示还是成功提示
 */
QAlert.isSuccess=true;
/**
 * 挂载消息的dom元素
 */
QAlert.domMount=null;
/**
 * 容器dom
 */
QAlert.domContainer=null;
/**
 * 容器已经注册
 */
QAlert.initedContainer=false;

/**
 * 1.消息提示
 * console.dir(arguments);
 * 
 * @param string/dom msgHtml 消息提示
 * @param string dom alert位置dom
 * @param function callback 消息窗口关闭后的回调
 */
QAlert.message=function(msgHtml,time,callback){
	//容器dom
	this.buildContainer();
	var	container=$(this.domContainer);
	//消息队列的一个选项
	var	item=document.createElement('div');
    	item.innerHTML=msgHtml;
    //追加一个选项到容器
    container.append(item.firstChild);
    var alertDom=container[0].lastChild;
    
    //自动关闭当前选项|容器不关闭
    this.autoClose(time,function(){
    	//移除dom节点
    	$(alertDom).fadeOut(400,function(){
    		$(this).remove()
    	});
    },callback);
};
/**
 * - 生成消息容器
 * - 存放消息列表框
 */
QAlert.buildContainer=function(){
	if(this.initedContainer){return;}
	this.initedContainer=true;
	//
	this.loadStyles();
	//
	var	e=document.createElement('div');
    e.id='J-alert-container';
    //
    var dom=this.domMount;
    //
    if(dom==undefined || dom==null || $(dom).length==0){
    	//dom不存在，挂载到body顶部
    	var body=$('body').get(0);
    	    body.insertBefore(e,body.firstChild);
    	//dom不存在，追加到body
    	//$('body').append(e);
    	//throw new Error(' UI 指定dom元素不存在: '+dom);
    }else{
    	//$(dom).html(e);
    	$(dom).append(e);
    }
    this.domContainer=e;
    this.bindEvent();
    return e;
};
/**
 */
QAlert.bindEvent=function(){
	$("#J-alert-container").on('click','.item .alert',function(){
		$(this).parents('.item').remove();
	});
};
/**
 */
QAlert.loadStyles=function(){
	/*
	var style=document.createElement('style');
		style.type='text/css';
		style.id="J-style-alert";
		style.innerHTML=QAlert_css;
	document.head.appendChild(style);
	*/
};
/**
 * html
 */
QAlert.getHtml=function(msg,className){
	if(className==undefined || className==null){
		className='';
	}
	var html='<div class="alert alert-dismissable '+className+' ">'+
			 '<a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>'+
			 msg+
			 '</div>';
	
	return html;
};
/**
 * 成功提示
 * alert-success
 */
QAlert.success=function(msg,time,callback){
	this.isSuccess=true;
	var html=this.getHtml(msg,'alert-info');
	this.message(html,time,callback);
};
/**
 * 错误提示
 */
QAlert.error=function(msg,time,callback){
	this.isSuccess=false;
	var html=this.getHtml(msg,'alert-danger');
	this.message(html,time,callback);
};
/**
 * 
 */
QAlert.loading=function(msg,id){
	this.isSuccess=false;
	id='J-'+id;
	var html=this.getHtml('<i class="fa fa-spinner fa-pulse" id="'+id+'"></i> '+msg,'alert-warning');
	this.message(html,undefined,false);
};
/**
 * 
 */
QAlert.loadingEnd=function(id,fadeOut){
	if(fadeOut==undefined || typeof fadeOut!="number"){
		fadeOut=0;
	}
	$('#J-alert-container #J-'+id).parents('.item').fadeOut(fadeOut,function(){
		$(this).remove()
	});
};
/**
 * 2.刷新界面
 */
QAlert.reload=function(time){
	//延迟600秒后刷新,若不想延迟 设time=0 ,ui.reload(0);
	if(time==undefined || typeof time!="number"){
		time=600;
	}
	//刷新页面	
	setTimeout(function(){
		location.reload()
	},time);
};
/**
 * 2.重定向
 */
QAlert.redirect=function(url,time){
	 alert('未定义方法QAlert.redirect');
};
/**
 * 自动关闭提示框
 * 
 * @param number/boolean time 自动关闭的时间
 * @param function callback  关闭后的回调函数
 */
QAlert.autoClose=function(time,closeFun,callback){
	if(typeof time=='undefined' || time===false || time===null){
		//#如果time没有设置则取默认值
		if(this.isSuccess){
			//成功提示|取成功提示的配置
			time=this.successClose;
		}else{
			time=this.errorClose;
		}
	}else if(typeof time!='number'){
		//#不开启自动关闭
		time=0;
	}
	if(time==0){return false;}
	//
	setTimeout(function(){
		//关闭函数|移除dom节点
	    if(typeof closeFun=='function'){
	    	closeFun();
	    }
	    //消息窗口关闭后的回调
	    if(typeof callback=='function'){
	    	callback();
	    }
	},time);
};
/**
 * 滚动到顶部
 * 
 * @returns
 */
function scrollTop(dom){
	if(dom==undefined){
		dom=$('body');
	}else{
		dom=$(dom);
	}
	if(dom){
		dom.animate({scrollTop:0}, 'slow');
	}
}
/**
 * 重定向
 * 
window.location.href='';
window.location.reload();
window.history.back();
 *
 * @param href
 */
function redirect(href){
	window.location.href=href;
}
/**
 * 
 */
function redirect_back(){
	window.history.back();
}
/**
 * 表单模块
 * 	
 * console.dir($('#form-login').serializeArray());
 * console.dir($('#form-login').serialize());
 * 
 */
/**
 * 表单工具
 */
var Form={};
/**
 * 
 */
Form.$form;
/**
 * 系列化各个表单域
 * 自动获取参数 
 */
Form.getParams=function(){
	return this.$form.serializeArray();
};
/**
 * 监听表单的提交工作
 * 
 * @param formDom 表单formDom
 * @param jump    表单成功后跳转
 */
Form.listen=function(formDom,callback){
	var self=this;
	var $form=this.$form=$(formDom);
	if($form.length==0){
		throw new Error('formDom元素不存在: '+formDom);
    }
	$form.submit(function(){
		self.submit($form,callback,undefined);
		//禁止自动提交
		return false;
	});
};
/**
 * 提交某个表单
 */
Form.ajaxForm=function(formDom,callback,params){
	self.submit(formDom,callback,params);
};
/**
 * 提交某个表单
 * console.dir(arguments);
 */
Form.submit=function(formDom,callback,params,dataType){
	if(!this.$form){
		this.$form=$(formDom);
	}
	//url/method
	var action=this.$form.attr('action');
	var method=this.$form.attr('method').toLowerCase();
	if(method!='get' && method!='post'){
		method='post';
	}
	//params
	if(params==undefined || typeof params!='object'){
		//系列化各个表单域
		params=this.getParams();
	}
	this.ajax(action,params,callback,method,dataType);
};
/**
 * post提交
 * $.post(action,params,function(data){});
 */
Form.post=function(action,params,callback,dataType){
	this.ajax(action,params,callback,'post',dataType);
};
/**
 * get提交
 * $.get(action,params,function(data){});
 */
Form.get=function(action,params,callback,dataType){
	this.ajax(action,params,callback,'get',dataType);
};
/**
 * 异步操作
 * 	
 *  xml：返回XML文档，可用JQuery处理。
	html：返回纯文本HTML信息；包含的script标签会在插入DOM时执行。
	script：返回纯文本JavaScript代码。不会自动缓存结果。除非设置了cache参数。注意在远程请求时（不在同一个域下），所有post请求都将转为get请求。
	json：返回JSON数据。
	jsonp：JSONP格式。使用SONP形式调用函数时，例如myurl?callback=?，JQuery将自动替换后一个“?”为正确的函数名，以执行回调函数。
	text：返回纯文本字符串。
 */
Form.ajax=function(action,params,callback,type,dataType){
	if(!params || params==null || params==''){
		params={};
	}
	if(!type){
		type='post';
	}
	if(!dataType){
		dataType='json';
	}
	var self=this;
	$.ajax({
		    url		:action,// 跳转到 action    
		    data	:params,
		    type	:type,
		    cache	:false,
		    dataType:dataType,
		    success :function(data){
		    	if(callback!=undefined && typeof callback=='function'){
		    		//绑定了回调，调用回调
		    		callback(data);
		    	}else{
		    		//没有绑定回调,自动提示或刷新
					//data=eval('('+data+')');
					var success=data.success;
					var message=data.message;
					if(success){
						Alert.success(message);
					}else{
						Alert.error(message);
					}
					//string
					var _redirect=$(self.dom).attr('redirect');
					//boolean
					var reload	=$(self.dom).attr('reload')=='true';
					if(_redirect>''){
						redirect(_redirect);
					}else if(reload){
						//Ng.reload();
					}
		    	}
		     },
		     error:function(xhr, textStatus, thrownError){
		    	 console.dir(xhr);
		    	 console.dir(xhr.status);
		    	 console.dir(xhr.readyState);
		    	 console.dir(textStatus);
		    	 console.dir(thrownError);
		    	 throw new Error("Ajax请求异常！"+thrownError + " | " + xhr.statusText + " | " + xhr.responseText);
		     }
	});
};

var Add={};
/**
 * 
 */
Add.listen=function(dom){
	Form.listen(dom,function(data){
		var success=data.success;
		var message=data.message;
		if(success){
			QAlert.success(message,1000,function(){
			});
		}else{
			QAlert.error(message);
		}
	});
};
/**
 * 
 */
Add.submit=function(dom){
	//console.dir($(dom));
	Form.submit(dom,function(data){
		var success=data.success;
		var message=data.message;
		if(success){
			QAlert.success(message,undefined,function(){
				QAlert.reload(0);
			});
		}else{
			QAlert.error(message);
		}
	});
};
/**
 * https://fuati.com
 */
Add.start=function(){
	//剔除http://前缀
	$('#J-add input[name="url"]').change(function(){
		var val=$(this).val();
		//匹配
		var pattern=new RegExp('^https?\:\/\/','i');
		var matches=val.match(pattern);
		if(matches!==null){
			//剔除
			val=val.replace(new RegExp('^https?\:\/\/','i'),'');
			//定位is_https
			$(this).val(val);
			var https='0';
			if(matches[0]=='https://'){
				https='1';
			}
			$('#J-add select[name="https"]').val(https);
		}
	});
};
//Add.start();
