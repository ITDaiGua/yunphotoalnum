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
		<form name="seachForm" action="<?php echo ($init["searchURL"]); ?>" method="post" id="seachForm">
			<input type="text" name="condition" id="seach" placeholder="<?php echo ($init["placeholder"]); ?>" autocomplete="off">
			<input type="submit" class="iconfont" value="&#xe61e;" id="seachbtt">
		</form>
	</div>
	<?php if($init['viewType'] == 'shareFolders'): ?><link type="text/css" rel="stylesheet" href="/YunPhotoAlbum/Public/CSS/shareFolders.css">
<div class="allContent">
	<div class="pcTittle">图片分类</div>
	<div class="photoClass">
		<span class="pcContent" style="font-weight:bold;">
			<a href='/YunPhotoAlbum/'>综合</a>
		</span>
	</div>
	<script type="text/javascript">
		var photoClassJson;
		var classPan="";
		$.getJSON("/YunPhotoAlbum/Public/Json/photoClassJson.json",function(data){
			photoClassJson=data;
			$.each(data,function(photoClass,childrenPC){
				classPan+="<span class='pcContent'>";
				classPan+="<a href='/YunPhotoAlbum/Index/index/page/1/condition/"+photoClass+"'>";
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
	<?php if($selRst != null): if(is_array($selRst)): foreach($selRst as $selKey=>$selVal): ?><a href="/YunPhotoAlbum/Index/showSH/sid/<?php echo ($selVal['sid']); ?>/" target="_blank" class="theA">
				<div class="shareAlbum">
					<div class="SAImg">
						<img src="/YunPhotoAlbum/Public/SysImg/folderImg.png">
					</div>
					<div class="SPtxt">
						<div class="SANmeAdTme">
							<span class="sName"><?php echo ($selVal['sName']); ?></span>
							<span class="titleCss1"><?php echo ($selVal['shareTime']); ?></span>
						</div>
						<div class="SAProfile">
							<span class="titleCss2">简介：</span>
							<span class="profile"><?php echo ($selVal['profile']); ?></span>
						</div>
						<div class="SAClsAndTme">
							<span class="titleCss2">所属分类：</span>
							<?php echo ($selVal['sclass']); ?>	
						</div>
					</div>
				</div>
			</a><?php endforeach; endif; ?>
		<script type="text/javascript">
			$.each($(".sName"),function(){
				var _this=$(this);
				ellipsis(_this,9);
			});
			$.each($(".profile"),function(){
				var _this=$(this);
				ellipsis(_this,30);
			});
			function ellipsis(_this,maxLen){
				var txt=$.trim(_this.text());
				var len=txt.length;
				var tmpTxt="";
				if(len>maxLen){
					tmpTxt+=txt.substring(0,maxLen);
					tmpTxt+="...";
					_this.text(tmpTxt);
					_this.attr("title",txt);
				}
			}
		</script>
	<?php else: ?>
		<div class="nothing"></div><?php endif; ?>
</div>
<?php if($init['totalPage'] >= 2): ?><div class="pageNum">
		<?php if($init['totalPage'] > 5): ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']-1); ?>/" id="lastPage">上一页</a><?php endif; ?>
		<?php if($init['page'] >= $init['lastpg']): ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']); ?>/" style="border-color:#00a2ff;color:#00a2ff;margin:0;"><?php echo ($init['page']); ?></a>
			<?php if($init['page']+5 > $init['totalPage']): $__FOR_START_14648__=$init['page']+1;$__FOR_END_14648__=$init['totalPage']+1;for($i=$__FOR_START_14648__;$i < $__FOR_END_14648__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_7441__=$init['page']+1;$__FOR_END_7441__=$init['page']+5;for($i=$__FOR_START_7441__;$i < $__FOR_END_7441__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
		<?php elseif($init['page'] < $init['lastpg']): ?>
			<?php if($init['page']-4 <= 0): $__FOR_START_15990__=1;$__FOR_END_15990__=$init['page'];for($i=$__FOR_START_15990__;$i < $__FOR_END_15990__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_15479__=$init['page']-4;$__FOR_END_15479__=$init['page'];for($i=$__FOR_START_15479__;$i < $__FOR_END_15479__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
			<a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']); ?>/" style="border-color:#00a2ff;color:#00a2ff;margin:0;"><?php echo ($init['page']); ?></a><?php endif; ?>
		<?php if($init['totalPage'] > 5): ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']+1); ?>/" id="nextPage">下一页</a><?php endif; ?>
		<?php if($init['totalPage'] > 2): ?><span id="showTotalPage">共<?php echo ($init['totalPage']); ?>页</span><?php endif; ?>
		<?php if($init['totalPage'] >= 6): ?><form method="post" action="" id="pageFrom">
				<dl>
					<dt>
						<span>到第</span>
						<input type="text" name="page" autocomplete="off">
						<span>页</span>
						<input type="submit" name="gotoBtt" value="确定">
					</dt>
				</dl>
			</form><?php endif; ?>
	</div>
	<script type="text/javascript">
		var totalPage=<?php echo ($init['totalPage']); ?>;
		$("input[name=page]").on("input propertychange",function(){
			var gtpgval=$(this).val();
			var gtpvaltmp1=gtpgval.replace(/[^0-9]+/g,"");
			if(gtpvaltmp1>totalPage){
				gtpvaltmp1=totalPage;
			}
			$(this).val(gtpvaltmp1);
		});
		$("input[name=page]").on("blur",function(){
			var gtpgval=$(this).val();
			if(gtpgval<=0){
				$(this).val("1");
			}
		});
		var canOpt=true;
		$("#pageFrom").on("submit",function(event){
			if(canOpt){
				canOpt=false;
				setTimeout(function(){
					canOpt=true;
				},1500);
				var gtpvaltmp2=$.trim($("input[name=page]").val());
				if(gtpvaltmp2==""||gtpvaltmp2<=0){
					return false;
				}
				event.preventDefault();
				window.location.href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/"+gtpvaltmp2+"/";
			}else{
				return false;
			}
		});
	</script><?php endif; endif; ?>
	<div id="endInfo">
		增值电信业务经营许可证:&nbsp;<a href="javascript:void(0)">粤B2-20110446</a>&nbsp;网络文化经营许可证:&nbsp;<a href="javascript:void(0)">粤网文[2015]0295-065号</a>&nbsp;<a href="javascript:void(0)">12318举报</a><br>互联网药品信息服务资质证书编号:&nbsp;<a href="javascript:void(0)">粤-（经营性）-2017-0005</a>&nbsp;&nbsp;<img src="/YunPhotoAlbum/Public/SysImg/beianbgs.png" width="20" height="20" id="beianbgs">粤公网安备&nbsp;<a href="javascript:void(0)">33010002000120号</a>
	</div>
</body>
</html>