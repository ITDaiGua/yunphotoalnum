<?php
namespace Home\Controller;
use Think\Controller;
	class CommonOneController extends Controller{
		public function _initialize(){
			$this->assign("isLogin","isLogin");
			session('uid','u145678945123458');
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>