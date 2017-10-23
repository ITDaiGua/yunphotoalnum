<?php
namespace Home\Controller;
use Think\Controller;
	class EmptyController extends Controller{
		public function _empty($name){
			header("Location:/YunPhotoAlbum/");
		}
		public function index(){
			header("Location:/YunPhotoAlbum/");
		}
	}
?>