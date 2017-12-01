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
	<?php if($isLogin === 'isLogin'): ?><a href="" title="查看消息" id="info">
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
		(function(){
				var infowarn=document.getElementById("infowarn");
				getInfo(infowarn);
		})();
		function getInfo(infowarn){
			var isExistsInfoURL="/YunPhotoAlbum/Info/index/t/"+$.now();
			$.get(isExistsInfoURL,function(data){
				switch(data.info){
					case 'exists':infowarn.src="/YunPhotoAlbum/Public/SysImg/infowarn.gif";break;
					case 'noLogin':infowarn.src="/YunPhotoAlbum/Public/SysImg/infowarn.png";break;
					default:getInfo(infowarn);
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
				<li class="menuLi" onselectstart="return false;" <?php echo ($init["style2"]); ?>>消息查看</li>
				<li class="menuLi" onselectstart="return false;" <?php echo ($init["style3"]); ?>>密码更改</li>
			</ul>
			<div class="content">
				<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/myInfo.css">
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
	<textarea id="setQst" maxlength="30" placeholder="设置密保"></textarea>
	<span class="qstErr" id="setQstErr"></span><br/>
	<textarea id="setAnswer" maxlength="30" placeholder="密保答案"></textarea>
	<span class="qstErr" id="setAnswerErr"></span><br/>
	<button id="setQstBtt">设置密保</button><br/>
	<span class="qstErr" id="setQstAllErr"></span><br/>
</div>
<textarea id="cgeMailHideHtml" style="display:none;">
		<div id="cgeMailDiv">
			<div id="cgeMailDiv-hd">
			更改注册邮件
			<span id="cgeMailDiv-close" onselectstart="return false;">&#xe601;</span>
			</div>
			<div id="toOldMail">
				<div id="toOldMail-txt"></div>
				<div id="sendmailDiv">
					<input type="text" id="authcoreValue" maxlength="8">
					<div class="getAuthcore" onselectstart="return false;">点击获取验证码</div>
				</div><br/>
				<span class="cgeMailErr" id="authcoreValueErr"></span>
				<button id="sendmailBtt">下一步</button>
			</div>
			<div id="setNewMailDiv">
				<input type="text" class="email" id="newEmail" maxlength="40" placeholder="邮件地址"><br/>
				<span class="cgeMailErr" id="newEmailErr"></span>
				<div id="sendmailDiv2">
					<input type="text" id="authcoreValue2" maxlength="8">
					<div class="getAuthcore2" onselectstart="return false;">点击获取验证码</div>
				</div><br/>
				<span class="cgeMailErr" id="authcoreValue2Err"></span>
				<button id="cgeMailBtt">立即修改</button>
			</div>
		</div>
		<script type="text/javascript">
			var oldEmail=$("#myMail").text();
			oldEmail=oldEmail.substring(0,6)+"***";
			$("#toOldMail-txt").text("向"+oldEmail+"发送邮件...");
			$(".allContent").on("click","#cgeMailDiv-close",function(){
				$("#cgeMailDiv").hide();
				$(".taslctLayer2").hide();
			});
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
		$("#changeImgInput").trigger("click");
	});
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
		}
		$.get(infoChangeUrl,cgeData,function(data){
			switch(data.info){
				case 'noLogin':location.reload();break;
				case 'success':
					fail("&#xe687;","修改成功");
					setTimeout(function(){
						location.reload();
					},1500);
					break;
				case 'error':
				default:
					fail("&#xe691;","修改失败");
					setTimeout(function(){
						location.reload();
					},1500);
			}
			canSave=true;
		}).fail(function(){
			fail("&#xe691;","修改失败");
			setTimeout(function(){
				location.reload();
			},1500);
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
		taslctLayer2.show();
	});
</script>
			</div>
		</div>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/commonJs.js" charset="UTF-8"></script>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/userCenter.js" charset="UTF-8"></script>
	</body>
</html>