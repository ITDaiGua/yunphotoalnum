<?php
namespace Home\Controller;
use Think\Controller;
	class CommonTwoController extends Controller{
		public function _initialize(){
			if(session("isLogin")!=="isLogin"){
				$this->ajaxReturn(array("info"=>"noLogin"));
			}
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>