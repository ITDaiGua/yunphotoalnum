<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
	class UserController extends CommonOneController{
		public function index(){

		}

		public function authorInfo(){
			$uid=I("get.uid",'',"trim");
			if(empty($uid)){
				PHPerr();
			}
			$UserTB=D('User');
			$selRst=$UserTB->field('uid,uname,autonym,usex,profile,userImg,rgstTime,status')->where("uid='%s'",$uid)->find();
			if(empty($selRst['autonym'])){
				$selRst['autonym']="-";
			}
			if(empty($selRst['profile'])){
				$selRst['profile']="作者没有填写简介哦~";
			}
			if(empty($selRst['userImg'])){
				$selRst['userImg']='./Public/SysImg/noAuth.png';
			}
			$getHisShareTb=M();
			$getHisShare=$getHisShareTb->table('sharepa')->field("sid,uid,sName,status")->where("uid='%s' AND status=0",$uid)->page("1,28")->select();
			if(empty($getHisShare)){
				$this->assign('hisshare',"nothing");
			}else{
				$this->assign('hisshare',$getHisShare);
			}
			$this->assign('selRst',$selRst);
			$this->display();
		}

		public function gmAuthorInfo(){
			if(!IS_AJAX){
				PHPerr();
			}
			$uid=I("post.uid","","trim");
			if(empty($uid)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$page=I("post.page","2","trim");
			$page=numCheck2($page,2);
			$getHisShareTb=M();
			$getHisShare=$getHisShareTb->table('sharepa')->field("sid,uid,sName,status")->where("uid='%s' AND status=0",$uid)->page("$page,28")->select();
			$this->ajaxReturn($getHisShare);
		}

	}
?>