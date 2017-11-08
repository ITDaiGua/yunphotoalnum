function fail(img,info){
	var _fail="<div class='errorORwarn'><span class='iconfont errorORwarnImg'>"+img+"</span>"+info+"</div>";
	$('body').prepend(_fail);
	setTimeout(function(){
		$(".errorORwarn").hide().remove();
	},1500);
}

function isNotBlank(selector){
	var val=$.trim($(selector).val());
	if(val==""){
		$(selector+"Err").html("&#xe601;不能为空").css("display","inline-block");
		return false;
	}
	$(selector+"Err").html("").css("display","none");
	return true;
}

function isTrue(selector,style){
	var val=$.trim($(selector).val());
	if(val==""){
		$(selector+"Err").html("&#xe601;不能为空").css("display","inline-block");
		return false;
	}else if(!formatCk(style,val)){
		var err="格式错误";
		switch(style){
			case 'email':err="&#xe601;邮箱格式错误";break;
			case 'pw':err="&#xe601;仅支持6-18位的数字、字母、下划线";break;
			case 'uname':err="&#xe601;必须是2-8位中文或英文或数字或下划线组成";break;
		}
		$(selector+"Err").html(err).css("display","inline-block");
		return false;
	}
	$(selector+"Err").html("").css("display","none");
	return true;
}

function formatCk(style,arg){
	switch(style){
		case 'email':
			var emailFma=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			if(arg.match(emailFma)){
				return true;
			}
			return false;
		case 'pw':
			var pwLen=arg.length;
			if(pwLen<6){
				return false;
			}
			return true;
		case 'uname':
			var unameFam=/^[\u4E00-\u9FA5A-Za-z0-9_]{2,6}$/g;
			if(arg.match(unameFam)){
				return true;
			}
			return false;
	}
}

$("body").on("input propertychange",".email",function(){
	var val=$(this).val();
	val=val.replace(/[^0-9a-zA-Z\.@\_\。]/gi,"");
	val=val.replace(/\。/gi,".");
	$(this).val(val);
});

$("body").on("input propertychange",".pw",function(){
	var val=$(this).val();
	var tmpVal=val.replace(/[^0-9a-zA-Z\_]/gi,"");
	$(this).val(tmpVal);
});

$('body').on("input propertychange",".authcore",function(){
	var val=$(this).val();
	val=val.replace(/[^0-9]/g,"");
	$(this).val(val);
});

function login(){
	if($(".login").length>0){
		$(".taslctLayer").show();
		$(".login").show();
		return false;
	}
	var id="ld3"+$.now();
	var loading=$("<img src='/YunPhotoAlbum/Public/SysImg/loading3.gif' id="+id+" >").css({
		"position":"fixed",
		"z-index":"102",
		"left":"50%",
		"top":"30%",
		"margin-left":"-40px"
	});
	$("body").prepend(loading);
	$("<link>").attr({
		"rel":"stylesheet",
		"type":"text/css",
		"href":"/YunPhotoAlbum/Public/CSS/login.css"
	}).appendTo('head');
	$('body').prepend("<div class='login'></div>");
	$(".login").load("/YunPhotoAlbum/Public/TPL/login.html",function(){
		$("#"+id).remove();
		$(".taslctLayer").show();
		$(this).show();
	});
}