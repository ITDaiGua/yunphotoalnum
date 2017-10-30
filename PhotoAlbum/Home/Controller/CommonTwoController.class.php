<?php
namespace Home\Controller;
use Think\Controller;
	class CommonTwoController extends Controller{
		public function _initialize(){
			session("uname","编程");
			session('uid','u145678945123458');
		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>