function selectAll(selector) {
	selector.get(0).focus();
	document.execCommand('selectAll',false,null);
}
var ori_val="";
$("body").on({
	"keydown":function(event){
		var val=$(this).text();
		var which=event.which;
		if(val.length>=20&&which!==8){
			return false;
		}
		switch(which){
			case 9:
			case 13:return false;break;
		}
	},
	"focus":function(){
		ori_val=$.trim($(this).text());
	},
	"blur":function(){
		var val=$.trim($(this).text().replace(/\s{2,}/g," "));
		$(this).prop("contenteditable",false);
		var val2=val;
		var len=val.length;
		if(len>8){
			if(len>20){
				val=val.substring(0,20);
			}
			$(this).parent().attr("title",val);
			val2=val.substring(0,7)+"...";
		}else if(len<=0){
			val2="未命名";
		}
		$(this).text(val2);
		if(ori_val!=val){
			var id=$(this).parent('a').attr("id");
			if(id.match(/^pat/)){
				return false;
			}
			var ajaxData={"id":id,"paname":val};
			$.post("/YunPhotoAlbum/MyAlbum/changeName/t/"+$.now(),ajaxData,function(data){
				switch(data.info){
					case 'noLogin':login();break;
					case 'error':fail("&#xe613;","出错啦~");break;
				}
			}).fail(function(){
				fail("&#xe613;","出错啦~");
			});
		}
	},
	"contextmenu":function(event){
		var isTrue=$(this).prop("contenteditable");
		if(isTrue!="true"){
			event.preventDefault();
		}else{
			event.stopPropagation();
		}
	},
	"paste":function(event){
		event.preventDefault();
		var clipboard=getclipboard(event);
		var text=clipboard.getData("Text");
		document.execCommand("insertText",false,text);
	}
},".MyAlbum_txt");
function getclipboard(event){
	var clipboard="";
	if(window.clipboardData){
		clipboard=window.clipboardData; 
	}else{
		clipboard=event.originalEvent.clipboardData;
	}
	return clipboard;
}