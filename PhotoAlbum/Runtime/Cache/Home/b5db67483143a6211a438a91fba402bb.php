<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title><?php echo ($title); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/YunPhotoAlbum/Public/SysImg/cloud.ico">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/commonCss.css">
	<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/index.css">
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
	<!--[if lte IE 8]>
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/index.js" charset="UTF-8"></script>
</head>
<body>
	<div id="headMenu"></div>
	<div id="allContent">
		<div id="menuDiv">
			<div id="logo">
				<a href="/YunPhotoAlbum/">
					<img src="/YunPhotoAlbum/Public/SysImg/logo.png" width="150" height="80">
				</a>
			</div>
			<div id="menu">
				<ul>
					<li>我的相册</li>
					<li>我的分享</li>
					<li>我的收藏</li>
					<li>图片广场</li>
				</ul>
			</div>
			<form name="seachForm" action="" method="post" id="seachForm">
				<input type="text" name="seach" id="seach" placeholder="搜索我的图片">
				<input type="submit" class="iconfont" value="&#xe61e;" id="seachbtt">
			</form>
		</div>
	</div>
	<div id="endInfo">
		增值电信业务经营许可证:&nbsp;<a href="javascript:void(0)">粤B2-20110446</a>&nbsp;网络文化经营许可证:&nbsp;<a href="javascript:void(0)">粤网文[2015]0295-065号</a>&nbsp;<a href="javascript:void(0)">12318举报</a><br>互联网药品信息服务资质证书编号:&nbsp;<a href="javascript:void(0)">粤-（经营性）-2017-0005</a>&nbsp;&nbsp;<img src="/YunPhotoAlbum/Public/SysImg/beianbgs.png" width="20" height="20" id="beianbgs">粤公网安备&nbsp;<a href="javascript:void(0)">33010002000120号</a>
	</div>
</body>
</html>