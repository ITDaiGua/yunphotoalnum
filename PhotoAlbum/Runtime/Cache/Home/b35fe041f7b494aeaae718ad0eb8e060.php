<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">    
		<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">    
		<meta HTTP-EQUIV="Expires" CONTENT="0"> 
		<title>图片</title>
		<link rel="shortcut icon" type="image/x-icon" href="/YunPhotoAlbum/Public/SysImg/cloud.ico">
		<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/commonCss.css">
		<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/showPH.css">
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
		<!--[if lte IE 8]>
			<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/showPH.js"></script>
	</head>
	<body>
		<div class="taslctLayer"></div>
<div id="headMenu">
	<?php if($isLogin === 'isLogin'): ?><a href="">
			<img src="<?php echo ($ifwnImgURL); ?>" id="infowarn">
		</a>
		<a href="">退出</a>
		<span>|</span>
		<span style="color:#ff0000;vertical-align:middle;">欢迎:</span>
		<a href="">
			<?php echo ($userName); ?>
			<img src="<?php echo ($uImg); ?>" class="uImg">
		</a>
	<?php else: ?>
		<span style="color:#ff0000;vertical-align:middle;">您还没有登陆！</span>
		<a href="">登陆</a>
		<span style="vertical-align:middle;">|</span>
		<a href="">注册</a>
		<img src="/YunPhotoAlbum/Public/SysImg/uimg.jpg" class="uImg"><?php endif; ?>
</div>
		<div class="iconfont rightOpt">
			<div class="tipoff">
				<div class="explain">
					举报
					<span class="triangle"></span>
				</div>
				&#xe695;
			</div>
			<div class="collection">
				<div class="explain">
					收藏
					<span class="triangle"></span>
				</div>
				&#xe617;
			</div>
			<div class="swPHTop">
				<div class="explain">
					回到顶部
					<span class="triangle"></span>
				</div>
				&#xe64a;
			</div>
		</div>
		<div class="allContent showPhotos">
			<?php if($selSPRst === ''): ?><div class="nothing"></div>
			<?php else: ?>
				<?php if(is_array($selSPRst)): foreach($selSPRst as $key=>$value): ?><div class="shareUInfo">
						<a href="">
							<img src="/YunPhotoAlbum/Public/UserImg/<?php echo ($value['uid']); ?>.jpg" class="swPHUImg">
							<span class="authorName"><?php echo ($value['authorName']); ?></span>
						</a>
					</div>
					<div class="PATitle">
						<?php echo ($value['sName']); ?>&nbsp;&nbsp;&nbsp;
						<span class="iconfont">&#xe60b;&nbsp;<?php echo ($value['lookSum']); ?></span>
						<span class="iconfont">&#xe61f;&nbsp;<?php echo ($value['likeSum']); ?></span>
						<span class="iconfont"><span style="font-size:18px;">&#xe617;</span>&nbsp;<?php echo ($value['cltSum']); ?></span>
						<span class="iconfont">&#xe63a;&nbsp;<?php echo ($value['shareTime']); ?></span>
					</div>
					<hr class="hr"/>
					<div class="shwProfile">
						<span>相册简介：</span><br/>&nbsp;&nbsp;<?php echo ($value['profile']); ?>
					</div><?php endforeach; endif; ?>
				<?php if(is_array($selRst)): foreach($selRst as $key=>$value): ?><div class="spImg">
						<img src="<?php echo ($value['spLink']); ?>">
						<span><?php echo ($value['PName']); ?></span>
					</div><?php endforeach; endif; endif; ?>
		</div>
	</body>
</html>