
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
