$(document).ready(function(){
	var explain;
	$(".tipoff,.collection,.swPHTop").hover(function(){
		explain=$(this).find(".explain");
		explain.stop(true,false).fadeIn(400).animate({left:"-100px"},{queue:false,duration:400});
	},function(){
		explain.stop(true,false).fadeOut(400).animate({left:"-120px"},{queue:false,duration:400});
	});
	var _allContent=$(".allContent");
	var _this;
	var _thisImg;
	_allContent.on("mouseenter",".imgDIV",function(){
		_this=$(this);
		_thisImg=_this.find("img");
		_thisImg.css({position:"absolute"}).stop(true,false).animate({width:"164px",height:"190px",margin:"-5px"});
	});
	_allContent.on("mouseleave",".imgDIV",function(){
		_thisImg.stop(true,false).animate({width:"154px",height:"180px",margin:0}).queue(function(next){
			_thisImg.css({position:"static"});
			next();
		});
	});
	var _taslctLayer=$(".taslctLayer");
	var _enlarge=$(".enlarge");
	var _enlargeImgDiv=$(".enlargeImgDiv");
	var _enlargeImg;
	var loading=$(".loading");
	$("#swSHClose").click(function(){
		_taslctLayer.hide();
		_enlarge.hide();
	});
	var angle=0;
	var _spImg=$(".spImg");
	var _spImgLen=_spImg.length-1;
	_allContent.on("click",".spImg",function(){
		loading.show();
		_this=$(this);
		var enlargeImg=new Image();
		enlargeImg.src=_this.find("img:not(.loadingGif)").attr("src");
		enlargeImg.id="T"+(new Date().getTime());
		_taslctLayer.show();
		_enlarge.show();
		if(enlargeImg.complete){
			loading.hide();
			_enlargeImgDiv.html(enlargeImg);
			_enlargeImg=$("#"+enlargeImg.id);
			angle=0;
		}
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
		$('body').animate({"scrollTop":0},200);
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
		}else if(id=="cmntsAreaBtt"){
			commentsArea.show();
			photosArea.hide();
		}
	});
});