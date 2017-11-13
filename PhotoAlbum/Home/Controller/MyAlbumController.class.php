<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class MyAlbumController extends CommonTwoController{
		public function index(){
			$UTB=D("MyAlbum");
			$uid=session("uid");
			$styleLi2="style='background-color:#00a2ff;color:#fff;'";
			$rest=$UTB->where("uid='%s' AND status=0",$uid)->select();
			$init=array(
				"title"=>"我的相册",
				"styleLi2"=>$styleLi2,
				"viewType"=>"myAlbum",
				"searchURL"=>"/YunPhotoAlbum/MyAlbum/searchMyPhoto/",
				"placeholder"=>"搜索我的图片"
			);
			$this->assign("init",$init);
			$this->assign("rest",$rest);
			$this->display('/CommonView/Index');
		}

		public function createAlbum(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['uid']=session("uid");
			$data['PAId']="pa".time().mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
			$data['PAName']='未命名';
			$data['status']=0;
			$UTB=D("MyAlbum");
			$rst=$UTB->add($data);
			if($rst){
				$this->ajaxReturn(array("info"=>"success","paid"=>$data['PAId']));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}

		public function changeName(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['uid']=session("uid");
			$data['PAId']=I("post.id","","trim");
			if(empty($data['PAId'])){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data['PAName']=I("post.paname","未命名","trim");
			$data['PAName'].preg_grep('/[\s]/g'," ");
			$UTB=D("MyAlbum");
			$rst=$UTB->where("uid='%s' AND PAId='%s'",$data['uid'],$data['PAId'])->save(array("PAName"=>$data['PAName']));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}else{
				$this->ajaxReturn(array("info"=>"success"));
			}
		}

		public function delAll(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['uid']=session("uid");
			$data['PAId']=I('post.myAlbumId',"");
			if(empty($data['PAId'])){
				$this->ajaxReturn(array("info"=>"error4"));
			}
			$UTB=D("MyAlbum");
			$rst=$UTB->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error5"));
			}
			$UTBPhoto=M();
			$rst2=$UTBPhoto->table('photo')->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst2===FALSE){
				$this->ajaxReturn(array("info"=>"error6"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}

		public function baoliu(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['uid']=session("uid");
			$data['PAId']=I('post.myAlbumId',"");
			if(empty($data['PAId'])){
				$this->ajaxReturn(array("info"=>"error1"));
			}
			$UTB=D("MyAlbum");
			$rst=$UTB->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error2"));
			}
			$UTBPhoto=M();
			$rst2=$UTBPhoto->table('photo')->where("uid='%s' AND PAId='%s'",$data)->save(array("PAId"=>"pa001"));
			if($rst2===FALSE){
				$this->ajaxReturn(array("info"=>"error3"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}

		public function searchMyPhoto(){

		}

		public function showMyPhoto(){

		}

	}
?>