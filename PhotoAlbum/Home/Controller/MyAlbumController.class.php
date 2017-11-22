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
			if(empty($data['PAName'])){
				$data['PAName']="未命名";
			}
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
				$this->ajaxReturn(array("info"=>"error"));
			}
			$UTB=D("MyAlbum");
			$rst=$UTB->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$UTBPhoto=M();
			$rst2=$UTBPhoto->table('photo')->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst2===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
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
				$this->ajaxReturn(array("info"=>"error"));
			}
			$UTB=D("MyAlbum");
			$rst=$UTB->where("uid='%s' AND PAId='%s'",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$UTBPhoto=M();
			$rst2=$UTBPhoto->table('photo')->where("uid='%s' AND PAId='%s'",$data)->save(array("PAId"=>"pa001"));
			if($rst2===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}
		
		public function showMyPhoto(){
			$PAId=trim(I("get.p",""));
			$uid=session("uid");
			if(empty($PAId)||!preg_match('/^pa[0-9]{1,15}$/',$PAId)||empty($uid)){
				PHPerr();
			}
			$UTB=M("photo");
			$rst=$UTB->where("uid='%s' AND PAId='%s' AND status=0",$uid,$PAId)->select();
			$init=array(
				"viewType"=>"photo",
				"title"=>"查看相册",
				"PAId"=>$PAId
			);
			$this->assign("init",$init);
			$this->assign("photos",$rst);
			$this->display("CommonView/index");
		}

		public function deletePh(){
			if(!IS_AJAX){
				PHPerr();
			}
			$pids=trim(I("post.pids",""));
			$uid=session("uid");
			if(empty($pids)||empty($uid)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$pids=rtrim($pids,",");
			$UTB2=M("sharephoto");
			$data2['pid']=array("in",$pids);
			$rst2=$UTB2->where($data2)->save(array("status"=>1));
			if($rst2===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data["pid&uid"]=array(
				array("in",$pids),
				$uid,
				'_multi'=>true
			);
			$UTB=M("photo");
			$rst=$UTB->where($data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}

		public function getMyAlbum(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('MyAlbum');
			$uid=session("uid");
			$rst=$UTB->field("PAId,PAName,status")->where("uid='%s' AND status=0",$uid)->select();
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}else{
				$this->ajaxReturn($rst);
			}
			//print_r($rst);
		}

		public function movePhoto(){
			if(!IS_AJAX){
				PHPerr();
			}
			$PAId=trim(I("post.paid",""));
			$pids=trim(I("post.pids",""));
			$pids=rtrim($pids,",");
			$uid=session("uid");
			if(empty($PAId)||empty($pids)||empty($uid)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data["uid&pid"]=array(
				$uid,
				array("in",$pids),
				"_multi"=>true
			);
			$UTB=M('photo');
			$rst=$UTB->where($data)->save(array("PAId"=>$PAId));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}

		public function searchMyPhoto(){

		}
	}
?>