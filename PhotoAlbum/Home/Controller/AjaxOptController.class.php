<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class AjaxOptController extends CommonTwoController{
		public function comment(){
			if(!IS_AJAX){
				PHPerr();
			}
			$commentTB=M();
			$data['content']=trim(I("post.comment"));
			$data['sid']=trim(I('post.sid'));
			if(empty($data['content'])||empty($data['sid'])){
				PHPerr();
			}
			$data['cid']="c".$_SERVER['REQUEST_TIME'].mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
			$data['time']=$_SERVER['REQUEST_TIME'];
			$data['uname']=session("uname");
			$data['status']=0;
			$data['tipOffSum']=0;
			$data['isIgnore']=0;
			$rst=$commentTB->table('comments')->add($data);
			if($rst){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}
		
		public function cmtTipoff(){
			if(!IS_AJAX){
				PHPerr();
			}
			$cid=trim(I("post.cid"));
			if(empty($cid)){
				PHPerr();
			}
			$cmtTipoffTB=M();
			if(!cookie("$cid")){
				$cmtTipoffTB->table('comments')->where("cid='%s'",$cid)->setInc('tipOffSum');
				cookie($cid,1,time()+31536000);
			}else{
				cookie($cid,1,time()+31536000);
				$this->ajaxReturn(array("info"=>"exists"));
			}
			
		}

		public function like(){
			if(!IS_AJAX){
				PHPerr();
			}
			$sid=trim(I("post.sid"));
			if(empty($sid)){
				PHPerr();
			}
			$uid=trim(session("uid"));
			$likeCkKey=md5($sid.$uid);
			if(cookie("$likeCkKey")){
				cookie($likeCkKey,1,time()+31536000);
				$this->ajaxReturn(array("info"=>"exists"));
			}else{
				$likeTB=M();
				$selRst=$likeTB->table("like")->where("sid='%s' AND uid='%s'",$sid,$uid)->select();
				if(empty($selRst)){	
					$likeTB->table("sharepa")->where("sid='%s'",$sid)->setInc('likeSum');
					$data['sid']=$sid;
					$data['uid']=$uid;
					$data['likeTime']=time();
					$rst=$likeTB->table("like")->add($data);
					if($rst){
						cookie($likeCkKey,1,time()+31536000);
						$this->ajaxReturn(array("info"=>"success"));
					}else{
						$this->ajaxReturn(array("info"=>"error"));
					}
					
				}else{
					cookie($likeCkKey,1,time()+31536000);
					$this->ajaxReturn(array("info"=>"exists"));
				}
			}
		}

		public function collection(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['sid']=trim(I("post.sid"));
			if(empty($data['sid'])){
				PHPerr();
			}
			$data['uid']=trim(session("uid"));
			$data['cltId']="clt".time().mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
			$data['cltTime']=time();
			$data['status']=0;
			$UTB=M('sharepa');
			$isMyShare=$UTB->where("sid='%s' AND uid='%s'",$data['sid'],$data['uid'])->find();
			if(!empty($isMyShare)){
				$this->ajaxReturn(array("info"=>"error1"));
			}
			$cltTB=M("collection");
			$selRst=$cltTB->where("sid='%s' AND uid='%s' AND status=0",$data['sid'],$data['uid'])->find();
			$rst='';
			if(empty($selRst)){
				$rst=$cltTB->table("collection")->field('cltId,uid,sid,cltTime,status')->add($data,$options=array(),$replace=true);
			}else{
				$cltTime=time();
				$rst=$cltTB->table("collection")->where("sid='%s' AND uid='%s'",$data['sid'],$data['uid'])->save(array("cltTime"=>$cltTime));
			}
			if($rst){
				$this->ajaxReturn(array("info"=>"success"));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}

		public function ajaxUpload1(){
			if(!IS_AJAX){
				PHPerr();
			}
			$sid=trim(I('get.sid'));
			if(empty($sid)){
				PHPerr();
			}
			$uid=trim(session("uid"));
			$spatipoffTB=M();
			$selRst=$spatipoffTB->table('spatipoff')->where("sid='%s' AND uid='%s'",$sid,$uid)->cache(true,120)->find();
			if(!empty($selRst)){
				$this->ajaxReturn(array("info"=>"exists"));
			}
			$upload = new \Think\Upload();
			$upload->maxSize = 1048576 ;
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath="./";
			$upload->savePath = 'Public/tipoffImg/';
			$upload->subName = session("uid");
			$filename="tpi".time();
			$upload->saveName = $filename;
			$info = $upload->upload();
			if(!$info) { 
				$this->ajaxReturn(array("info"=>"error"));
			}else{ 
				$this->ajaxReturn(array("info"=>"success","subdir"=>$uid,"filename"=>$filename));
			}
		}

		public function tipiff(){
			if(!IS_AJAX){
				PHPerr();
			}
			$data['sid']=trim(I('post.sid'));
			$data['uid']=session('uid');
			$data['style']=trim(I('post.tipoffType'));
			$data['tpContactWay']=trim(I('post.tpContactWay'));
			$data['tpexplain']=trim(I('post.tptextarea'));
			$data['tpImgs']=trim(I('post.imgsSrc'));
			$data['tpImgs']=str_ireplace("thumb1","thumbAuth",$data['tpImgs']);
			$isFalse=empty($data['sid'])||empty($data['style'])||empty($data['tpContactWay'])||empty($data['tpexplain']);
			if($isFalse){
				PHPerr();
			}
			$cookieKey=md5($data['sid'].$data['uid']."rst");
			$data['stfId']='stf'.time().mt_rand(0,9).mt_rand(0,9);
			$data['TipOffTime']=time();
			$spatipoffTB=M();
			if(cookie("$cookieKey")){
				cookie($likeCkKey,1,time()+31536000);
				$this->ajaxReturn(array("info"=>"exists"));
			}else{
				$selRst=$spatipoffTB->table('spatipoff')->where("sid='%s' AND uid='%s'",$data['sid'],$data['uid'])->find();
				if(!empty($selRst)){
					cookie($likeCkKey,1,time()+31536000);
					$this->ajaxReturn(array("info"=>"exists"));
				}
			}
			$rst=$spatipoffTB->table('spatipoff')->field('stfId,sid,uid,style,tpContactWay,tpexplain,tpImgs,status')->add($data);
			if($rst){
				cookie($likeCkKey,1,time()+31536000);
				$this->ajaxReturn(array("info"=>'success'));
			}else{
				$this->ajaxReturn(array("info"=>'error'));
			}
		}
	}
?>