$(document).ready(function(){
	$(".fgtPwMenu li").on('click',function(event){
		$(".choseOnOpt").removeClass('choseOnOpt');
		$(this).addClass("choseOnOpt");
		var id=this.id;
		switch(id){
			case 'byMail':
				$("#fgtForm2").hide();
				$("#fgtForm1").show();
				break;
			case 'byQuestion':
				$("#fgtForm1").hide();
				$("#fgtForm2").show();
				break;
		}
	});
});