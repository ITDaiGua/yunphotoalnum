$(document).ready(function(){
	var explain;
	$(".tipoff,.collection,.swPHTop").hover(function(){
		explain=$(this).find(".explain");
		explain.stop(true,false).fadeIn(400).animate({left:"-100px"},{queue:false,duration:400});
	},function(){
		explain.stop(true,false).fadeOut(400).animate({left:"-120px"},{queue:false,duration:400});
	});
});