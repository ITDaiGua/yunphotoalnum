$(document).ready(function(){
	var canGetAc=true;
	$('body').on("click",".getAuthcore",function(){
		var email=$.trim($(".email").val());
		if(!canGetAc||!formatCk('email',email)){
			return false;
		}
		canGetAc=false;
		var timeLen=120;
		var _this=$(".getAuthcore");
		var timer=setInterval(function(){
			if(timeLen==0){
				_this.text("重新获取");
				clearInterval(timer);
				canGetAc=true;
			}else{
				_this.text(timeLen+"s后重新获取");
			}
			timeLen--;
		},1000);
		var sendMailURL="/YunPhotoAlbum/User/sendMail/t/"+$.now();
		$.post(sendMailURL,{"mailAddr":email},function(data){
			if(data.info=="error"){
				fail("&#xe691;","发生错误");
				canGetAc=true;
				clearInterval(timer);
				_this.text("重新获取");
			}
		}).fail(function(){
			fail("&#xe691;","发生错误");
			canGetAc=true;
			clearInterval(timer);
			_this.text("重新获取");
		});
	})
});