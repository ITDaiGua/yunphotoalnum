$(document).ready(function(){
	$(".fgtPwMenu li").on('click',function(event){
		$(".choseOnOpt").removeClass('choseOnOpt');
		$(this).addClass("choseOnOpt");
		var id=this.id;
		switch(id){
			case 'byMail':
				$("#fgtForm1").show();
				$("#fgtForm2").hide();
				break;
			case 'byQuestion':
				$("#fgtForm1").hide();
				$("#fgtForm2").show();
				break;
		}
	});
	var cmfPwIsTrue1=true;
	var cmfPwIsTrue2=true;
	$("#newPw,#newPw2,#cmfNewPw,#cmfNewPw2").on("blur",function(){
		var id="#"+this.id;
		var arg=$.trim($(this).val());
		if(isTrue(id,"pw")){
			switch(id){
				case '#cmfNewPw':
					var valTmp=$.trim($("#newPw").val());
					if(valTmp!=arg){
						$("#cmfNewPwErr").html("&#xe601必须与上一个密码相同").css("display","inline-block");
						cmfPwIsTrue1=false;
						return false;
					}
					cmfPwIsTrue1=true;
					break;
				case "#cmfNewPw2":
					var valTmp2=$.trim($("#newPw2").val());
					if(valTmp2!=arg){
						$("#cmfNewPw2Err").html("&#xe601必须与上一个密码相同").css("display","inline-block");
						cmfPwIsTrue2=false;
						return false;
					}
					cmfPwIsTrue2=true;
					break;
			}
			return true;
		}
		return false;
	});

	$("#umail2,#umail").on("blur",function(){
		var id="#"+this.id;
		var arg=$.trim($(this).val());
		if(isTrue(id,"email")){
			return true;
		}
		return false;
	});

	$("#authcore").on("blur",function(){
		return isNotBlank("#authcore");
	});

	var canCgePw1=true;		//防止重复提交
	$("#fgtForm1").on("submit",function(event){
		event.preventDefault();
		var isTrueTmp=true;
		$("#fgtForm1 input").each(function(){
			var id="#"+this.id;
			switch(id){
				case '#newPw':isTrueTmp=isTrueTmp&isTrue(id,"pw");break;
				case '#cmfNewPw':$(id).trigger('blur');isTrueTmp=isTrueTmp&cmfPwIsTrue1;break;
				case '#umail':isTrueTmp=isTrueTmp&isTrue(id,"email");break;
				case '#authcore':isTrueTmp=isTrueTmp&isNotBlank(id);break;
			}
		});
		if(!isTrueTmp||!canCgePw1){
			return false;
		}
		canCgePw1=false;
		var cgePw1URL="/YunPhotoAlbum/User/forgetPW1/t/"+$.now();
		$.post(cgePw1URL,$(this).serialize(),function(data){
			$.each(data,function(k,v){
				var errObj="";
				switch(k){
					case "upw":errObj=$("#newPwErr");break;
					case "cmfNewPw":errObj=$("#cmfNewPwErr");break;
					case "umail":errObj=$("#umailErr");break;
					case "authcore":errObj=$("#authcoreErr");break;
					case "info":
						switch(v){
							case 'success':$("#fgtForm1").get(0).reset();fail("&#xe687;","更改成功");break;
							case 'error':errObj=$("#newPwAllErr");break;
						}
						break;
				}
				if(errObj!=""){
					errObj.html("&#xe601;"+v).css("display","inline-block");
					canCgePw1=true;
				}
			}).fail(function(){
				$("#newPwAllErr").html("&#xe601;发生错误").css("display","inline-block");
				canCgePw1=true;
			});
		});
	});

	$("#answer").on("blur",function(){
		return isNotBlank("#answer");
	});

	var canCgePw2=true;		//防止重复提交
	$("#fgtForm2").on("submit",function(event){
		event.preventDefault();
		var isTrueTmp2=true;
		$("#fgtForm2 input:not('#umail2')").each(function(){
			var id="#"+this.id;
			switch(id){
				case '#newPw2':isTrueTmp2=isTrueTmp2&isTrue(id,"pw");break;
				case '#cmfNewPw2':$(id).trigger("blur");isTrueTmp2=isTrueTmp2&cmfPwIsTrue2;break;
			}
		});
		isTrueTmp2=isTrueTmp2&isNotBlank("#answer");
		if(!isTrueTmp2||!canCgePw2){
			return false;
		}
		 canCgePw2=false;
		 var cgePw2URL="/YunPhotoAlbum/User/forgetPW2/t/"+$.now();
		 $.post(cgePw2URL,$("#fgtForm2").serialize(),function(data){
		 		$.each(data,function(k,v){
		 			var errObj="";
		 			switch(k){
		 				case 'securityAsw':errObj=$("#answerErr");break;
		 				case 'upw':errObj=$("#newPw2");break;
		 				case 'cmfNewPw2':errObj=$("#cmfNewPw2Err");break;
		 				case 'info':
		 					switch(v){
		 						case "success":$("#fgtForm2").get(0).reset();fail("&#xe687;","更改成功");break;
		 						case "err1":$("#answerErr").html("&#xe601;密保错误").css("display","inline-block");break;
		 						case 'err2':$("#newPw2AllErr").html("&#xe601;发生错误").css("display","inline-block");break;
		 					}
		 			}
		 			if(errObj!=""){
		 				errObj.html("&#xe601;"+v).css("display","inline-block");
		 				canCgePw2=true;
		 			}
		 		});
		 });
	});

	var canGetQst=true;	//防止重复提交
	var getQuestionURL="/YunPhotoAlbum/User/getQuestion/t/"+$.now();
	$("#nextStep").click(function(event){
		event.preventDefault();
		if(isTrue("#umail2","email")&&canGetQst){
			canGetQst=false;
			var umail2=$("#umail2");
			umail2.prop("readonly",true);
			$.post(getQuestionURL,umail2.serialize(),function(data){
				$.each(data,function(k,v){
					var errObj="";
					switch(k){
						case 'umail':
						case 'info':errObj=$("#umail2Err");break;
						case 'securityQst':
							if($.trim(v)){
								$("#quest").text(v);
							}else{
								$("#quest").text("未设置密保");
								$("#fgtForm2").find(":not('#quest')").hide();
							}
							$("#uamil2Div").hide();
							$("#answerDiv").show();
							break;
					}
					if(errObj){
						errObj.html("&#xe601;"+v).css("display","inline-block");
						umail2.prop("readonly",false);
						canGetQst=true;
					}
				});
			}).fail(function(){
				$("#umail2Err").html("&#xe601;发生错误").css("display","inline-block");
				umail2.prop("readonly",false);
				canGetQst=true;
			});
		}
	});

});