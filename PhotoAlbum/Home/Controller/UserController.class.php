<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
	class UserController extends CommonOneController{
		protected $rules=array(
			array('uname','','用户名已存在',0,'unique',1),
			array('umail','','邮箱已被注册',0,'unique',1),
			array('umail','email','邮箱格式不合法',0)
		);
		public function index(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UserTB=D('User');
			$data=$UserTB->field("umail,upw")->create();
			if(!$data){
				$this->ajaxReturn($UserTB->getError());	//用户不存在
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
				session(null);
				session('uname',$lgselRst['uname']);
				session('uid',$lgselRst['uid']);
				session("isLogin","isLogin");
				session("lastLogin",time());
				session("myImg",$lgselRst['userImg']);
				$this->ajaxReturn(array('info'=>"right"));
			}elseif($lgselRst['upw']!=$data['upw']&&$lgselRst['status']==0){
				$lgLog['status']=1;
				$lgLogTb->table('uloginlog')->add($lgLog);
				$this->ajaxReturn(array('info'=>'err1'));	//密码错误
			}elseif($lgselRst['status']==1){
				$lgLogSel=$lgLogTb->table('uloginlog')->where("uid='%s' AND status=1",$lgselRst['uid'])->order('loginTime desc')->limit("1")->select();
				$timeLen=time()-$lgLogSel[0]['loginTime'];
				if($timeLen>=600&&$lgselRst['upw']==$data['upw']){
					session(null);
					session('uname',$lgselRst['uname']);
					session('uid',$lgselRst['uid']);
					session("isLogin","isLogin");
					session("lastLogin",time());
					session("myImg",$lgselRst['userImg']);
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
				$selRst['userImg']='./Public/SysImg/uimg.jpg';
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

		public function rgtHtml(){
			if(session("isLogin")=="isLogin"&&(session("lastLogin")>(time()-21600))){
				header("Location:/YunPhotoAlbum/");
				exit;
			}
			$this->display("registration");
		}

		public function sendMail(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$onlySend=trim(I('get.onlySend',""));
			if(empty($onlySend)||$onlySend!="os"){
				$data=$UTB->validate($this->rules)->field('umail')->create();
			}else{
				$data=$UTB->field('umail')->create();
			}
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$authcore=mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

			$content="【验证码】{$authcore},15分钟内有效";
			$rst=send_mail($data['umail'],"云相册验证码",$content);
			if($rst){
				$authcoreTmp=md5($data['umail'].$authcore);
				session("authcore",$authcoreTmp);
				session("authcoreTime",time());
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}

		public function testUname(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$data=$UTB->validate($this->rules)->field('uname')->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$this->ajaxReturn(array("info"=>"noExists"));
		}

		public function registration(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$data=$UTB->validate($this->rules)->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$authcore=md5($data['umail'].I('post.authcore','','trim'));
			$maxTimeLen=time()-session("authcoreTime");
			if($authcore!=session("authcore")||empty(session("authcore"))||$maxTimeLen>900){
				$this->ajaxReturn(array("authcore"=>"验证码错误"));
			}
			if(I("post.agreePro",'','trim')!="agree"){
				$this->ajaxReturn(array("agreePro"=>"error"));
			}
			$timeTmp=time();
			$data['uid']="u".$timeTmp.mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
			$data['rgstTime']=date("Y-m-d",$timeTmp);
			$data['status']=0;
			$rst=$UTB->field("uid,umail,uname,upw,rgstTime,status")->add($data);
			if($rst){
					session(null);
					session('uname',$data['uname']);
					session('uid',$data['uid']);
					session("isLogin","isLogin");
					session("lastLogin",$timeTmp);
					//session("userImg",$data['userImg']);
					$this->ajaxReturn(array("success"=>"success"));
			}
			$this->ajaxReturn(array("rgtAllErr"=>"注册失败"));
		}

		public function forgetPW1(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$data=$UTB->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$authcore=md5($data['umail'].I('post.authcore','','trim'));
			$maxTimeLen=time()-session("authcoreTime");
			if($authcore!=session("authcore")||empty(session("authcore"))||$maxTimeLen>900){
				$this->ajaxReturn(array("authcore"=>"验证码错误"));
			}
			session(null);
			$rst=$UTB->where("umail='%s'",$data['umail'])->save(array('upw'=>$data['upw']));
			if($rst!==FALSE){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}

		public function getQuestion(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$data=$UTB->field('umail')->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}

			$question=$UTB->field('uname,securityQst')->where("umail='%s'",$data['umail'])->find();

			if($question){
				$this->ajaxReturn($question);
			}else{
				$this->ajaxReturn(array("info"=>"该用户未注册"));
			}
		}

		public function forgetPW2(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D('User');
			$data=$UTB->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$isExists=$UTB->where("umail='%s' AND securityAsw='%s'",$data['umail'],$data['securityAsw'])->find();
			if($isExists){
				$rst=$UTB->where("umail='%s' AND securityAsw='%s'",$data['umail'],$data['securityAsw'])->save(array("upw"=>$data['upw']));
				if($rst!==FALSE){
					$this->ajaxReturn(array("info"=>"success"));
				}else{
					$this->ajaxReturn(array("info"=>"err2"));
				}
			}else{
				$this->ajaxReturn(array("info"=>"err1"));
			}
		}
		public function cgeMail(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D("User");
			$data=$UTB->field("upw,umail")->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$newMailAuthcore=md5($data['umail'].trim(I("post.newMailAuthcore","")));
			$authcore=session("authcore");
			$authcoreTime=session("authcoreTime");
			$timeNow=time()-900;
			if($newMailAuthcore!=$authcore||$authcoreTime<$timeNow){
				$this->ajaxReturn(array("info"=>"authcoreErr"));
			}
			session("authcore",null);
			session("authcoreTime",null);
			$uid=session("uid");
			$cgeRst=$UTB->where("uid='%s' AND upw='%s'",$uid,$data['upw'])->save(array("umail"=>$data['umail']));
			if($cgeRst===FALSE){
				$this->ajaxReturn(array("info"=>"error1"));
			}elseif($cgeRst>=1){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$this->ajaxReturn(array("info"=>"error2"));
			}
		}

		public function setQst(){
			if(!IS_AJAX){
				PHPerr();
			}
			$UTB=D("User");
			$data=$UTB->field("upw,securityQst,securityAsw")->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$uid=session("uid");
			$setQstRst=$UTB->where("uid='%s' AND upw='%s'",$uid,$data['upw'])->save(array("securityQst"=>$data['securityQst'],"securityAsw"=>$data['securityAsw']));
			if($setQstRst===FALSE){
				$this->ajaxReturn(array("info"=>"error1"));
			}elseif($setQstRst>=1){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$isPwErr=$UTB->where("uid='%s' AND upw='%s'",$uid,$data['upw'])->find();
				if(empty($isPwErr)){
					$this->ajaxReturn(array("info"=>"error2"));
				}
				$this->ajaxReturn(array("info"=>"success"));
			}
		}

		public function cgePw(){
			if(!IS_AJAX){
				exit("发生错误...");
			}
			$upw_ori=trim(I("inputupw",""));
			if(empty($upw_ori)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$upw_ori=myMD5($upw_ori);
			$UTB=D("User");
			$data=$UTB->field("upw,cmfMyNewPw")->create();
			if(!$data){
				$this->ajaxReturn($UTB->getError());
			}
			$uid=session("uid");
			$rst=$UTB->where("uid='%s' and upw='%s'",$uid,$upw_ori)->save(array("upw"=>$data['upw']));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			if($rst>=1){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$isPwErr=$UTB->where("uid='%s' and upw='%s'",$uid,$upw_ori)->find();
				if(empty($isPwErr)){
					$this->ajaxReturn(array("info"=>"pwErr"));
				}
				$this->ajaxReturn(array("info"=>"success"));
			}
		}
	}
?>