<?php
namespace Home\Controller;
use Think\Controller;
	class CommonOneController extends Controller{
		public function _initialize(){
			//session(null);
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>