$(document).ready(function(){
	$(".hisshareNm").each(function(){
		var _this=$(this);
		var txt=_this.text();
		if(txt.length>10){
			var tmpTxt=txt.substring(0,8)+"...";
			_this.text(tmpTxt);
			_this.parent('a').attr('title',txt);
		}
	});
	var page=1;
	var uid=$(".allContent").attr("id");
	var url="/YunPhotoAlbum/User/gmAuthorInfo";
	var isCanOpt=true;	//节流
	var canopt=true;	//判断是否否数据
	var moreSH="";
	$(document).on('scroll',function(){
		if(!canopt){
			clearInterval(timer);
		}
		if(!isCanOpt||!canopt){
			return false;
		}
		isCanOpt=false;
		timer=setInterval(function(){
			isCanOpt=true;
		},150);
		var bodyHeight=$('body,html').height();
		var allContentHgt=$(window).height()+$(window).scrollTop();
		if(bodyHeight<=allContentHgt){
			page++;
			$.post(url,{uid:uid,page:page},function(data){
				if(data==null){
					canopt=false;
					$(".loadingai").text('没有更多啦~').css({"borderTop":"1px solid #757575","color":"#828282"}).show();
					return false;
				}else if(data.info=="error"){
					fail("&#xe613;","出错啦~");
					return false;
				}
				$.each(data,function(k,v){
					moreSH+="<a href='/YunPhotoAlbum/Index/showSH/sid/"+v.sid+"/' class='hisshare'>";
					moreSH+='<img src="/YunPhotoAlbum/Public/SysImg/folderImg2.png">';
					moreSH+='<span class="hisshareNm">'+v.sName+'</span>';
					moreSH+='</a>';
				});
				$(".shareDiv").append(moreSH);
				moreSH="";
			}).fail(function(){
				fail("&#xe613;","出错啦~");
			});
		}
	});
});
/*function fail(img,info){
	var _fail="<div class='errorORwarn'><span class='iconfont errorORwarnImg'>"+img+"</span>"+info+"</div>";
	$('body').prepend(_fail);
	setTimeout(function(){
		$(".errorORwarn").hide().remove();
	},1500);
}*/