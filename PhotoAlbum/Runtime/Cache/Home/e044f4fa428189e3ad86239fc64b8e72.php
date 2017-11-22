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
		<img src="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg" class="uImg">
		<script type="text/javascript">
			$("#wannaLg").click(function(){
				login();
			});
		</script><?php endif; ?>
</div>
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
		<?php if($init['viewType'] == 'shareFolders'): ?><form name="seachForm" action="<?php echo ($init["searchURL"]); ?>" method="post" id="seachForm">
				<input type="text" name="condition" id="seach" placeholder="<?php echo ($init["placeholder"]); ?>" autocomplete="off">
				<input type="submit" class="iconfont" value="&#xe61e;" id="seachbtt">
			</form><?php endif; ?>
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
			<?php if($init['page']+5 > $init['totalPage']): $__FOR_START_31127__=$init['page']+1;$__FOR_END_31127__=$init['totalPage']+1;for($i=$__FOR_START_31127__;$i < $__FOR_END_31127__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_30596__=$init['page']+1;$__FOR_END_30596__=$init['page']+5;for($i=$__FOR_START_30596__;$i < $__FOR_END_30596__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
		<?php elseif($init['page'] < $init['lastpg']): ?>
			<?php if($init['page']-4 <= 0): $__FOR_START_19309__=1;$__FOR_END_19309__=$init['page'];for($i=$__FOR_START_19309__;$i < $__FOR_END_19309__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } ?>
			<?php else: ?>
				<?php $__FOR_START_930__=$init['page']-4;$__FOR_END_930__=$init['page'];for($i=$__FOR_START_930__;$i < $__FOR_END_930__;$i+=1){ ?><a href="/YunPhotoAlbum/Index/index/condition/<?php echo ($init['condition']); ?>/lastpg/<?php echo ($init['page']); ?>/page/<?php echo ($i); ?>/"><?php echo ($i); ?></a><?php } endif; ?>
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
					<input type="text" name="sName" placeholder="共享相册名" maxlength="20" id="sName" class="shareDiv_input" autocomplete="off">
					<span id="sNameErr" class="shareDiv_error"></span>
				</dd>
				<dd>
					<span class="shareDiv_title"><font color="red">*</font>相册简介：</span>
					<textarea maxlength="200" placeholder="相册简介" id="profile" name="profile"></textarea>
					<span id="profileErr" class="shareDiv_error"></span>
				</dd>
				<dd>
					<span class="shareDiv_title"><font color="red">*</font>关键词：</span>
					<input type="text" name="skey" placeholder="多个关键词用“;”隔开且不能有特殊字符" maxlength="20" autocomplete="off" id="skey" class="shareDiv_input" style="width:300px;">
					<span id="skeyErr" class="shareDiv_error"></span>
				</dd>
				<dd style="margin-top:25px;">
					<button id="shareBtt">立即共享</button><br/>
					<span id="shareAllErr" class="shareDiv_error"></span>
				</dd>
				<input type="hidden" name="PAId" id="PAId"  autocomplete="off">
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
			$("#PAId").val(whichAlbum);
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
			var profileLen=$.trim($("#profile").val()).length;
			if(profileLen<=0){
				isTrueTmp=isTrueTmp&false;
				$("#profileErr").html("&#xe601;不能为空");
			}else if(profileLen<=20){
				isTrueTmp=isTrueTmp&false;
				$("#profileErr").html("&#xe601;不能少于20个字符");
			}else{
				isTrueTmp=isTrueTmp&true;
				$("#profileErr").html("");
			}
			if(!isTrueTmp){
				return false;
			}
			isTrueTmp=false;
			var shareURL="/YunPhotoAlbum/Sharepa/index/t/"+$.now();
			$.post(shareURL,$("#shareAlbum").serialize(),function(data){
				switch(data.info){
					case 'noLogin':$("#shareDiv_close").trigger('click');login();break;
					case "success":fail("&#xe687;","共享成功");$("#shareDiv_close").trigger('click');isTrueTmp=true;break;
					case "error1":fail("&#xe613;","相册中没有图片");isTrueTmp=true;break;
					case "error2":$("#shareDiv_close").trigger('click');fail("&#xe613;","不能重复共享");isTrueTmp=true;break;
					case "error":
					default:fail("&#xe613;","出错啦~");isTrueTmp=true;
				}
			}).fail(function(){
				fail("&#xe613;","出错啦~");
				isTrueTmp=true;
			});
		});
	</script>
	<script type="text/javascript" src="/YunPhotoAlbum/Public/JS/textOpt.js"></script>
</div>
	<?php elseif($init['viewType'] == 'photo'): ?>
		<script type="text/javascript">
	var moveHtml="";
	(function(){
		var getMyAlbumURL="/YunPhotoAlbum/MyAlbum/getMyAlbum/t/"+$.now();
		$.post(getMyAlbumURL,function(data){
			$.each(data,function(k,v){
				moveHtml+='<div class="albumDiv">';
				moveHtml+='<img src="/YunPhotoAlbum/Public/SysImg/folderImg.png" class="albumImg">';
				moveHtml+='<label class="albumName" for="'+v.PAId+'">';
				moveHtml+=v.PAName+'</label>';
				moveHtml+='<input type="radio" name="album" id="'+v.PAId+'" class="albumRadio">';
				moveHtml+='<div class="selOn"></div></div>';
			});
			$(document).ready(function(){
				$("#albums").append(moveHtml);
			});
		}).fail(function(){
			fail("&#xe613;","出错啦~");
		});
	})();
</script>
<link rel="stylesheet" type="text/css" href="/YunPhotoAlbum/Public/CSS/photo.css">
<div id="selMoveAlbum">
	<div id="selMovAlm-title">
		选择相册<span id="selMovAlm-help">&#xe605;</span>
		<span id="help-cont">滑动鼠标中间键可获取更多相册</span>
		<span id="selMovAlm-close">&#xe601;</span>
	</div>
	<div id="albums">
		<div class="albumDiv">
			<img src="/YunPhotoAlbum/Public/SysImg/folderDefault.png" class="albumImg">
			<label class="albumName" for="pa001"><b>默认相册</b></label> 
			<input type="radio" name="album" id="pa001" class="albumRadio">
			<div class="selOn"></div>
		</div>
	</div>
	<button id="moveNow">确定移动</button>
</div>
<div id="myPhotoOptWarn">
	<div id="optWarnTitle">
		<span id="warnTitleImg">&#xe691;</span>提示
	</div>
	<div id="optWarnCont">操作不可逆!!</div>
	<div id="optWarnBtt">
		<button id="IKnow">我知道了!</button>
		<button id="ICancle">取消</button>
	</div>
</div>
<div id="uploadAll">
	<div class="uploadDiv">
		<input type="file" name="uploadPhoto" id="uploadPhoto" title="上传图片" accept="image/png,image/gif,image/jpeg,image/jpg,image/png">&#xe78c;
	</div>
</div>
<div class="allContent" id="<?php echo ($PAId); ?>" style="font-size:0">
	<div id="myPhotoOpt">
		<a href="javascript:void(0)" id="batchOpt">
			<span style="margin-right:5px">&#xe60e;</span>批量操作
		</a>
		<ul id="batchOptUl" onselectstart="return false;">
			<li id="batchSel" class="batchOptLi"><span style="margin-right:5px">&#xe670;</span>全选</li>
			<li id="batchNotSel" class="batchOptLi"><span style="margin-right:5px">&#xe703;</span>全不选</li>
			<li id="batchDel" class="batchOptLi"><span style="margin-right:5px">&#xe634;</span>批量删除</li>
			<li id="batchMove" class="batchOptLi"><span style="margin-right:5px">&#xe660;</span>批量移动</li>
			<li id="optCancle" class="batchOptLi"><span style="margin-right:5px">&#xe710;</span>取消</li>
		</ul>
		<img src="/YunPhotoAlbum/Public/SysImg/loading2.gif" ondragstart="return false;" id="btcOptLoading">
		<a href="javascript:void(0)" id="uploadImg">
				<span style="margin-right:5px">&#xe66f;</span>上传图片
		</a>
		<span id="myPhotoOptErr"></span>
	</div>
	<?php if(is_array($photos)): foreach($photos as $key=>$v): ?><div class="myPhoto" onselectstart="return false;">
			<div class="checkboxDiv">
				<input type="checkbox" id="<?php echo ($v["pid"]); ?>" class="checkbox">
				<label for="<?php echo ($v["pid"]); ?>" class="checkboxLb" title="选择"></label>
			</div>
			<img src="<?php echo ($v["PLink"]); ?>/w/159/h/180/">
			<ul class="phImg_opt" onselectstart="return false;">
				<li class="delImg" title="删除" id="pid-<?php echo ($v["pid"]); ?>">&#xe634;</li>
				<li class="moveImg" title="移动到其他相册" id="id-<?php echo ($v["pid"]); ?>">&#xe660;</li>
			</ul>
		</div><?php endforeach; endif; ?>
</div>
<script type="text/javascript">
	$(".allContent").on("mouseenter",".myPhoto",function(event){
		var del=$(this).find(".phImg_opt");
		del.stop(true,false).animate({bottom:0},200,"linear");
		$(this).on("mouseleave",function(){
			del.stop(true,false).animate({bottom:"-30px"},200,"linear");
		});
	});
	$(".allContent").on("mouseenter",".checkboxDiv",function(event){
		return false;
	});
	$("#batchOpt").click(function(){
		$(this).hide();
		$("#uploadImg").hide();
		$("#batchOptUl").css({display:"inline-block"});
		$(".checkboxDiv").show();
	});
	$("#batchSel").click(function(){
		$(".checkbox").prop("checked",true);
	});
	$("#batchNotSel").click(function(){
		$(".checkbox").prop("checked",false);
	});
	$("#optCancle").click(function(){
		$("#batchOptUl").hide();
		$("#batchOpt").show();
		$("#uploadImg").show();
		$(".checkboxDiv").hide();
		$("#myPhotoOptErr").text("").hide();
		$(".checkbox").prop("checked",false);
	});
	var canBatchDel=true;	//防止重复点击
	var cmfDel=true;		//防止重复提交
	$("#batchDel").click(function(){
		if(!canBatchDel){return false;}
		var sel_checked=$(".checkbox:checked");
		if(!checkTest(sel_checked)){return false;}
		canBatchDel=false;
		$(".taslctLayer").show();
		$("#myPhotoOptWarn").show();
	});
	$("#ICancle").click(function(){
		$("#myPhotoOptWarn").hide();
		$(".taslctLayer").hide();
		$("#optCancle").trigger("click");
		canBatchDel=true;
		cmfDel=true;
	});
	var batchDelURL="/YunPhotoAlbum/MyAlbum/deletePh/t/"+$.now();
	$("#IKnow").click(function(){
		$("#myPhotoOptWarn").hide();
		$(".taslctLayer").hide();
		$("#btcOptLoading").show();
		if(!cmfDel){
			return false;
		}
		var selector=$(".checkbox:checked");
		var pids=parsePid(selector);
		if(!pids){
			$("#ICancle").trigger("click");
			$("#btcOptLoading").hide();
			fail("&#xe613;","出错啦~");
			return false;
		}
		cmfDel=false;
		var delImgs=selector.parents(".myPhoto");
		delImgs.hide();
		$.post(batchDelURL,{"pids":pids},function(data){
			switch(data.info){
				case "noLogin":
					delImgs.show();
					login();break;
				case "success":
					fail("&#xe687;","删除成功");
					delImgs.remove();break;
				case "error":
				default:delImgs.show();
				fail("&#xe613;","出错啦~");
			}
			cmfDel=true;
			$("#ICancle").trigger("click");
			$("#btcOptLoading").hide();
		}).fail(function(){
			$("#ICancle").trigger("click");
			$("#btcOptLoading").hide();
			cmfDel=true;
			delImgs.show();
			fail("&#xe613;","出错啦~");
		});
	});

	var movePids="";
	var movePhotoId="";
	$("#batchMove").click(function(){
		var sel_checked=$(".checkbox:checked");
		if(!checkTest(sel_checked)){return false;}
		$(".taslctLayer").show();
		$("#selMoveAlbum").show();
		var selector=$(".checkbox:checked");
		movePids=parsePid(selector);
		movePhotoId=selector.parents(".myPhoto");
	});

	$(".allContent").on("click",".moveImg",function(){
		movePids=(this.id).split("-")[1];
		movePhotoId=$(this).parents(".myPhoto");
		$(".taslctLayer").show();
		$("#selMoveAlbum").show();
	});
	var canBatchMove=true;
	var moveURL="/YunPhotoAlbum/MyAlbum/movePhoto/t/"+$.now();
	$("#moveNow").click(function(){
		if(!canBatchMove||movePids==""||movePhotoId==""){return false;}
		var paid=$(".albumRadio:checked").attr("id");
		if(!paid){
			fail("&#xe691;","请选择相册");
			return false;
		}
		canBatchMove=false;
		var btcOptLoading=$("#btcOptLoading");
		btcOptLoading.show();
		movePhotoId.hide();
		$.post(moveURL,{"paid":paid,"pids":movePids},function(data){
			switch(data.info){
				case "noLogin":movePhotoId.show();login();break;
				case "success":movePhotoId.remove();fail("&#xe687;","移动成功");break;
				case "error":
				default:movePhotoId.show();fail("&#xe613;","出错啦~");break;
			}
			$("#selMovAlm-close").trigger("click");
			btcOptLoading.hide();
		}).fail(function(){
			$("#selMovAlm-close").trigger("click");
			btcOptLoading.hide();
			movePhotoId.show();
			fail("&#xe613;","出错啦~");
		});
	});

	$("#selMovAlm-help").on("mouseenter",function(){
		var helpCont=$("#help-cont");
		helpCont.css("display","inline-block");
		$(this).on("mouseleave",function(){
			helpCont.hide();
		});
	});
	$("#selMovAlm-close").click(function(){
		$("#selMoveAlbum").hide();
		$(".taslctLayer").hide();
		$(".albumRadio").prop("checked",false);
		$("#optCancle").trigger("click");
		canBatchMove=true;
	});

	var canDel=true;
	$(".allContent").on("click",".delImg",function(event){
		if(!canDel){
			return false;
		}
		canDel=false;
		var pid=(this.id).split("-")[1];
		var delImg=$(this).parents(".myPhoto");
		delImg.hide();
		$.post(batchDelURL,{"pids":pid},function(data){
			switch(data.info){
				case "noLogin":delImg.show();login();break;
				case "success":delImg.remove();fail("&#xe687;","删除成功");break;
				case "error":
				default:delImg.show();fail("&#xe613;","出错啦~");
			}
			canDel=true;
		}).fail(function(){
			delImg.show();
			canDel=true;
			fail("&#xe613;","出错啦~");
		});
	});

	var albumsObj=$("#albums");
	var isCanScroll=true;
	$("#selMoveAlbum").on("mousewheel DOMMouseScroll",function(event){
		if(!isCanScroll){return false;}
		event.preventDefault();
		event=event.originalEvent;
		var direction=(event.wheelDelta&&(event.wheelDelta>0?1:-1))||(event.detail&&(event.detail>0?-1:1));
		if(direction>0){
			albumsObj.stop(true,false).animate({"scrollTop":"-=80px"},100,"linear",function(){
				isCanScroll=true;
			});
		}else{
			albumsObj.stop(true,false).animate({"scrollTop":"+=80px"},100,"linear",function(){
				isCanScroll=true;
			});
		}
	});

	function checkTest(selector){
		var selLen=selector.length;
		var myPhotoOptErr=$("#myPhotoOptErr");
		if(selLen<=0){
			myPhotoOptErr.text("没有选择的内容").show();
			return false;
		}
		myPhotoOptErr.hide();
		return true;
	}

	function parsePid(selector){		//解析图片的pid
		var pids="";
		if(selector.length<=0){
			return "";
		}
		selector.each(function(){
			pids+=this.id+",";
		});
		return pids;
	}

	$("#uploadPhoto").change(function(){
		var txt=$.trim($(this).val());
		if(txt==""){return false}
	});
</script><?php endif; ?>
	<div id="endInfo">
		增值电信业务经营许可证:&nbsp;<a href="javascript:void(0)">粤B2-20110446</a>&nbsp;网络文化经营许可证:&nbsp;<a href="javascript:void(0)">粤网文[2015]0295-065号</a>&nbsp;<a href="javascript:void(0)">12318举报</a><br>互联网药品信息服务资质证书编号:&nbsp;<a href="javascript:void(0)">粤-（经营性）-2017-0005</a>&nbsp;&nbsp;<img src="/YunPhotoAlbum/Public/SysImg/beianbgs.png" width="20" height="20" id="beianbgs">粤公网安备&nbsp;<a href="javascript:void(0)">33010002000120号</a>
	</div>
</body>
</html>