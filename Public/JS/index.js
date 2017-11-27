$(document).ready(function(){
	$("#logo img").on("dragstart",function(event){
		event.preventDefault();
	});
	$("#seachForm").on("mouseover",function(){
		$(this).find("#seach").get(0).focus();
	});
	var seach=$("#seach");
	var canSeach=true;
	$("#seachForm").on("submit",function(){
		if(canSeach){
			canSeach=false;
			setTimeout(function(){
				canSeach=true;
			},1500);
			if(!$.trim(seach.val())){
				return false;
			}
		}else{
			return false;
		}
	});
});