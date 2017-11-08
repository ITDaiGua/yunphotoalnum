<?php
namespace Home\Controller;
use Think\Controller;
	class CommonOneController extends Controller{
		public function _initialize(){
			ini_set("session.gc_maxlifetime",21600);
			if(session("isLogin")=="isLogin"){
				$lastLogin=session("lastLogin");
				if($lastLogin!=""&&$lastLogin>(time()-21600)){
					session("lastLogin",time());
					$userImg=session("userImg");
					if(empty($userImg)){
						$userImg="/YunPhotoAlbum/Public/SysImg/smalluimg.jpg";
					}else{
						$userImg=$userImg+"/w/35/h/35";
					}
					$this->assign("userName",session("uname"));
					$this->assign("uImg",$userImg);
					$this->assign("isLogin","isLogin");
				}else{
					session(null);
					$this->assign("isLogin","noLogin");
				}
			}else{
				session(null);
				$this->assign("isLogin","noLogin");
			}
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>