<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class UserCenterController extends CommonTwoController{
		public function index(){
			$uid=session("uid");
			$style1="style=background-color:#f68017";
			$init=array(
				'title'=>"个人中心",
				'uid'=>$uid,
				'style1'=>$style1,
				'viewType'=>'myInfo'
			);
			$userTB=M("user");
			$rst=$userTB->where("uid='%s'",$uid)->field("umail,uname,autonym,usex,birthday,profile,userImg,rgstTime")->find();
			foreach ($rst as $key => $value) {
				switch($key){
					case 'autonym':
					case 'usex':
					case 'birthday':
						if(empty($value)||$value=="0000-00-00"){
							$rst[$key]="-";
						} break;
					case 'profile':
						if(empty($value)){
							$rst[$key]="您还没有填写简介！";
						} break;
					case 'userImg':
						if(!empty($value)){
							$rst[$key]=$rst[$key]."/w/164/h/190";
						}else{
							$rst[$key]="/YunPhotoAlbum/Public/SysImg/uimg.jpg";
						} break;
				}
			}
			$this->assign("init",$init);
			$this->assign("userInfo",$rst);
			$this->display();
		}

		public function uploadUserImg(){
			if(!IS_AJAX){
				exit("发生错误...");
			}
			$uid=session("uid");
			$upload = new \Think\Upload();
			$upload->maxSize = 2097152 ;
			$upload->exts = array('jpg','png','jpeg');
			$upload->replace=true;
			$upload->rootPath="./";
			$upload->savePath = 'Public/';
			$upload->subName = "UserImg/";
			$upload->saveName = $uid;
			$info = $upload->upload();
			if(!$info) { 
				$this->ajaxReturn($upload->getError());
			}else{ 
				$UTB=M("user");
				$userImgURL="/YunPhotoAlbum/Index/thumb1/p/UserImg/fn/{$uid}/t/jpg";
				$saveRst=$UTB->where("uid='%s'",$uid)->save(array("userImg"=>$userImgURL));
				if($saveRst===FALSE){
					$this->ajaxReturn(array("info"=>"error1"));
				}
				$this->ajaxReturn(array("info"=>"success"));
			}
		}

		public function infoChange(){
			if(!IS_AJAX){
				exit("发生错误...");
			}
			$data['profile']=trim(I("get.profile",""));
			$data['autonym']=trim(I("get.autonym",""));
			$data['usex']=trim(I("get.usex",""));
			$data['birthday']=trim(I("get.birthday",""));
			if(!empty($data['birthday'])){
				$data['birthday']=str_replace("/","-",$data['birthday']);
				if(!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/',$data['birthday'])){
					$data['birthday']="";
				}
			}
			$uid=session("uid");
			$UTB=M("user");
			$rst=$UTB->where("uid='%s'",$uid)->field("profile,autonym,usex,birthday")->save($data);
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}else{
				$this->ajaxReturn(array("info"=>"success"));
			}
		}
		public function getInfo(){
			$uid=session("uid");
			$infoTB=M("info");
			$rst=$infoTB->field("iid,title,publishTime,status")->order("publishTime desc")->where("uid='%s'",$uid)->limit("0,50")->select();
			foreach ($rst as $key => $value) {
			 $rst[$key]['publishTime']=date("Y-m-d H:i:s",$rst[$key]['publishTime']);
			}
			$style2="style=background-color:#f68017";
			$init=array(
				'title'=>"消息查看",
				'uid'=>$uid,
				'style2'=>$style2,
				'viewType'=>'getInfo'
			);
			$this->assign("init",$init);
			$this->assign("infos",$rst);
			$this->display("UserCenter/index");
		}

		public function showCont(){
			if(!IS_AJAX){
				exit("发生错误...");
			}
			$uid=session("uid");
			$iid=trim(I("get.iid",""));
			if(empty($iid)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$infoTB=M("info");
			$rst=$infoTB->where("iid='%s' AND uid='%s'",$iid,$uid)->field("content")->find();
			$infoTB->where("iid='%s' AND uid='%s'",$iid,$uid)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			if(empty($rst)){
				$this->ajaxReturn(array("info"=>"error2","content"=>"没有消息"));
			}
			$this->ajaxReturn(array("info"=>"success","content"=>$rst['content']));
		}

		public function cgeMyPw(){
			$style3="style=background-color:#f68017";
			$init=array(
				'title'=>"消息查看",
				'uid'=>$uid,
				'style3'=>$style3,
				'viewType'=>'cgeMyPw'
			);
			$this->assign("init",$init);
			$this->display("UserCenter/index");
		}
	}
?>