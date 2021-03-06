<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">    
		<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">    
		<meta HTTP-EQUIV="Expires" CONTENT="0"> 
		<title><?php echo ($init["title"]); ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/YunPhotoAlbum/Public/SysImg/cloud.ico">
		<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/commonCss.css">
		<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/userCenter.css">
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
		<!--[if lte IE 8]>
			<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<!--[if lte IE 9]>
			<div style="position:fixed;z-index:9999;width:100%;height=40px;background-color:#FFC125;letter-spacing:10px;text-align:center;color:#ff0000;font-size:18px;line-height:40px;left:0;top:0;">
			您的浏览器版本过低，不能正常使用该系统
			</div>
		<![endif]-->
		<div class="taslctLayer"></div>
<div id="headMenu">
	<a href="/YunPhotoAlbum/" style="float:left;margin-left:200px;">首页</a>
	<?php if($isLogin === 'isLogin'): ?><a href="/YunPhotoAlbum/UserCenter/getInfo" title="查看消息" id="info">
			<img src="/YunPhotoAlbum/Public/SysImg/infowarn.png" id="infowarn">
		</a>
		<a href="/YunPhotoAlbum/User/logout">退出</a>
		<span style="vertical-align:middle;">|</span>
		<span style="color:#ff0000;vertical-align:middle;">欢迎:</span>
		<a href="/YunPhotoAlbum/UserCenter/index" target="_blank" class="PsnlCtr" title="个人中心">
			<span style="vertical-align:middle;"><?php echo ($userName); ?></span>
			<img src="<?php echo ($uImg); ?>" class="uImg">
		</a>
		<script type="text/javascript">
			var infowarn=document.getElementById("infowarn");
			getInfo(infowarn);
			function getInfo(infowarn){
				var isExistsInfoURL="/YunPhotoAlbum/Info/index/t/"+$.now();
				$.get(isExistsInfoURL,function(data){
					switch(data.info){
						case 'exists':infowarn.src="/YunPhotoAlbum/Public/SysImg/infowarn.gif";break;
						case 'notexists':
						case 'noLogin':infowarn.src="/YunPhotoAlbum/Public/SysImg/infowarn.png";break;
						case 'error':
						default:fail("&#xe691;","发生错误");
					}
				});
			}
		</script>
	<?php else: ?>
		<span style="color:#ff0000;vertical-align:middle;">您还没有登陆！</span>
		<a href="javascript:void(0);" id="wannaLg">登陆</a>
		<span style="vertical-align:middle;">|</span>
		<a href="/YunPhotoAlbum/User/rgtHtml">注册</a>
		<img src="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg" class="uImg">
		<script type="text/javascript">
			$("#wannaLg").click(function(){
				login();
			});
		</script>
		<?php if($init['triggerLogin'] == 'triggerLogin'): ?><script type="text/javascript">
				$(document).ready(function(){
					$("#wannaLg").trigger("click");
				});
			</script><?php endif; endif; ?>
</div>
<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/commonJs.js"></script>

		<div class="allContent" id="<?php echo ($init['uid']); ?>">
			<ul id="menuUl">
				<a href="/YunPhotoAlbum/UserCenter/index">
					<li class="menuLi" onselectstart="return false;" <?php echo ($init["style1"]); ?>>我的信息</li>
				</a>
				<a href="/YunPhotoAlbum/UserCenter/getInfo">
					<li class="menuLi" onselectstart="return false;" <?php echo ($init["style2"]); ?>>消息查看</li>
				</a>
				<a href="/YunPhotoAlbum/UserCenter/cgeMyPw">
					<li class="menuLi" onselectstart="return false;" <?php echo ($init["style3"]); ?>>密码更改</li>
				</a>
			</ul>
			<div class="content">
				<?php switch($init["viewType"]): case "myInfo": ?><link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/myInfo.css">
<div class="taslctLayer2"></div>
<div id="changeImgWarn">
	<div id="changeImgWarn-hd">
		<span style="font:20px iconfont;color:#fbfe06;margin-right:5px">&#xe691;</span>提示
		<span id="changeImgWarn-close" onselectstart="return false;">&#xe601;</span>
	</div>
	<div id="changeImgWarn-cnt">
		仅支持jpg、png格式的图片，且大小小于2M之间
	</div>
	<button id="changeImgWarn-btt">我知道了！</button>
</div>
<div id="contentHead">
	<div id="userImgOptDiv">
		<img src="<?php echo ($userInfo["userImg"]); ?>" id="userBigImg">
		<button id="changeImg">更改头像</button>
		<input type="file" id="changeImgInput" accept="image/png,image/jpeg,image/jpg">
	</div>
	<ul id="uname_rgtTime">
		<li><?php echo ($userInfo["uname"]); ?></li>
		<li style="width:100px;text-align:right;">注册时间：</li>
		<li><?php echo ($userInfo["rgstTime"]); ?></li>
		<li id="changeInfo" onselectstart="return false;" style="width:50px;">修改</li>
		<li id="saveChange" onselectstart="return false;" style="width:90px;display:none;">保存修改</li>
		<li id="dontSaveChange" onselectstart="return false;" style="width:90px;display:none;">不保存</li>
	</ul>
</div>
<dl id="myInfoDL">
	<dd>
		<span class="myInfoTitle">我的简介：</span>
		<span class="myInfoCont" id="myProfile"><?php echo ($userInfo["profile"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">注册邮箱：</span>
		<span class="myInfoCont" id="myMail"><?php echo ($userInfo["umail"]); ?><span id='cgeMail' onselectstart='return false;'>修改</span></span>
	</dd>
	<dd>
		<span class="myInfoTitle">姓名：</span>
		<span class="myInfoCont" id="myName"><?php echo ($userInfo["autonym"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">性别：</span>
		<span class="myInfoCont" id="mySex"><?php echo ($userInfo["usex"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">生日：</span>
		<span class="myInfoCont" id="myBirthday"><?php echo ($userInfo["birthday"]); ?></span>
	</dd>
</dl>
<div id="setQstDiv">
	<input type="password" id="passWord" class="pw" placeholder="输入原密码" maxlength="16">
	<span class="qstErr" id="passWordErr"></span><br/>
	<textarea id="setQst" maxlength="30" placeholder="设置密保"></textarea>
	<span class="qstErr" id="setQstErr"></span><br/>
	<textarea id="setAnswer" maxlength="30" placeholder="密保答案"></textarea>
	<span class="qstErr" id="setAnswerErr"></span><br/>
	<button id="setQstBtt">设置密保</button><br/>
	<span class="qstErr" id="setQstAllErr"></span><br/>
</div>
<textarea id="cgeMailHideHtml" style="display:none;">
		<div id="cgeMailDiv">
			<div id="cgeMailDiv-hd">更改注册邮箱
				<span id="cgeMailDiv-close" onselectstart="return false;">&#xe601;</span>
			</div>
			<span class='inputSpan'>
				<span class="inputImg">&#xe6cb;</span>
				<input type="password" maxlength="16" placeholder="请输入登陆密码" id="inputpw" class="inputCss pw">
			</span>
			<span class="cgeMailErr" id="inputpwErr"></span>
			<span class='inputSpan'>
				<span class="inputImg">&#xe6e6;</span>
				<input type="text" class="email inputCss" id="umail" maxlength="40" placeholder="新邮件地址">
			</span>
			<span class="cgeMailErr" id="umailErr"></span>
			<span class="inputSpan">
				<input type="text" id="authcoreValue" class="authcore" maxlength="8" placeholder="验证码">
				<div class="getAuthcore" onselectstart="return false;">点击获取验证码</div>
			</span>
			<span class="cgeMailErr" id="authcoreValueErr"></span><br/>
			<button id="cgeMailBtt">立即修改</button><br/>
			<span class="cgeMailErr" id="cgeMailAllErr" style="margin-bottom:10px;"></span>
		</div>
		<script type="text/javascript">
			$(".allContent").on("click","#cgeMailDiv-close",function(){
				$("#cgeMailDiv").hide();
				$(".taslctLayer2").hide();
			});
			var canCge=true;
			$(".allContent").on("click","#cgeMailBtt",function(){
				if(!canCge){return false;}
				var isRight=true;
				if(isTrue("#inputpw","pw")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(isTrue("#umail","email")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(isNotBlank("#authcoreValue")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(!isRight){
					return false;
				}
				canCge=false;
				var cgeMailData={
					"upw":$.trim($("#inputpw").val()),
					"umail":$.trim($("#umail").val()),
					"newMailAuthcore":$.trim($("#authcoreValue").val())
				}
				var cgeMailURL="/YunPhotoAlbum/User/cgeMail/t/"+$.now();
				$.post(cgeMailURL,cgeMailData,function(data){
					if(data.info){
						switch(data.info){
							case 'success':fail("&#xe687;","修改成功");setTimeReload();break;
							case 'authcoreErr':$("#authcoreValueErr").css("display","inline-block").html("&#xe601;验证码错误");break;
							case 'noLogin':fail("&#xe691;","请先登陆");setTimeReload();break;
							case 'error2':$("#inputpwErr").css("display","inline-block").html("&#xe601;密码错误");break;
							case 'error1':
							default:$("#cgeMailAllErr").css("display","inline-block").html("&#xe601;发生错误");
						}
					}else{
						if(data.upw){
							$("#inputpwErr").css("display","inline-block").html("&#xe601;"+data.upw);
						}
						if(data.umail){
							$("#umail").css("display","inline-block").html("&#xe601;"+data.umail);
						}
					}
					canCge=true;
				}).fail(function(){
					canCge=true;
					fail("&#xe691;","发生错误");
				});
			});
		</script>
</textarea>
<textarea id="changeImgScript" style="display:none;">
	<script type="text/javascript">
		var allowType=["image/png","image/jpeg","image/jpg"];
		$("#changeImgInput").change(function(){
			var val=$.trim(this.value);
			if(!val){return false;}
			var file=this.files[0];
			var imgSize=file.size;
			if(imgSize>2097152){
				$("#changeImgWarn-close").trigger("click");
				fail("&#xe691;","图片不能大于2M");
				return false;
			}
			if($.inArray(file.type,allowType)<0){
				$("#changeImgWarn-close").trigger("click");
				fail("&#xe691;","图片格式不合法");
				return false;
			}
			var imgURL=window.URL.createObjectURL(file);
			document.getElementById("userBigImg").src=imgURL;
			document.getElementsByClassName("uImg")[0].src=imgURL;
			uploadUserImg(file);
		});

		function uploadUserImg(fileObj){
			var changeImgURL="/YunPhotoAlbum/UserCenter/uploadUserImg/t/"+$.now();
			var formdata=new FormData();
			formdata.append("userImg",fileObj);
			var xmlHttp=new XMLHttpRequest;
			xmlHttp.open("POST",changeImgURL,true);
			xmlHttp.setRequestHeader("X-Requested-With","XMLHttpRequest");
			xmlHttp.onerror=function(){
				xmlHttp.abort();
				fail("&#xe691;","上传失败");
			};
			var uploadedper="";
			xmlHttp.onloadstart=function(){
				$("#userImgOptDiv").prepend("<span id='uploadedper'>0%</span>");
				uploadedper=$("#uploadedper");
			}
			xmlHttp.onprogress=function(event){ 
				if(event.lengthComputable){
					var uploaded=event.loaded;
					var total=event.total;
					var percent=Math.floor(uploaded/total)*100;
					uploadedper.text(percent+"%");
				}
			};
			xmlHttp.onreadystatechange = function() {
	        if (xmlHttp.readyState === 4) {
	            if (xmlHttp.status === 200) {
	              var responseText=xmlHttp.responseText;
	             	responseText=$.parseJSON(responseText);
	              switch(responseText.info){
	             	  case "success":fail("&#xe687;","上传成功");break;
	             	  case "noLogin":login();break;
	             	  case "error":
	             	  default:fail("&#xe691;","上传失败");
	              }
	              var timer=setTimeout(function(){
	              	uploadedper.remove();
	              	clearTimeout(timer);
	              },1000);
	            }else {
	            	uploadedper.remove();
	              fail("&#xe691;","上传失败");
	            }
	        }
	    }
	    xmlHttp.send(formdata);
		}
	</script>
</textarea>
<script type="text/javascript">
	$("#changeImg").click(function(){
		$(".taslctLayer2").show();
		$("#changeImgWarn").show();
	});
	$("#changeImgWarn-close").click(function(){
		$("#changeImgWarn").hide();
		$(".taslctLayer2").hide();
	});
	$("#changeImgWarn-btt").click(function(){
		$("#changeImgWarn-close").trigger("click");
		var changeImgScript=$("#changeImgScript").val();
		$("body").append(changeImgScript);
		$("#changeImgInput").trigger("click");
	});
	
	$("#changeInfo").click(function(){
		$(this).hide();
		$("#saveChange").show();
		$("#dontSaveChange").show();
		var myProfile=$("#myProfile");
		var profile=myProfile.text();
		if(profile=="您还没有填写简介！"){
			profile="";
		}
		myProfile.html("<textarea maxlength='250' id='cge-myProfile'>"+profile+"</textarea><span class='err' id='cge-myProfileErr'></span>");
		var myName=$("#myName");
		var name=myName.text();
		if(name=="-"){
			name="";
		}
		myName.html("<input maxlength='8' id='cge-myName' value='"+name+"'><span class='err' id='cge-myNameErr'></span>");
		var mySex=$("#mySex");
		var sex=mySex.text();
		var sexHtml="<input type='radio' name='sex'";
		if(sex=="男"){
			sexHtml+=" checked value='男' id='man'><label class='sexLabel' for='man'>男</label>";
			sexHtml+="<input type='radio' name='sex' value='女' id='woman'><label class='sexLabel' for='woman'>女</label>"
		}else{
			sexHtml+=" checked value='女' id='woman'><label class='sexLabel' for='woman'>女</label>";
			sexHtml+="<input type='radio' name='sex' value='男' id='man'><label class='sexLabel' for='man'>男</label>";
		}
		mySex.html(sexHtml);
		var myBirthday=$("#myBirthday");
		var birthday=myBirthday.text();
		var dateObj=new Date;
		var nowYear=dateObj.getFullYear();
		var nowMonth=dateObj.getMonth()+1;
		if(nowMonth<10){
			nowMonth="0"+nowMonth;
		}
		var nowDay=dateObj.getDate();
		if(nowDay<10){
			nowDay="0"+nowDay;
		}
		var nowDate=nowYear+"-"+nowMonth+"-"+nowDay;
		if(birthday=="-"){
			birthday=nowDate;
		}
		myBirthday.html("<input type='date' id='cge-myBirthday' value='"+birthday+"'   min='1900-01-01' max='"+nowDate+"'>");
	});
	var canSave=true;
	$("#saveChange").click(function(){
		if(!canSave){return false;}
		canSave=false;
		var infoChangeUrl="/YunPhotoAlbum/UserCenter/infoChange/t/"+$.now();
		var myProfile=$.trim(document.getElementById("cge-myProfile").value);
		var myName=$.trim(document.getElementById("cge-myName").value);
		var RegExpStr=/^[\u4E00-\u9FA5]{2,8}$/g;
		if(myName){
			if(!myName.match(RegExpStr)){
				$("#cge-myNameErr").html("&#xe601;仅支持2-8位的中文姓名");
				canSave=true;
				return false;
			}else{
				$("#cge-myNameErr").empty();
			}
		}
		var mySex=$("input[name='sex']:checked").val();
		var myBirthday=$.trim(document.getElementById("cge-myBirthday").value);
		var cgeData={
			"profile":myProfile,
			"autonym":myName,
			"usex":mySex,
			"birthday":myBirthday
		};
		$.get(infoChangeUrl,cgeData,function(data){
			switch(data.info){
				case 'noLogin':location.reload();break;
				case 'success':
					fail("&#xe687;","修改成功");
					setTimeReload();
					break;
				case 'error':
				default:
					fail("&#xe691;","修改失败");
					setTimeReload();
			}
		}).fail(function(){
			fail("&#xe691;","修改失败");
			setTimeReload();
		});
	});
	$("#myProfile").on("input propertychange","#cge-myProfile",function(){
		var val=this.value;
		val=val.replace(/\s/g," ");
		this.value=val;
	});
	$("#myName").on("input propertychange","#cge-myName",function(){
		var val=this.value;
		if(val.match(/[^\u4E00-\u9FA5]/g)){
			$("#cge-myNameErr").html("&#xe601;仅支持2-8位的中文姓名");
		}else{
			$("#cge-myNameErr").empty();
		}
	});
	$("#dontSaveChange").click(function(){
		location.reload();
	});
	$("#cgeMail").click(function(){
		var cgeMailDiv=$("#cgeMailDiv");
		var taslctLayer2=$(".taslctLayer2")
		if(cgeMailDiv.length>0){
			taslctLayer2.show();
			cgeMailDiv.show();
			return false;
		}
		$("head").append($('<link>').attr({
			"rel":"stylesheet",
			"type":"text/css",
			"href":"/YunPhotoAlbum/Public/CSS/cgeMailDivCss.css"
		}));
		var cgeMailHideHtml=$("#cgeMailHideHtml").val();
		taslctLayer2.after(cgeMailHideHtml);
		$.getScript("/YunPhotoAlbum/Public/JS/sendmail.js");
		taslctLayer2.show();
	});

	function setTimeReload(){
		setTimeout(function(){
			location.reload();
		},1500);
	}

	$("#setQst,#setAnswer").on("input propertychange",function(){
		var val=this.value;
		val=val.replace(/\s/g," ");
		this.value=val;
	});
	var canSetQst=true;
	$("#setQstBtt").click(function(){
		if(!canSetQst){return false;}
		var isRight=true;
		if(isTrue("#passWord","pw")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isNotBlank("#setQst")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isNotBlank("#setAnswer")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(!isRight){return false;}
		canSetQst=false;
		var setQstData={
			"upw":$.trim($("#passWord").val()),
			"securityQst":$.trim($("#setQst").val()),
			"securityAsw":$.trim($("#setAnswer").val())
		};
		var setQstURL="/YunPhotoAlbum/User/setQst/t/"+$.now();
		$.post(setQstURL,setQstData,function(data){
			if(data.info){
				switch(data.info){
					case 'success':fail("&#xe687;","设置成功");setTimeReload();break;
					case 'noLogin':location.reload();break;
					case 'error2':$("#passWordErr").css("display","inline-block").html("&#xe601;密码错误");break;
					case 'error1':
					default:$("#setQstAllErr").css("display","inline-block").html("&#xe601;发生错误");break;
				}
			}else{
				if(data.upw){
					$("#passWordErr").css("display","inline-block").html("&#xe601;"+data.upw);
				}
				if(data.securityQst){
					$("#setQstErr").css("display","inline-block").html("&#xe601;"+data.securityQst);
				}
				if(data.securityAsw){
					$("#setAnswerErr").css("display","inline-block").html("&#xe601;"+data.securityAsw);
				}
			}
			canSetQst=true;
		}).fail(function(){
			canSetQst=true;
			fail("&#xe691;","发生错误");
		});
	});

</script><?php break;?>
					<?php case "getInfo": if(empty($infos)): ?><div class="nothing"></div><?php endif; ?>
<?php if(!empty($infos)): ?><link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/getInfo.css">
	<div class="taslctLayer2"></div>
	<div id="showInfo-goTop" title="回到顶部" onselectstart="return false;">&#xe64a;</div>
	<div id="showCont">
		<span id="showCont-close" onselectstart="return false;">&#xe6b2;</span>
		<img src="/YunPhotoAlbum/Public/SysImg/loading2.gif" id="showCont-loading">
		<div id="showCont-title"></div>
		<div id="showCont-Cont"></div>
		<div id="showCont-pulishTime"></div>
	</div>
	<div id="infos-warn">仅展现最近50条信息</div>
	<?php if(is_array($infos)): foreach($infos as $k=>$v): ?><div class="info" id="<?php echo ($v["iid"]); ?>">
		<?php if($v["status"] == 0): ?><div class="infoImg color-yellow">&#xe6e6;</div>
		<?php else: ?>
			<div class="infoImg color-gray">&#xe6e6;</div><?php endif; ?>
		<div class="title"><?php echo ($v["title"]); ?></div>
		<div class="pulishTime"><?php echo ($v["publishTime"]); ?></div>
		</div><?php endforeach; endif; ?>
	<script type="text/javascript">
		$("#showInfo-goTop").click(function(){
			$("body,html").stop(true,false).animate({"scrollTop":0},300,"linear");
		});
		$(".info").click(function(){
			var iid=this.id;
			var _this=$(this);
			var showContCont=$("#showCont-Cont");
			showContCont.text("");
			var showContLoading=$("#showCont-loading");
			showContLoading.show();
			$("#showCont-title").text($(this).children(".title").text());
			$("#showCont-pulishTime").text($(this).children(".pulishTime").text());
			var showContUrl="/YunPhotoAlbum/UserCenter/showCont/iid/"+iid;
			$.get(showContUrl,function(data){
				switch(data.info){
					case 'success':
					case 'error2':
						showContLoading.hide();
						showContCont.text(data.content);
						getInfo(infowarn);
						_this.children(".color-yellow").removeClass('color-yellow').addClass('color-gray');break;
					case 'noLogin':fail("&#xe691;","请先登录");setTimeReload();break;
					case 'error':
					default:fail("&#xe691;","发生错误");getInfo(infowarn);
				}
			}).fail(function(){
				fail("&#xe691;","发生错误");
			});
			$(".taslctLayer2").show();
			$("#showCont").show();
		});
		$("#showCont-close").click(function(){
			$("#showCont").hide();
			$(".taslctLayer2").hide();
		});
		function setTimeReload(){
			setTimeout(function(){
				location.reload();
			},1500);
		}
	</script><?php endif; break;?>
					<?php case "cgeMyPw": ?><link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/cgeMyPw.css">
<div class="taslctLayer2"></div>
<form id="cgePwForm" method="post">
	<div class="cgePwDiv">
		<div class="cgePwImg">&#xe6cb;</div>
		<input type="password" name="inputupw" id="inputupw" class="pw" placeholder="请输入原密码" maxlength="16">
	</div>
	<span class="cgePwErr" id="inputupwErr">ww</span>
	<div class="cgePwDiv">
		<div class="cgePwImg">&#xe6cb;</div>
		<input type="password" name="myNewPw" id="myNewPw" class="pw" placeholder="新密码" maxlength="16">
	</div>
	<span class="cgePwErr" id="myNewPwErr">eee</span>
	<div class="cgePwDiv">
		<div class="cgePwImg">&#xe714;</div>
		<input type="password" name="cmfMyNewPw" id="cmfMyNewPw" class="pw" placeholder="确认新密码" maxlength="16">
	</div>
	<span class="cgePwErr" id="cmfMyNewPwErr">tt</span>
	<button id="cgeMyPwBtt">立即修改</button><br/>
	<span class="cgePwErr" id="cgePwAllErr">yy</span>
</form>
<script type="text/javascript">
	var canCge=true;
	$("#cgePwForm").on("submit",function(event){
		event.preventDefault();
		if(!canCge){return false;}
		var isRight=true;
		if(isTrue("#inputupw","pw")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isTrue("#myNewPw","pw")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isTrue("#cmfMyNewPw","pw")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(!isRight){return false;}
		canCge=false;
		var _this=$(this);
		var cgePwData=_this.serialize();
		var cgePwURL="/YunPhotoAlbum/User/cgePw/t/"+$.now();
		$.post(cgePwURL,cgePwData,function(data){
			if(data.info){
				switch(data.info){
					case 'success':fail("&#xe687;","修改成功");$(".cgePwErr").hide();_this.get(0).reset();break;
					case 'noLogin':fail("&#xe691;","请先登录");
						setTimeout(function(){location.reload();},1500);break;
					case 'pwErr':$("#inputupwErr").css("display","inline-block").html("&#xe601;密码错误");break;
					case 'error':
					default:fail("&#xe691;","发生错误");
				}
			}else{
				if(data.upw){
					$("#myNewPwErr").css("display","inline-block").html("&#xe601;"+data.upw);
				}
				if(data.cmfMyNewPw){
					$("#cmfMyNewPwErr").css("display","inline-block").html("&#xe601;"+data.cmfMyNewPw);
				}
			}
			canCge=true;
		}).fail(function(){
			fail("&#xe691;","发生错误");
			canCge=true;
		});
	});
</script><?php break;?>
					<?php default: ?><link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/myInfo.css">
<div class="taslctLayer2"></div>
<div id="changeImgWarn">
	<div id="changeImgWarn-hd">
		<span style="font:20px iconfont;color:#fbfe06;margin-right:5px">&#xe691;</span>提示
		<span id="changeImgWarn-close" onselectstart="return false;">&#xe601;</span>
	</div>
	<div id="changeImgWarn-cnt">
		仅支持jpg、png格式的图片，且大小小于2M之间
	</div>
	<button id="changeImgWarn-btt">我知道了！</button>
</div>
<div id="contentHead">
	<div id="userImgOptDiv">
		<img src="<?php echo ($userInfo["userImg"]); ?>" id="userBigImg">
		<button id="changeImg">更改头像</button>
		<input type="file" id="changeImgInput" accept="image/png,image/jpeg,image/jpg">
	</div>
	<ul id="uname_rgtTime">
		<li><?php echo ($userInfo["uname"]); ?></li>
		<li style="width:100px;text-align:right;">注册时间：</li>
		<li><?php echo ($userInfo["rgstTime"]); ?></li>
		<li id="changeInfo" onselectstart="return false;" style="width:50px;">修改</li>
		<li id="saveChange" onselectstart="return false;" style="width:90px;display:none;">保存修改</li>
		<li id="dontSaveChange" onselectstart="return false;" style="width:90px;display:none;">不保存</li>
	</ul>
</div>
<dl id="myInfoDL">
	<dd>
		<span class="myInfoTitle">我的简介：</span>
		<span class="myInfoCont" id="myProfile"><?php echo ($userInfo["profile"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">注册邮箱：</span>
		<span class="myInfoCont" id="myMail"><?php echo ($userInfo["umail"]); ?><span id='cgeMail' onselectstart='return false;'>修改</span></span>
	</dd>
	<dd>
		<span class="myInfoTitle">姓名：</span>
		<span class="myInfoCont" id="myName"><?php echo ($userInfo["autonym"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">性别：</span>
		<span class="myInfoCont" id="mySex"><?php echo ($userInfo["usex"]); ?></span>
	</dd>
	<dd>
		<span class="myInfoTitle">生日：</span>
		<span class="myInfoCont" id="myBirthday"><?php echo ($userInfo["birthday"]); ?></span>
	</dd>
</dl>
<div id="setQstDiv">
	<input type="password" id="passWord" class="pw" placeholder="输入原密码" maxlength="16">
	<span class="qstErr" id="passWordErr"></span><br/>
	<textarea id="setQst" maxlength="30" placeholder="设置密保"></textarea>
	<span class="qstErr" id="setQstErr"></span><br/>
	<textarea id="setAnswer" maxlength="30" placeholder="密保答案"></textarea>
	<span class="qstErr" id="setAnswerErr"></span><br/>
	<button id="setQstBtt">设置密保</button><br/>
	<span class="qstErr" id="setQstAllErr"></span><br/>
</div>
<textarea id="cgeMailHideHtml" style="display:none;">
		<div id="cgeMailDiv">
			<div id="cgeMailDiv-hd">更改注册邮箱
				<span id="cgeMailDiv-close" onselectstart="return false;">&#xe601;</span>
			</div>
			<span class='inputSpan'>
				<span class="inputImg">&#xe6cb;</span>
				<input type="password" maxlength="16" placeholder="请输入登陆密码" id="inputpw" class="inputCss pw">
			</span>
			<span class="cgeMailErr" id="inputpwErr"></span>
			<span class='inputSpan'>
				<span class="inputImg">&#xe6e6;</span>
				<input type="text" class="email inputCss" id="umail" maxlength="40" placeholder="新邮件地址">
			</span>
			<span class="cgeMailErr" id="umailErr"></span>
			<span class="inputSpan">
				<input type="text" id="authcoreValue" class="authcore" maxlength="8" placeholder="验证码">
				<div class="getAuthcore" onselectstart="return false;">点击获取验证码</div>
			</span>
			<span class="cgeMailErr" id="authcoreValueErr"></span><br/>
			<button id="cgeMailBtt">立即修改</button><br/>
			<span class="cgeMailErr" id="cgeMailAllErr" style="margin-bottom:10px;"></span>
		</div>
		<script type="text/javascript">
			$(".allContent").on("click","#cgeMailDiv-close",function(){
				$("#cgeMailDiv").hide();
				$(".taslctLayer2").hide();
			});
			var canCge=true;
			$(".allContent").on("click","#cgeMailBtt",function(){
				if(!canCge){return false;}
				var isRight=true;
				if(isTrue("#inputpw","pw")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(isTrue("#umail","email")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(isNotBlank("#authcoreValue")){
					isRight=isRight&true;
				}else{
					isRight=isRight&false;
				}
				if(!isRight){
					return false;
				}
				canCge=false;
				var cgeMailData={
					"upw":$.trim($("#inputpw").val()),
					"umail":$.trim($("#umail").val()),
					"newMailAuthcore":$.trim($("#authcoreValue").val())
				}
				var cgeMailURL="/YunPhotoAlbum/User/cgeMail/t/"+$.now();
				$.post(cgeMailURL,cgeMailData,function(data){
					if(data.info){
						switch(data.info){
							case 'success':fail("&#xe687;","修改成功");setTimeReload();break;
							case 'authcoreErr':$("#authcoreValueErr").css("display","inline-block").html("&#xe601;验证码错误");break;
							case 'noLogin':fail("&#xe691;","请先登陆");setTimeReload();break;
							case 'error2':$("#inputpwErr").css("display","inline-block").html("&#xe601;密码错误");break;
							case 'error1':
							default:$("#cgeMailAllErr").css("display","inline-block").html("&#xe601;发生错误");
						}
					}else{
						if(data.upw){
							$("#inputpwErr").css("display","inline-block").html("&#xe601;"+data.upw);
						}
						if(data.umail){
							$("#umail").css("display","inline-block").html("&#xe601;"+data.umail);
						}
					}
					canCge=true;
				}).fail(function(){
					canCge=true;
					fail("&#xe691;","发生错误");
				});
			});
		</script>
</textarea>
<textarea id="changeImgScript" style="display:none;">
	<script type="text/javascript">
		var allowType=["image/png","image/jpeg","image/jpg"];
		$("#changeImgInput").change(function(){
			var val=$.trim(this.value);
			if(!val){return false;}
			var file=this.files[0];
			var imgSize=file.size;
			if(imgSize>2097152){
				$("#changeImgWarn-close").trigger("click");
				fail("&#xe691;","图片不能大于2M");
				return false;
			}
			if($.inArray(file.type,allowType)<0){
				$("#changeImgWarn-close").trigger("click");
				fail("&#xe691;","图片格式不合法");
				return false;
			}
			var imgURL=window.URL.createObjectURL(file);
			document.getElementById("userBigImg").src=imgURL;
			document.getElementsByClassName("uImg")[0].src=imgURL;
			uploadUserImg(file);
		});

		function uploadUserImg(fileObj){
			var changeImgURL="/YunPhotoAlbum/UserCenter/uploadUserImg/t/"+$.now();
			var formdata=new FormData();
			formdata.append("userImg",fileObj);
			var xmlHttp=new XMLHttpRequest;
			xmlHttp.open("POST",changeImgURL,true);
			xmlHttp.setRequestHeader("X-Requested-With","XMLHttpRequest");
			xmlHttp.onerror=function(){
				xmlHttp.abort();
				fail("&#xe691;","上传失败");
			};
			var uploadedper="";
			xmlHttp.onloadstart=function(){
				$("#userImgOptDiv").prepend("<span id='uploadedper'>0%</span>");
				uploadedper=$("#uploadedper");
			}
			xmlHttp.onprogress=function(event){ 
				if(event.lengthComputable){
					var uploaded=event.loaded;
					var total=event.total;
					var percent=Math.floor(uploaded/total)*100;
					uploadedper.text(percent+"%");
				}
			};
			xmlHttp.onreadystatechange = function() {
	        if (xmlHttp.readyState === 4) {
	            if (xmlHttp.status === 200) {
	              var responseText=xmlHttp.responseText;
	             	responseText=$.parseJSON(responseText);
	              switch(responseText.info){
	             	  case "success":fail("&#xe687;","上传成功");break;
	             	  case "noLogin":login();break;
	             	  case "error":
	             	  default:fail("&#xe691;","上传失败");
	              }
	              var timer=setTimeout(function(){
	              	uploadedper.remove();
	              	clearTimeout(timer);
	              },1000);
	            }else {
	            	uploadedper.remove();
	              fail("&#xe691;","上传失败");
	            }
	        }
	    }
	    xmlHttp.send(formdata);
		}
	</script>
</textarea>
<script type="text/javascript">
	$("#changeImg").click(function(){
		$(".taslctLayer2").show();
		$("#changeImgWarn").show();
	});
	$("#changeImgWarn-close").click(function(){
		$("#changeImgWarn").hide();
		$(".taslctLayer2").hide();
	});
	$("#changeImgWarn-btt").click(function(){
		$("#changeImgWarn-close").trigger("click");
		var changeImgScript=$("#changeImgScript").val();
		$("body").append(changeImgScript);
		$("#changeImgInput").trigger("click");
	});
	
	$("#changeInfo").click(function(){
		$(this).hide();
		$("#saveChange").show();
		$("#dontSaveChange").show();
		var myProfile=$("#myProfile");
		var profile=myProfile.text();
		if(profile=="您还没有填写简介！"){
			profile="";
		}
		myProfile.html("<textarea maxlength='250' id='cge-myProfile'>"+profile+"</textarea><span class='err' id='cge-myProfileErr'></span>");
		var myName=$("#myName");
		var name=myName.text();
		if(name=="-"){
			name="";
		}
		myName.html("<input maxlength='8' id='cge-myName' value='"+name+"'><span class='err' id='cge-myNameErr'></span>");
		var mySex=$("#mySex");
		var sex=mySex.text();
		var sexHtml="<input type='radio' name='sex'";
		if(sex=="男"){
			sexHtml+=" checked value='男' id='man'><label class='sexLabel' for='man'>男</label>";
			sexHtml+="<input type='radio' name='sex' value='女' id='woman'><label class='sexLabel' for='woman'>女</label>"
		}else{
			sexHtml+=" checked value='女' id='woman'><label class='sexLabel' for='woman'>女</label>";
			sexHtml+="<input type='radio' name='sex' value='男' id='man'><label class='sexLabel' for='man'>男</label>";
		}
		mySex.html(sexHtml);
		var myBirthday=$("#myBirthday");
		var birthday=myBirthday.text();
		var dateObj=new Date;
		var nowYear=dateObj.getFullYear();
		var nowMonth=dateObj.getMonth()+1;
		if(nowMonth<10){
			nowMonth="0"+nowMonth;
		}
		var nowDay=dateObj.getDate();
		if(nowDay<10){
			nowDay="0"+nowDay;
		}
		var nowDate=nowYear+"-"+nowMonth+"-"+nowDay;
		if(birthday=="-"){
			birthday=nowDate;
		}
		myBirthday.html("<input type='date' id='cge-myBirthday' value='"+birthday+"'   min='1900-01-01' max='"+nowDate+"'>");
	});
	var canSave=true;
	$("#saveChange").click(function(){
		if(!canSave){return false;}
		canSave=false;
		var infoChangeUrl="/YunPhotoAlbum/UserCenter/infoChange/t/"+$.now();
		var myProfile=$.trim(document.getElementById("cge-myProfile").value);
		var myName=$.trim(document.getElementById("cge-myName").value);
		var RegExpStr=/^[\u4E00-\u9FA5]{2,8}$/g;
		if(myName){
			if(!myName.match(RegExpStr)){
				$("#cge-myNameErr").html("&#xe601;仅支持2-8位的中文姓名");
				canSave=true;
				return false;
			}else{
				$("#cge-myNameErr").empty();
			}
		}
		var mySex=$("input[name='sex']:checked").val();
		var myBirthday=$.trim(document.getElementById("cge-myBirthday").value);
		var cgeData={
			"profile":myProfile,
			"autonym":myName,
			"usex":mySex,
			"birthday":myBirthday
		};
		$.get(infoChangeUrl,cgeData,function(data){
			switch(data.info){
				case 'noLogin':location.reload();break;
				case 'success':
					fail("&#xe687;","修改成功");
					setTimeReload();
					break;
				case 'error':
				default:
					fail("&#xe691;","修改失败");
					setTimeReload();
			}
		}).fail(function(){
			fail("&#xe691;","修改失败");
			setTimeReload();
		});
	});
	$("#myProfile").on("input propertychange","#cge-myProfile",function(){
		var val=this.value;
		val=val.replace(/\s/g," ");
		this.value=val;
	});
	$("#myName").on("input propertychange","#cge-myName",function(){
		var val=this.value;
		if(val.match(/[^\u4E00-\u9FA5]/g)){
			$("#cge-myNameErr").html("&#xe601;仅支持2-8位的中文姓名");
		}else{
			$("#cge-myNameErr").empty();
		}
	});
	$("#dontSaveChange").click(function(){
		location.reload();
	});
	$("#cgeMail").click(function(){
		var cgeMailDiv=$("#cgeMailDiv");
		var taslctLayer2=$(".taslctLayer2")
		if(cgeMailDiv.length>0){
			taslctLayer2.show();
			cgeMailDiv.show();
			return false;
		}
		$("head").append($('<link>').attr({
			"rel":"stylesheet",
			"type":"text/css",
			"href":"/YunPhotoAlbum/Public/CSS/cgeMailDivCss.css"
		}));
		var cgeMailHideHtml=$("#cgeMailHideHtml").val();
		taslctLayer2.after(cgeMailHideHtml);
		$.getScript("/YunPhotoAlbum/Public/JS/sendmail.js");
		taslctLayer2.show();
	});

	function setTimeReload(){
		setTimeout(function(){
			location.reload();
		},1500);
	}

	$("#setQst,#setAnswer").on("input propertychange",function(){
		var val=this.value;
		val=val.replace(/\s/g," ");
		this.value=val;
	});
	var canSetQst=true;
	$("#setQstBtt").click(function(){
		if(!canSetQst){return false;}
		var isRight=true;
		if(isTrue("#passWord","pw")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isNotBlank("#setQst")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(isNotBlank("#setAnswer")){
			isRight=isRight&true;
		}else{
			isRight=isRight&false;
		}
		if(!isRight){return false;}
		canSetQst=false;
		var setQstData={
			"upw":$.trim($("#passWord").val()),
			"securityQst":$.trim($("#setQst").val()),
			"securityAsw":$.trim($("#setAnswer").val())
		};
		var setQstURL="/YunPhotoAlbum/User/setQst/t/"+$.now();
		$.post(setQstURL,setQstData,function(data){
			if(data.info){
				switch(data.info){
					case 'success':fail("&#xe687;","设置成功");setTimeReload();break;
					case 'noLogin':location.reload();break;
					case 'error2':$("#passWordErr").css("display","inline-block").html("&#xe601;密码错误");break;
					case 'error1':
					default:$("#setQstAllErr").css("display","inline-block").html("&#xe601;发生错误");break;
				}
			}else{
				if(data.upw){
					$("#passWordErr").css("display","inline-block").html("&#xe601;"+data.upw);
				}
				if(data.securityQst){
					$("#setQstErr").css("display","inline-block").html("&#xe601;"+data.securityQst);
				}
				if(data.securityAsw){
					$("#setAnswerErr").css("display","inline-block").html("&#xe601;"+data.securityAsw);
				}
			}
			canSetQst=true;
		}).fail(function(){
			canSetQst=true;
			fail("&#xe691;","发生错误");
		});
	});

</script><?php endswitch;?>
			</div>
		</div>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/commonJs.js" charset="UTF-8"></script>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/userCenter.js" charset="UTF-8"></script>
	</body>
</html>