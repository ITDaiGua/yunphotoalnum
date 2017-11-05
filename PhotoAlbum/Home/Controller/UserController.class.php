<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
	class UserController extends CommonOneController{
		public function index(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UserTB=D('User');
			$data=$UserTB->field("umail,upw")->create();
			if(!$data){
				exit;
			}
			$lgselRst=$UserTB->field("uid,uname,upw,umail,userImg,status")->where("umail='%s'",$data['umail'])->find();
			if(empty($lgselRst)){
				$this->ajaxReturn(array('info'=>'err0'));	//用户不存在
			}
			$lgLogTb=M();
			$lgLog['uid']=$lgselRst['uid'];
			$lgLog['loginIp']=get_client_ip();
			$lgLog['loginTime']=time();
			if($lgselRst['upw']==$data['upw']&&$lgselRst['status']==0){
				$lgLog['status']=0;
				$lgLogTb->table('uloginlog')->add($lgLog);
				session('uname',$lgselRst['uname']);
				session('uid',$lgselRst['uid']);
				session("isLogin","isLogin");
				session("lastLogin",time());
				session("userImg",$lgselRst['userImg']);
				$this->ajaxReturn(array('info'=>"right"));
			}elseif($lgselRst['upw']!=$data['upw']&&$lgselRst['status']==0){
				$lgLog['status']=1;
				$lgLogTb->table('uloginlog')->add($lgLog);
				$this->ajaxReturn(array('info'=>'err1'));	//密码错误
			}elseif($lgselRst['status']==1){
				$lgLogSel=$lgLogTb->table('uloginlog')->where("uid='%s' AND status=1",$lgselRst['uid'])->order('loginTime desc')->limit("1")->select();
				$timeLen=time()-$lgLogSel[0]['loginTime'];
				if($timeLen>=600&&$lgselRst['upw']==$data['upw']){
					session('uname',$lgselRst['uname']);
					session('uid',$lgselRst['uid']);
					session("isLogin","isLogin");
					session("lastLogin",time());
					session("userImg",$lgselRst['userImg']);
					$lgLog['status']=0;
					$lgLogTb->table('uloginlog')->add($lgLog);
					$UserTB->where("uid='%s'",$lgselRst['uid'])->save(array("status"=>0));
					$this->ajaxReturn(array('info'=>"right"));
				}elseif($timeLen<=600&&$lgselRst['upw']==$data['upw']){
					$timeLenM=ceil(date('i',$timeLenM));
					$this->ajaxReturn(array('info'=>'err2',"errorInfo"=>$timeLenM));	//账户被临时冻结
				}else{
					$lgLog['status']=1;
					$lgLogTb->table('uloginlog')->add($lgLog);
					$this->ajaxReturn(array('info'=>'err3'));	//密码错误
				}
			}elseif($lgselRst['status']==2){
				$this->ajaxReturn(array('info'=>'err4')); //账户被冻结
			}
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

		public function logout(){
			session(null);
			header("Location:".$_SERVER['HTTP_REFERER']);
		}

	}
?>