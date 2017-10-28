<?php
namespace Home\Controller;
use Think\Controller;
	class CommonTwoController extends Controller{
		public function _initialize(){
			session("uname","编程");
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>