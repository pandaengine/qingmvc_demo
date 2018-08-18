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
