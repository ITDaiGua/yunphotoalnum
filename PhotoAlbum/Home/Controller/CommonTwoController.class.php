<?php
namespace Home\Controller;
use Think\Controller;
	class CommonTwoController extends Controller{
		public function _initialize(){
			ini_set("session.gc_maxlifetime",21600);
			if(session("isLogin")=="isLogin"){
				$lastLogin=session("lastLogin");
				if($lastLogin!=""&&$lastLogin>(time()-21600)){
					session("lastLogin",time());
					$myImg=session("myImg");
					if(empty($myImg)){
						$myImg="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg";
					}else{
						$myImg=$myImg."/w/35/h/35";
					}
					$this->assign("userName",session("uname"));
					$this->assign("uImg",$myImg);
					$this->assign("isLogin","isLogin");
				}else{
					session(null);
					$this->assign("isLogin","noLogin");
					if(IS_AJAX){
						$this->ajaxReturn(array("info"=>"noLogin"));
					}else{
						header("Location:/YunPhotoAlbum/");
					}
				}
			}else{
				//session(null);
				$this->assign("isLogin","noLogin");
				if(IS_AJAX){
					$this->ajaxReturn(array("info"=>"noLogin"));
				}else{
					header("Location:/YunPhotoAlbum/");
				}
			}
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>