<?php
namespace Home\Controller;
use Think\Controller;
	class CommonOneController extends Controller{
		public function _initialize(){
			$this->assign("isLogin","isLogin");
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>