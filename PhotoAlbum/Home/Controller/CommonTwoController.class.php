<?php
namespace Home\Controller;
use Think\Controller;
	class CommonTwoController extends Controller{
		public function _initialize(){

		}
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>