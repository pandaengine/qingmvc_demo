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
