
$(document).ready(function(){
	var explain="";
	$(".tipoff,.collection,.swPHTop").hover(function(){
		explain=$(this).find(".explain");
		explain.stop(true,false).fadeIn(400).animate({left:"-100px"},{queue:false,duration:400});
	},function(){
		explain.stop(true,false).fadeOut(400).animate({left:"-120px"},{queue:false,duration:400});
	});
	var _allContent=$(".allContent");
	var _this="";
	var _thisImg="";
	_allContent.on("mouseenter",".imgDIV",function(){
		_this=$(this);
		_thisImg=_this.find("img");
		_thisImg.css({position:"absolute"}).stop(true,false).animate({width:"164px",height:"190px",margin:"-5px"});
		_allContent.on("mouseleave",".imgDIV",function(){
			_thisImg.stop(true,false).animate({width:"154px",height:"180px",margin:0}).queue(function(next){
				_thisImg.css({position:"static"});
				next();
			});
		});
	});
	
	var _taslctLayer=$(".taslctLayer");
	var _enlarge=$(".enlarge");
	var _enlargeImgDiv=$(".enlargeImgDiv");
	var _enlargeImg;
	var loading=$(".loading");
	var date_Obj=new Date();
	$("#swSHClose").click(function(){
		_taslctLayer.hide();
		_enlarge.hide();
	});
	var angle=0;
	var _spImg="";
	var _spImgLen=0;
	var enlargeImg=new Image();
	_allContent.on("click",".spImg",function(){
		_spImg=$(".spImg");
		_spImgLen=_spImg.length-1;
		loading.show();
		_this=$(this);
		var tmpSrc_ei=_this.find("img:not(.loadingGif)").attr("src").replace("thumbAuth","originImg");
		enlargeImg.src=tmpSrc_ei;
		enlargeImg.id="T"+date_Obj.getTime();
		_taslctLayer.show();
		_enlarge.show();
		$(enlargeImg).hide();
		_enlargeImgDiv.append(enlargeImg);
		$("#"+enlargeImg.id).on("load",function(){
			loading.hide();
			$(enlargeImg).show();
			_enlargeImg=$("#"+enlargeImg.id);
			angle=0;
		});
	});
	$("#rotateLft").on("click",function(){
		angle-=90;
		_enlargeImg.css({"transform":"rotate("+angle+"deg)"});
	});
	$("#rotateRgt").on("click",function(){
		angle+=90;
		_enlargeImg.css({"transform":"rotate("+angle+"deg)"});
	});
	var isCanGo=true;
	var noMore=$(".noMore");
	var timer="";
	var $goPrev=$("#goPrev");
	var $goNext=$("#goNext");
	$goPrev.on("click",function(){
		var index=_spImg.index(_this);
		if(index<=0){
			isCanGo=false;
		}else{
			isCanGo=true;
		}
		if(!isCanGo){
			clearInterval(timer);
			noMore.text("没有啦~").show();
			timer=setTimeout(function(){
				noMore.hide();
			},1000);
			return false;
		}
		_this.prev().trigger('click');
	});
	$goNext.on("click",function(){
		var index=_spImg.index(_this);
		if(index>=_spImgLen){
			isCanGo=false;
		}else{
			isCanGo=true;
		}
		if(!isCanGo){
			clearInterval(timer);
			noMore.text("最后一张啦~").show();
			timer=setTimeout(function(){
				noMore.hide();
			},1000);
			return false;
		}
		_this.next().trigger('click');
	});
	var isCanScroll=true;
	$(".enlarge").on("DOMMouseScroll mousewheel",function(event){
		event.preventDefault();
		if(!isCanScroll){
			return false;
		}
		isCanScroll=false;
		setTimeout(function(){isCanScroll=true;},400);
		event=event.originalEvent;
		var direction=(event.wheelDelta&&(event.wheelDelta<0?-1:1))||(event.detail&&(event.detail<0?1:-1));
		if(direction<0){
			$goNext.trigger('click');
		}else{
			$goPrev.trigger('click');
		}
	});

	$(".swPHTop").click(function(){
		$('body,html').animate({"scrollTop":0},200);
	});

	var commentsArea=$("#commentsArea");
	var photosArea=$("#photosArea");
	$(".Li").click(function(event){
		var id=event.target.id;
		if(id=="ptsAreaBtt"||id=="cmntsAreaBtt"){
			$(".choiceOn").removeClass("choiceOn");
			$(this).addClass("choiceOn");
		}
		if(id=="ptsAreaBtt"){
			commentsArea.hide();
			photosArea.show();
			$("#getMoreCmtDiv").hide();
			$("#getMorePhDiv").show();
		}else if(id=="cmntsAreaBtt"){
			commentsArea.show();
			photosArea.hide();
			$("#getMorePhDiv").hide();
			$("#getMoreCmtDiv").show();
			var cmtDivLen=$(this).children(".cmtDiv").length;
			if(cmtDivLen<=0){
				$("#getMoreCmt").trigger('click');
			}
		}
	});

	var sid=$(".allContent").attr("id");
	$("#likeBtt").one('click',function(){
		var likeURL="/YunPhotoAlbum/AjaxOpt/like";
		$.post(likeURL,{sid:sid},function(data){
			if(data.info=="noLogin"){

			}else if(data.info=="success"){
				fail("&#xe687;","点赞成功");
			}else if(data.info=="exists"){
				fail("&#xe687;","赞过啦~");
			}else{
				fail("&#xe613;","出错啦~");
			}
		}).fail(function(){
			fail("&#xe613;","出错啦~");
		});
	});

	var url="/YunPhotoAlbum/Index/showMoreSH/sid/"+sid;
	var page=1;
	var canGetMore=true; //节流
	var isCanGetMore=true;	//判断有没有更多的数据
	var morePH="";
	var _photosArea=$("#photosArea");
	$("#getMorePh").on("click",function(){
		if(canGetMore&&isCanGetMore){
			$(".gtMreLodg").show();
			canGetMore=false;
				page++;
				$.get(url,{page:page},function(data){
					if(data==null){
						isCanGetMore=false;
						$("#getMorePh").prop("disabled",true).text("没有更多啦~");
						$(".gtMreLodg").hide();
					}else{
						$.each(data,function(k,v){
							morePH+='<div class="spImg" id="'+v.pid+'">';
							morePH+='<div class="imgDIV">';
							morePH+='<img src="'+v.spLink+'"></div>';
							morePH+='<span>'+v.PName+'</span></div>';
						});
						$(".gtMreLodg").hide();
						_photosArea.append(morePH);
						morePH="";
					}
				}).fail(function(){
					$(".gtMreLodg").hide();
					fail("&#xe613;","出错啦~");
				});
				setTimeout(function(){canGetMore=true;},1000);
		}
	});

	var url2="/YunPhotoAlbum/AjaxOpt/getComment/sid/"+sid;
	var page2=0;
	var canGetMore2=true; //节流
	var isCanGetMore2=true;	//判断有没有更多的数据
	var morePH2="";
	var _commentsArea=$("#commentsArea");
	var cmtTipoffURL="/YunPhotoAlbum/AjaxOpt/cmtTipoff";
	$("#getMoreCmt").on("click",function(){
		if(canGetMore2&&isCanGetMore2){
			$(".gtMreLodg").show();
			canGetMore2=false;
				page2++;
				$.get(url2,{page:page2},function(data){
					if(data==null){
						isCanGetMore2=false;
						if(page2==1){
							$("#getMoreCmt").hide();
							_commentsArea.append($("<div class=noCmt></div>"));
						}else{
							$("#getMoreCmt").prop("disabled",true).text("没有更多啦~");
						}
						$(".gtMreLodg").hide();
					}else{
						$.each(data,function(k,v){
							morePH2+="<div class='cmtDiv' id="+v.cid+">";
							morePH2+="<div class='cmtHead'>"+v.uname;
							morePH2+="<span class='cmtTime'>"+v.time+"</span></div>";
							morePH2+="<div class='cmtCont'>&nbsp;&nbsp;"+v.content+"</div>";
							morePH2+="<div class='cmtTipoff'><span class='cmtTxt'>举报</span></div>";
							morePH2+="</div>";
						});
						$(".gtMreLodg").hide();
						_commentsArea.append(morePH2);
						morePH2="";
						$(".cmtTxt").one('click',function(){
							var cid=$(this).parents(".cmtDiv").attr('id');
							$.post(cmtTipoffURL,{cid:cid},function(data){
								if(data.info=="noLogin"){

								}else if(data.info=="exists"){
									fail("&#xe613;","举报过啦~");
								}else{
									fail("&#xe687;","感谢您的反馈");
								}
							}).fail(function(){
								fail("&#xe613;","出错啦~");
							});
						});
					}	
				}).fail(function(){
					$(".gtMreLodg").hide();
					fail("&#xe613;","出错啦~");
				});
				setTimeout(function(){canGetMore2=true;},1000);
		}
	});

	function fail(img,info){
		var _fail="<div class='errorORwarn'><span class='iconfont errorORwarnImg'>"+img+"</span>"+info+"</div>";
		$('body').prepend(_fail);
		setTimeout(function(){
			$(".errorORwarn").hide().remove();
		},1500);
	}

	var cmtTipoff="";
	_commentsArea.on("mouseenter",".cmtDiv",function(){
		cmtTipoff=$(this).children(".cmtTipoff");
		cmtTipoff.css("color","#3b3b3b");
	});

	_commentsArea.on("mouseleave",".cmtDiv",function(){
		cmtTipoff.css("color","transparent");
	});

	$(".collection").one('click',function(){
		var cltURL="/YunPhotoAlbum/AjaxOpt/collection";
		$.post(cltURL,{sid:sid},function(data){
			if(data.info='success'){
				fail("&#xe687;","收藏成功");
			}else if(data.info=="noLogin"){

			}else{
				fail("&#xe613;","出错啦~");
			}
		});
	});

	var canTipoff=true;
	$(".tipoff").on("click",function(){
		if($(".tipoffHtml").length>0){
			$(".taslctLayer").show();
			$(".tipoffHtml").show();
			return false;
		}
		if(!canTipoff){
			return false;
		}
		canTipoff=false;
		$("<link>").attr({
			rel:"stylesheet",
			type:"text/css",
			href:"/YunPhotoAlbum/Public/CSS/spatipoff.css"
		}).appendTo('head');
		$("body").prepend($('<div class="tipoffHtml"></div>'));
		$('.tipoffHtml').load("/YunPhotoAlbum/Public/TPL/spatipoff.html",function(){
			$(".taslctLayer").show();
		});
	});

});
