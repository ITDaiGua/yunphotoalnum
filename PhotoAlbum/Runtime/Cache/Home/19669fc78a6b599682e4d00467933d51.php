<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title><?php echo ($init["title"]); ?></title>
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
	<!--[if lte IE 9]>
		<div style="position:fixed;z-index:9999;width:100%;height=40px;background-color:#FFC125;letter-spacing:10px;text-align:center;color:#ff0000;font-size:18px;line-height:40px;left:0;top:0;">
		您的浏览器版本过低，不能正常使用该系统
		</div>
	<![endif]-->
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
	<div id="menuDiv">
		<div id="logo">
			<a href="/YunPhotoAlbum/">
				<img src="/YunPhotoAlbum/Public/SysImg/logo.png" width="150" height="80">
			</a>
		</div>
		<div id="menu">
			<ul>
				<a href="/YunPhotoAlbum/">
					<li <?php echo ($init["styleLi1"]); ?>>图片广场</li>
				</a>
				<li <?php echo ($init["styleLi2"]); ?>>我的相册</li>
				<li <?php echo ($init["styleLi3"]); ?>>我的分享</li>
				<li <?php echo ($init["styleLi4"]); ?>>我的收藏</li>
			</ul>
		</div>
		<form name="seachForm" action="" method="post" id="seachForm">
			<input type="text" name="seach" id="seach" placeholder="搜索我的图片" autocomplete="off">
			<input type="submit" class="iconfont" value="&#xe61e;" id="seachbtt">
		</form>
	</div>
	<?php if($init['viewType'] == 'shareFolders'): ?><link type="text/css" rel="stylesheet" href="/YunPhotoAlbum/Public/CSS/shareFolders.css">
<div class="allContent">
	<div class="pcTittle">图片分类</div>
	<div class="photoClass">
		<span class="pcContent" style="font-weight:bold;">
			<a href=''>综合</a>
		</span>
	</div>
	<script type="text/javascript">
		var photoClassJson;
		var classPan="";
		$.getJSON("/YunPhotoAlbum/Public/Json/photoClassJson.json",function(data){
			photoClassJson=data;
			$.each(data,function(photoClass,childrenPC){
				classPan+="<span class='pcContent'>";
				classPan+="<a href=''>";
				classPan+=photoClass+"</a></span>";
			});
			$(".photoClass").append(classPan);
		}).fail(function(){
			var _fail="<div class='errorORwarn'><span class='iconfont errorORwarnImg'>&#xe691;</span>发生错误</div>";
			$('body').prepend(_fail);
			setTimeout(function(){
				$(".errorORwarn").remove();
			},1500);
		});
	</script>
	<?php if(is_array($selRst)): foreach($selRst as $selKey=>$selVal): endforeach; endif; ?>
</div><?php endif; ?>
	<div id="endInfo">
		增值电信业务经营许可证:&nbsp;<a href="javascript:void(0)">粤B2-20110446</a>&nbsp;网络文化经营许可证:&nbsp;<a href="javascript:void(0)">粤网文[2015]0295-065号</a>&nbsp;<a href="javascript:void(0)">12318举报</a><br>互联网药品信息服务资质证书编号:&nbsp;<a href="javascript:void(0)">粤-（经营性）-2017-0005</a>&nbsp;&nbsp;<img src="/YunPhotoAlbum/Public/SysImg/beianbgs.png" width="20" height="20" id="beianbgs">粤公网安备&nbsp;<a href="javascript:void(0)">33010002000120号</a>
	</div>
</body>
</html>