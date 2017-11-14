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
		<img src="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg" class="uImg"><?php endif; ?>
</div>
<script type="text/javascript">
	$("#wannaLg").click(function(){
		login();
	});
</script>
<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/commonJs.js"></script>
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
				<a href="/YunPhotoAlbum/MyAlbum/index/">
					<li <?php echo ($init["styleLi2"]); ?>>我的相册</li>
				</a>
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
			fail("&#xe691;","出错啦~");
			setTimeout(function(){
				$(".errorORwarn").remove();
			},1500);
		});
	</script>
	<?php if($selRst != null): if(is_array($selRst)): foreach($selRst as $selKey=>$selVal): ?><a href="/YunPhotoAlbum/Index/showSH/sid/<?php echo ($selVal['sid']); ?>/" target="_blank" class="theA">
				<div class="shareAlbum" id="<?php echo ($selVal['sid']); ?>">
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
		
			<a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']-1); ?>/" id="lastPage">上一页</a>
		
		<?php if($init['page'] >= $init['lastpg']): ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']); ?>/" style="border-color:#00a2ff;color:#00a2ff;margin:0;"><?php echo ($init['page']); ?></a>
			<?php if($init['page']+5 > $init['totalPage']): $__FOR_START_23212__=$init['page']+1;$__FOR_END_23212__=$init['totalPage']+1;for($i=$__FOR_START_23212__;$i < $__FOR_END_23212__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_13173__=$init['page']+1;$__FOR_END_13173__=$init['page']+5;for($i=$__FOR_START_13173__;$i < $__FOR_END_13173__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
		<?php elseif($init['page'] < $init['lastpg']): ?>
			<?php if($init['page']-4 <= 0): $__FOR_START_16138__=1;$__FOR_END_16138__=$init['page'];for($i=$__FOR_START_16138__;$i < $__FOR_END_16138__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_4987__=$init['page']-4;$__FOR_END_4987__=$init['page'];for($i=$__FOR_START_4987__;$i < $__FOR_END_4987__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
			<a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']); ?>/" style="border-color:#00a2ff;color:#00a2ff;margin:0;"><?php echo ($init['page']); ?></a><?php endif; ?>
		
			<a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($init['page']+1); ?>/" id="nextPage">下一页</a>
		
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
	</script><?php endif; ?>


	<?php elseif($init['viewType'] == 'myAlbum'): ?>
		<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/MyAlbum.css">
<div class="shareDiv">
		<div class="shareDiv_head">共享相册<span id="shareDiv_close" title="关闭">&#xe601;</span></div>
		<form name="shareAlbum" method="post" id="shareAlbum">
			<dl>
				<dd>
					<span class="shareDiv_title"><font color="red">*</font>相册分类：</span>
					<select id="classSelect" name="sclass">
						<option>----请选择分类----</option>
					</select>
					<script type="text/javascript">
						var getClassURL="/YunPhotoAlbum/Public/Json/photoClassJson.json";
						var albumClass=$.getJSON(getClassURL,function(data){
							var classOption="";
							$.each(data,function(photoClass,childrenPC){
								classOption+="<option>";
								classOption+=photoClass;
								classOption+="</option>";
							});
							$("#classSelect").append(classOption);
						}).fail(function(){
							fail("&#xe613;","出错啦~");
						});
					</script>
					<span id="classSelectErr" class="shareDiv_error"></span>
				</dd>
				<dd>
					<span class="shareDiv_title"><font color="red">*</font>相册名：</span>
					<input type="text" name="sName" placeholder="共享相册名" maxlength="20" id="sName" class="shareDiv_input">
					<span id="sNameErr" class="shareDiv_error"></span>
				</dd>
				<dd>
					<span class="shareDiv_title">相册简介：</span>
					<textarea maxlength="200" placeholder="相册简介" id="prfile"></textarea>
					<span id="prfileErr" class="shareDiv_error"></span>
				</dd>
				<dd>
					<span class="shareDiv_title"><font color="red">*</font>关键词：</span>
					<input type="text" name="skey" placeholder="多个关键词用“;”隔开且不能有特殊字符" maxlength="20" id="skey" class="shareDiv_input" style="width:300px;">
					<span id="skeyErr" class="shareDiv_error"></span>
				</dd>
				<dd style="margin-top:25px;">
					<button id="shareBtt">立即共享</button><br/>
					<span id="shareAllErr" class="shareDiv_error"></span>
				</dd>
			</dl>
		</form>
</div>
<div id="cmfDelAlbum">
	<div id="cmfDelAlbum_head">删除相册</div>
	<form id="cmfDelAlbum_cnt" method="post">
		<input type="radio" name="baoliuImg" value="1" checked id="baoliu">
		<label for="baoliu">该相册中的图片移至默认相册</label><br/>
		<input type="radio" name="baoliuImg" value="1" id="delAll">
		<label for="delAll">同时删除相册中图片</label>
	</form>
	<div id="cmfDelAlbum_btt">
		<button id="cmfDel">删除</button>&nbsp;&nbsp;
		<button id="cmdCnl">取消</button>
	</div>
</div>
<div class="allContent">
	<div class="MyAlbum_menu">
		<a href="javascript:void(0);" id="MyAlbum_menu_a">新建相册</a>
		<a href="javascript:void(0);" id="MyAlbum_help">&#xe605;</a>
		<div id="MyAlbum_help_txt">
			1.点击相册可以查看具体图片;<br/>
			2.右击鼠标:<br/>
			&nbsp;&nbsp;a.删除相册;<br/>
			&nbsp;&nbsp;b.共享相册;<br/>
			&nbsp;&nbsp;c.更改相册名;
		</div>
	</div>
	<script type="text/javascript">
		$("#MyAlbum_help").hover(function(){
			$("#MyAlbum_help_txt").css({"display":"inline-block"});
		},function(){
			$("#MyAlbum_help_txt").hide();
		});
	</script>
	<a href="/YunPhotoAlbum/MyAlbum/showMyPhoto/p/pa001" id="pa001">
		<img src="/YunPhotoAlbum/Public/SysImg/folderDefault.png" class="MyAlbum_img">
		<div class="default">默认相册</div>
	</a>
	<?php if(is_array($rest)): foreach($rest as $key=>$v): ?><a href="/YunPhotoAlbum/MyAlbum/showMyPhoto/p/<?php echo ($v["PAId"]); ?>" id="<?php echo ($v["PAId"]); ?>" class="MyAlbum_a">
			<img src="/YunPhotoAlbum/Public/SysImg/folderImg2.png" class="MyAlbum_img">
			<div class="MyAlbum_txt" onclick="return false"><?php echo ($v["PAName"]); ?></div>
		</a><?php endforeach; endif; ?>
	<ul class="MyAlbumOpt" oncontextmenu="return false;">
		<li id="share">共享</li>
		<li id="rename">重命名</li>
		<li id="delete">删除</li>
	</ul>
	<script type="text/javascript">
		$(".MyAlbum_txt").each(function(){
			var txt=$(this).text();
			if(txt.length>8){
				var txt2=txt.substring(0,7)+"...";
				$(this).text(txt2);
				$(this).parent().attr("title",txt);
			}
		});
		var whichAlbum="";
		$("body").on("contextmenu",".MyAlbum_a",function(event){
			whichAlbum=this.id;
			if(whichAlbum.match("/^pat/")){
				whichAlbum="";
				return false;
			}
			var mouseX=event.pageX;
			var mouseY=event.pageY;
			$(".MyAlbumOpt").show().offset({left:mouseX,top:mouseY});
			$('body').bind('click',function(){
				$(".MyAlbumOpt").hide();
				$('body').unbind('click');
			});
			return false;
		});
		$("#rename").click(function(){
			if(whichAlbum==""){
				return false;
			}
			whichAlbum=$("#"+whichAlbum);
			var whichAlbumCnt=whichAlbum.attr("title");
			var whichAlbumTxt=whichAlbum.children(".MyAlbum_txt");
			if(whichAlbumTxt){
				whichAlbumTxt.text(whichAlbumCnt).prop("contenteditable",true);
			}else{
				whichAlbumTxt.prop("contenteditable",true);
			}
			selectAll(whichAlbumTxt);
		});
		$("#delete").click(function(){
			if(whichAlbum==""){
				return false;
			}
			$(".taslctLayer").show();
			$("#cmfDelAlbum").show();
		});
		$("#cmdCnl").click(function(){
			$("#cmfDelAlbum_cnt").get(0).reset();
			$(".taslctLayer").hide();
			$("#cmfDelAlbum").hide();
		});
		$("#cmfDel").click(function(){
			if(whichAlbum==""){
				return false;
			}
			var checkedId=$("input[type='radio']:checked").attr("id");
			var myAlbumdel_obj=$("#"+whichAlbum);
			var myAlbumId=myAlbumdel_obj.attr("id");
			myAlbumdel_obj.hide();
			var delURL="";
			if(checkedId=="delAll"){
				delURL="/YunPhotoAlbum/MyAlbum/delAll/t/"+$.now();
			}else{
				delURL="/YunPhotoAlbum/MyAlbum/baoliu/t/"+$.now();
			}
			$.post(delURL,{"myAlbumId":myAlbumId},function(data){
				switch(data.info){
					case 'noLogin':login();myAlbumdel_obj.show();break;
					case 'success':fail("&#xe687;","删除成功");myAlbumdel_obj.remove();$(".taslctLayer").hide();$("#cmfDelAlbum").hide();break;
					default:fail("&#xe613;","出错啦~");myAlbumdel_obj.show();
				}
			}).fail(function(){
				myAlbumdel_obj.show();
				fail("&#xe613;","出错啦~");
			});
		});
		var album='<a class="MyAlbum_a"><img src="/YunPhotoAlbum/Public/SysImg/folderImg2.png" class="MyAlbum_img"><div class="MyAlbum_txt" onclick="return false">未命名</div></a>';
		var canCreate=true;
		$("#MyAlbum_menu_a").click(function(){
			if(!canCreate){
				fail("&#xe687;","等会儿才能再创建");
				return false;
			}
			canCreate=false;
			var paid="pat"+$.now();
			$(".allContent").append($(album).attr("id",paid));
			var createURL="/YunPhotoAlbum/MyAlbum/createAlbum/t/"+$.now();
			var album_href="/YunPhotoAlbum/MyAlbum/showMyPhoto/p/";
			$.post(createURL,null,function(data){
				switch(data.info){
					case "noLogin":login();canCreate=true;break;
					case "success":$("#"+paid).attr({
						"href":album_href+data.paid,
						"id":data.paid
					});break;
					default:fail("&#xe613;","出错啦~");$("#"+paid).remove();canCreate=true;break;
				}
			}).fail(function(){
				fail("&#xe613;","出错啦~");
				$("#"+paid).remove();
				canCreate=true;
			});
			setTimeout(function(){
				canCreate=true;
			},2000);
		});
		$("#share").click(function(){
			if(whichAlbum==""){
				return false;
			}
			whichAlbum=$("#"+whichAlbum);
			var albumName=whichAlbum.attr("title");
			if(!albumName){
				albumName=whichAlbum.children(".MyAlbum_txt").text();
			}
			$("#sName").val(albumName);
			$(".taslctLayer").show();
			$(".shareDiv").show();
		});
		$("#shareDiv_close").click(function(){
			$(".shareDiv").hide();
			$(".taslctLayer").hide();
			$("#shareAlbum").get(0).reset();
			$(".shareDiv_error").html("");
		});
		var canShare=true;
		$("#shareAlbum").on("submit",function(event){
			event.preventDefault();
			var isTrueTmp=true;
			if(!canShare){
				return false;
			}
			var className=$.trim($("#classSelect option:selected").text());
			if(className=="----请选择分类----"){
				$("#classSelectErr").html("&#xe601;必须选择分类");
				isTrueTmp=isTrueTmp&false;
			}else{
				$("#classSelectErr").html("");
				isTrueTmp=isTrueTmp&true;
			}
			isTrueTmp=isTrueTmp&isNotBlank("#sName")&isNotBlank("#skey");
			if(!isTrueTmp){
				return false;
			}
			isTrueTmp=false;
		});
	</script>
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/textOpt.js"></script>
</div><?php endif; ?>
	<div id="endInfo">
		增值电信业务经营许可证:&nbsp;<a href="javascript:void(0)">粤B2-20110446</a>&nbsp;网络文化经营许可证:&nbsp;<a href="javascript:void(0)">粤网文[2015]0295-065号</a>&nbsp;<a href="javascript:void(0)">12318举报</a><br>互联网药品信息服务资质证书编号:&nbsp;<a href="javascript:void(0)">粤-（经营性）-2017-0005</a>&nbsp;&nbsp;<img src="/YunPhotoAlbum/Public/SysImg/beianbgs.png" width="20" height="20" id="beianbgs">粤公网安备&nbsp;<a href="javascript:void(0)">33010002000120号</a>
	</div>
</body>
</html>