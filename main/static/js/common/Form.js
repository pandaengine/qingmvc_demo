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
