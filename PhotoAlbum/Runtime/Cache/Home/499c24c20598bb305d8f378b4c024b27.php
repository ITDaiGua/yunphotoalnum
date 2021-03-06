<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">    
	<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">    
	<meta HTTP-EQUIV="Expires" CONTENT="0"> 
	<title>作者空间</title>
	<link rel="shortcut icon" type="image/x-icon" href="/YunPhotoAlbum/Public/SysImg/cloud.ico">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/commonCss.css">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/authorInfo.css">
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
	<!--[if lte IE 8]>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/authorInfo.js"></script>
</head>
<body>
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

	<div class="goTop" onselectstart="return false;" title="回到顶部">&#xe64a;</div>
	<script type="text/javascript">
		$(".goTop").click(function(){
			$("body,html").stop(true,false).animate({scrollTop:0},200);
		});
	</script>
	<?php if(!empty($selRst['uid'])): ?><div class="allContent" id="<?php echo ($selRst['uid']); ?>">
			<div class='uInfoHead'>
				<div class='uInfoImg'>
					<img src="<?php echo ($selRst['userImg']); ?>/w/100/h/110">
				</div>
				<div  class='uInfoTitle'>
					<?php echo ($selRst['uname']); ?>的个人空间
				</div>
			</div>
			<div class="hr"></div>
			<div id="ahProfile">
				<span id='ahProfile-Title'>作者简介：</span>
				<?php echo ($selRst['profile']); ?>
			</div>
			<div class="detailInfo">
				<span class="detailInfo-title">作者昵称：</span>
				<?php echo ($selRst['uname']); ?>
			</div>
			<div class="detailInfo">
				<span class="detailInfo-title">姓名：</span>
				<?php echo ($selRst['autonym']); ?>
			</div>
			<div class="detailInfo">
				<span class="detailInfo-title">性别：</span>
				<?php echo ($selRst['usex']); ?>
			</div>
			<div class="detailInfo">
				<span class="detailInfo-title">注册时间：</span>
				<?php echo ($selRst['rgstTime']); ?>
			</div>
			<div class="authorSeBg"></div>
			<div class="shareDiv">
				<?php if($hisshare == 'nothing'): ?><div class="nothing"></div>
				<?php else: ?>
					<?php if(is_array($hisshare)): foreach($hisshare as $k=>$v): ?><a href="/YunPhotoAlbum/Index/showSH/sid/<?php echo ($v['sid']); ?>/" class="hisshare">
							<img src="/YunPhotoAlbum/Public/SysImg/folderImg2.png">
							<span class="hisshareNm"><?php echo ($v['sName']); ?></span>
						</a><?php endforeach; endif; endif; ?>
			</div>
			
			<div class="loadingai">
				<img src="/YunPhotoAlbum/Public/SysImg/loading.gif">
			</div>
		</div>
	<?php else: ?>
		<div class="nothing"></div><?php endif; ?>
</body>
</html>