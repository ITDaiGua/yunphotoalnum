$(document).ready(function(){
	$("#logo img").on("dragstart",function(event){
		event.preventDefault();
	});
	$("#seachForm").on("mouseover",function(){
		$(this).find("#seach").get(0).focus();
	});
});