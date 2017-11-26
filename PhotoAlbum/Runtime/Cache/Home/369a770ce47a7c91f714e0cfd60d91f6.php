<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">    
	<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">    
	<meta HTTP-EQUIV="Expires" CONTENT="0"> 
	<title>注册</title>
	<link rel="shortcut icon" type="image/x-icon" href="/YunPhotoAlbum/Public/SysImg/cloud.ico">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/commonCss.css">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/registration.css">
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
	<!--[if lte IE 8]>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
	<![endif]-->
	
</head>
<body>
	<div class="taslctLayer"></div>
<div id="headMenu">
	<a href="/YunPhotoAlbum/" style="float:left;margin-left:200px;">首页</a>
	<?php if($isLogin === 'isLogin'): ?><a href="" title="查看消息">
			<img src="/YunPhotoAlbum/Public/SysImg/infowarn.png" id="infowarn">
		</a>
		<a href="/YunPhotoAlbum/User/logout">退出</a>
		<span style="vertical-align:middle;">|</span>
		<span style="color:#ff0000;vertical-align:middle;">欢迎:</span>
		<a href="" class="PsnlCtr" title="个人中心">
			<span style="vertical-align:middle;"><?php echo ($userName); ?></span>
			<img src="<?php echo ($uImg); ?>" class="uImg">
		</a>
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
		</script><?php endif; ?>
</div>
<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/commonJs.js"></script>
	<div id="rgtAllCont">
		<div id="rgtTitle">注册</div>
		<form name="rgtForm" id="rgtForm" method="post">
			<span class="rgtCont">
				<div class="rgtImg">&#xe75a;</div>
				<input type="text" name="uname" placeholder="用户名" id="uname" maxlength="6" autocomplete="off">
			</span>
			<span id="unameErr" class="rgtErr"></span>
			<span class="rgtCont">
				<div class="rgtImg">&#xe6cb;</div>
				<input type="password" name="upw" placeholder="用户密码" class="pw" id="upw" maxlength="18">
			</span>
			<span id="upwErr" class="rgtErr"></span>
			<span class="rgtCont">
				<div class="rgtImg">&#xe714;</div>
				<input type="password" name="cmfupw" placeholder="确认密码" class="pw" id="cmfupw" maxlength="18">
			</span>
			<span id="cmfupwErr" class="rgtErr"></span>
			<span class="rgtCont">
				<div class="rgtImg">&#xe6e6;</div>
				<input type="text" name="umail" placeholder="你的邮箱地址"  class="email" id="umail" maxlength="40" autocomplete="off">
			</span>
			<span id="umailErr" class="rgtErr"></span>
			<span class="rgtCont">
				<input type="text" name="authcore" placeholder="验证码" id="authcore" class="authcore" maxlength="10" autocomplete="off">
				<span id="getAuthcore" onselectstart="return false;" class="getAuthcore">点击获取验证码</span>
			</span>
			<span id="authcoreErr" class="rgtErr"></span>
			<span id="agreeProSpan">
				<input type="checkbox" name="agreePro" id="agreePro" checked="checked" value="agree">
				<label id="agreeProLb" for="agreePro"></label>
				<label id="agreeProTxt" for="agreePro">
				 同意<a href="javascript:void(0);">《用户注册协议》</a>和
				 <a href="javascript:void(0);">《用户隐私协议》</a>
				</label>
			</span>
			<span id="agreeProErr" class="rgtErr">&#xe601;必须同意注册协议才能注册</span>
			<button id="rgtBtt">
				<span style="vertical-align:middle;">立即注册</span>
			</button>
			<span id="rgtAllErr" class="rgtErr"></span>
		</form>
	</div>
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/sendmail.js" charset="utf-8"></script>
	<script type="text/javascript">
		var cmfupwIsTrue=false;
		var canRgt=true;  //防止重复提交
		var rgtLoading2=$("<img src='/YunPhotoAlbum/Public/SysImg/loading2.gif'>").css({
			"width":"25px",
			"height":"25px",
			"vertical-align":"middle"
		});
		$("#rgtForm").on("submit",function(event){
			event.preventDefault();
			var isTrueTmp=true;
			$("#rgtForm input").each(function(){
				var idTmp=this.id;
				var idTmp2="#"+idTmp;
				switch(idTmp){
					case 'uname':isTrueTmp=isTrueTmp&isNotBlank(idTmp2);break;
					case 'upw':isTrueTmp=isTrueTmp&isTrue(idTmp2,"pw");break;
					case 'cmfupw':$(idTmp2).trigger('blur');isTrueTmp=isTrueTmp&cmfupwIsTrue;break;
					case 'umail':isTrueTmp=isTrueTmp&isTrue(idTmp2,"email");break;
					case 'authcore':isTrueTmp=isTrueTmp&isNotBlank(idTmp2);break;
					case 'agreePro':
						if($("#agreePro").is(":checked")){
							$("#agreeProErr").hide();
							isTrueTmp=isTrueTmp&true;
						}else{
							$("#agreeProErr").css({"display":"inline-block"});
							isTrueTmp=isTrueTmp&false;
						}
						break;
				}
			});
			if(!isTrueTmp||!canRgt){
				return false;
			}
			canRgt=false;
			var rgtLoading2Id="rgt"+$.now();
			$("#rgtBtt").append(rgtLoading2.attr("id",rgtLoading2Id));
			var rgtUrl="/YunPhotoAlbum/User/registration/t/"+$.now();
			$.post(rgtUrl,$(this).serialize(),function(data){
			//	document.write(data);
				$.each(data,function(k,v){
					var errTmp="";
					switch(k){
						case 'uname':errTmp=$('#unameErr');break;
						case 'upw':errTmp=$("#upwErr");break;
						case 'cmfupw':errTmp=$("#cmfupwErr");break;
						case 'umail':errTmp=$("#umailErr");break;
						case 'authcore':errTmp=$("#authcoreErr");break;
						case 'agreePro':
							$("#agreeProErr").css({"display":"inline-block"});
							$("#"+rgtLoading2Id).remove();
							canRgt=true;
							break;
						case 'rgtAllErr':errTmp=$("#rgtAllErr");break;
						case 'success':window.location.href="/YunPhotoAlbum/";
					}
					if(errTmp!=""){
						errTmp.html("&#xe601;"+v).css({"display":"inline-block"});
						$("#"+rgtLoading2Id).remove();
						canRgt=true;
					}
				});
			}).fail(function(){
				fail("&#xe691;","发生错误");
				$("#"+rgtLoading2Id).remove();
				canRgt=true;
			});
		});

		var testUnameUrl="/YunPhotoAlbum/User/testUname/t/"+$.now();
		$("#uname").on("blur",function(){
			var uname=$(this).val();
			var unameErr=$("#unameErr");
			if(uname.length<2){
				unameErr.html("&#xe601;不能小于2字符").css({"display":"inline-block"});
			}else if(uname.match(/^[\u4E00-\u9FA5A-Za-z0-9_]{2,6}$/g)){
				$testUname=$(this).serialize();
				$.post(testUnameUrl,$testUname,function(data){
					//document.write(data);
					/*switch(data.info){
						case 'noExists':unameErr.html("").hide();break;
						case 'exists':unameErr.html("&#xe601;用户名已存在").css({"display":"inline-block"});break;
						//case 'uname':unameErr.html("&#xe601;"+).css({"display":"inline-block"});break;
					}*/
					if(data.info=="noExists"){
						unameErr.html("").hide();
						return true;
					}
					if(data.uname){
						unameErr.html("&#xe601;"+data.uname).css({"display":"inline-block"});
						return false;
					}
				});
			}else{
				unameErr.html("&#xe601;必须是2-8位中文或英文或数字或下划线组成").css({"display":"inline-block"});
			}
		});

		$("#upw").on("blur",function(){
				isTrue("#upw","pw");
		});

		$("#cmfupw").on("blur",function(){
			if(isTrue("#cmfupw","pw")){
				var val=$("#upw").val();
				var cmfupw=$(this).val();
				if(val!=cmfupw){
					$("#cmfupwErr").html("&#xe601;必须与上一个密码相同").css({"display":"inline-block"});
				}else{
					$("#cmfupwErr").html("").hide();
					cmfupwIsTrue=true;
					return true;
				}
			}
			cmfupwIsTrue=false;
			return false;
		});

		$("#agreeProLb,#agreeProTxt").on("click",function(){
			clearTimeout(timer);
			var timer=setTimeout(function(){
				if($("#agreePro").is(':checked')){
					$("#agreeProErr").hide();
				}else{
					$("#agreeProErr").css({"display":"inline-block"});
				}
			},100);
		});

		$("#authcore").on('blur',function(){
			isNotBlank("#authcore");
		});
	</script>
</body>
</html>