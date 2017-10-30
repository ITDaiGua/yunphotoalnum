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
		<link rel="stylesheet" href="/YunPhotoAlbum/Public/kindeditor/themes/default/default.css" />
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery-3.1.1.min.js"></script>
		<!--[if lte IE 8]>
			<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/jquery.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/showPH.js"></script>
		<script charset="utf-8" src="/YunPhotoAlbum/Public/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="/YunPhotoAlbum/Public/kindeditor/lang/zh_CN.js"></script>
	</head>
	<body>
		<div class="enlarge" onselectstart="return false">
			<div class="noMore"></div>
			<div class="enlargeOpt">
				<ul>
					<li title="向左旋转" id="rotateLft">&#xe644;</li>
					<li title="向右旋转" id="rotateRgt">&#xe642;</li>
					<li title="上一张" id="goPrev">&#xe600;</li>
					<li title="下一张" id="goNext">&#xe602;</li>
					<li title="关闭窗口" id="swSHClose">&#xe601;</li>
				</ul>
			</div>
			<div class="enlargeImgDiv">
				<span class="loading"><img src="/YunPhotoAlbum/Public/SysImg/loading.gif" class="loadingGif"></span>
			</div>
		</div>
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
		<?php if($selSPRst != ''): ?><div class="iconfont rightOpt">
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
			</div><?php endif; ?>
		<div class="allContent" id="<?php echo ($selSPRst[0]['sid']); ?>">
			<?php if($selSPRst == ''): ?><div class="nothing"></div>
			<?php else: ?>
				<?php if(is_array($selSPRst)): foreach($selSPRst as $key=>$value): ?><div class="showPhHead">
					<div class="shareUInfo">
						<a href="">
							<img src="/YunPhotoAlbum/Public/UserImg/<?php echo ($value['uid']); ?>.jpg" class="swPHUImg">
							<span class="authorName"><?php echo ($value['authorName']); ?></span>
						</a>
					</div>
					<div class="PATitle">
						<div class="titleDIV">
							<?php echo ($value['sName']); ?>
						</div>
						<div class="SPinfo">
							<span class="iconfont">&#xe60b; <?php echo ($value['lookSum']); ?></span>
							<span class="iconfont">&#xe61f; <?php echo ($value['likeSum']); ?></span>
							<span class="iconfont"><span style="font-size:18px;">&#xe617;</span> <?php echo ($value['cltSum']); ?></span>
							<span class="iconfont">&#xe63a; <?php echo ($value['shareTime']); ?></span>
						</div>
					</div>
					</div>
					<div class="hr"></div>
					<div class="shwProfile">
						<span>相册简介：</span><br/>&nbsp;&nbsp;<?php echo ($value['profile']); ?>
					</div><?php endforeach; endif; ?>
				<div class="choice" onselectstart="return false;">
					<ul>
						<li class="choiceOn Li" id="ptsAreaBtt">图片区</li>
						<li class="Li" id="cmntsAreaBtt">评论区</li>
						<li class="Li" id="likeBtt">赞 <span class="iconfont">&#xe615;</span></li>
					</ul>
				</div>
				<div id="commentsArea">
					<div id="cmntBoxDiv">
						<?php if($isLogin != 'isLogin'): ?><div id="canotCmnt">登陆后可评论</div><?php endif; ?>
						<form name="cmetForm" id="cmetForm" method="post">
							<textarea name="cmntBox" id="cmntBox"></textarea>
							<span id="strLenWarn">字数：<span id="cmntStrLen">0</span>/140<span id="showWarn"> 超过限定字数</span></span>
							<input type="submit" name="cmntBtt" id="cmntBtt" value="评论" /> 
						</form>
					</div>
					<script type="text/javascript">
						var isCanCount=true;
						var cmntStrLen=$("#cmntStrLen");
						var showWarn=$("#showWarn");
						var sid=$(".allContent").attr("id");
						KindEditor.ready(function(K) {
							var editor1 = K.create('#cmntBox', {
								width:"600px",
								height:"100px",
								allowFileManager : false,
								filterMode:false,
								resizeType:0,
								pasteType:1,
								allowImageRemote:false,
								allowImageUpload:false,
								items:["undo","|","redo","|","emoticons","|","link","|","unlink"],
								afterChange:function(){
									var strLen=this.count('text');
									cmntStrLen.text(strLen);
									if(isCanCount){
										isCanCount=false;
										setTimeout(function(){
     									isCanCount=true;
     								},200);
										if(strLen>140){
											showWarn.show();
											var strValue = this.text();
     									strValue = strValue.substring(0,140);
     									this.html("").appendHtml(strValue);
										}else{
											showWarn.hide();
										}
									}
									this.sync();
								}
							});
							var isCanCmt=true;
							$("#cmetForm").on("submit",function(event){
								event.preventDefault();
								if(editor1.isEmpty()){
									showWarn.text('评论不能为空').show();
									return false;
								}else{
									showWarn.hide().text('超过限定字数');
								}
								if(!isCanCmt){
									return false;
								}else{
									isCanCmt=false;
								}
								var commentCont=editor1.text();
								commentCont=commentCont.replace(/[\s]+/g," ");
								var url="/YunPhotoAlbum/AjaxOpt/comment/";
								$.post(url,{"sid":sid,"comment":commentCont},function(data){
									if(data.info=="success"){
										var _success="<div class='errorORwarn' style='background-color:#fff'><span class='iconfont errorORwarnImg'>&#xe687;</span>评论成功</div>";
										$('body').prepend(_success);
										setTimeout(function(){
											location.reload();
										},1500);
									}
								}).fail(function(){
									var _fail="<div class='errorORwarn'><span class='iconfont errorORwarnImg'>&#xe613;</span>评论失败</div>";
										$('body').prepend(_fail);
										setTimeout(function(){
											$(".errorORwarn").hide().remove();
											//location.reload();
										},1500);
										isCanCmt=true;
								});
							});
						});
					</script>
				</div>
				<div id="photosArea">
					<?php if(is_array($selRst)): foreach($selRst as $key=>$value): ?><div class="spImg" id="<?php echo ($value['pid']); ?>">
							<div class="imgDIV">
								<img src="<?php echo ($value['spLink']); ?>">
							</div>
							<span><?php echo ($value['PName']); ?></span>
						</div><?php endforeach; endif; ?>
				</div>
				<div class="gtMreLodg">
					<img src="/YunPhotoAlbum/Public/SysImg/loading.gif" class="loadingGif2">
				</div>
				<div id="getMorePhDiv" class="getMoreDiv">
					<button id="getMorePh" class="getMore">获取更多&#xe6b9;</button>
				</div>
				<div id="getMoreCmtDiv" class="getMoreDiv" style="display:none;">
					<button id="getMoreCmt" class="getMore">获取更多&#xe6b9;</button>
				</div><?php endif; ?>
		</div>
	</body>
</html>