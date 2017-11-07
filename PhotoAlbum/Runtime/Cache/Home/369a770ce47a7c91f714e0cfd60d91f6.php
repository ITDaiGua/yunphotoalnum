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
			<img src="<?php echo ($uImg); ?>/w/35/h/35" class="uImg">
		</a>
	<?php else: ?>
		<span style="color:#ff0000;vertical-align:middle;">您还没有登陆！</span>
		<a href="javascript:void(0);" id="wannaLg">登陆</a>
		<span style="vertical-align:middle;">|</span>
		<a href="/YunPhotoAlbum/User/rgtHtml">注册</a>
		<img src="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg" class="uImg"><?php endif; ?>
</div>
<script type="text/javascript">
	$("#wannaLg").click(function(){
		login();
	});
</script>
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
				<input type="text" name="authcore" placeholder="验证码" id="authcore" id="authcore" maxlength="10" autocomplete="off">
				<span id="getAuthcore" onselectstart="return false;" class="getAuthcore">点击获取验证码</span>
			</span>
			<span id="authcoreErr" class="rgtErr"></span>
			<span id="agreeProSpan">
				<input type="checkbox" name="agreePro" id="agreePro" checked="checked">
				<label id="agreeProLb" for="agreePro"></label>
				<label id="agreeProTxt" for="agreePro">
				 同意<a href="javascript:void(0);">《用户注册协议》</a>和
				 <a href="javascript:void(0);">《用户隐私协议》</a>
				</label>
			</span>
			<span id="agreeProErr" class="rgtErr"></span>
			<button id="rgtBtt">立即注册</button>
			<span id="rgtAllErr" class="rgtErr" style="display:inline-block;"></span>
		</form>
	</div>
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/sendmail.js" charset="utf-8"></script>
	<script type="text/javascript">
		$("#rgtForm").on("submit",function(event){
			event.preventDefault();
		});
	</script>
</body>
</html>