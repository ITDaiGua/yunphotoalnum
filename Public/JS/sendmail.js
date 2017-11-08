$(document).ready(function(){
	var canGetAc=true;
	$('body').on("click",".getAuthcore",function(){
		var email=$.trim($(".email").val());
		if(!canGetAc){
			return false;
		}
		if(!formatCk('email',email)){
			$("#umailErr").html("&#xe601;邮箱格式不合法").css({"display":"inline-block"});
			return false;
		}
		$("#umailErr").html("").hide();
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
		$.post(sendMailURL,{"umail":email},function(data){
			if(data.umail){
				$("#umailErr").html("&#xe601;"+data.umail).css({"display":"inline-block"});
				canGetAc=true;
				clearInterval(timer);
				_this.text("重新获取");
				return false;
			}
			if(data.info=="success"){
				$("#umailErr").html("").hide();
				return true;
			}else{
				fail("&#xe691;","发生错误");
				canGetAc=true;
				clearInterval(timer);
				_this.text("重新获取");
				return false;
			}
		}).fail(function(){
			fail("&#xe691;","发生错误");
			canGetAc=true;
			clearInterval(timer);
			_this.text("重新获取");
		});
	})
});