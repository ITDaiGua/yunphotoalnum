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
			$commentTB->table('comments')->add($data);
			$this->ajaxReturn(array("info"=>"success"));
		}

		public function getComment(){
			if(!IS_AJAX){
				PHPerr();
			}
			$sid=trim(I('get.sid'));
			$page=trim(I('get.page'));
			if(empty($sid)||empty($page)){
				PHPerr();
			}
			$page=numCheck2($page,1);
			$commentTB=M();
			$selRst=$commentTB->field("cid,sid,uname,content,time,status")->table("comments")->where("sid='%s' AND status=0",$sid)->order("time desc")->page("$page,30")->select();
			$selRst=$this->timeFmtCge($selRst);
			$this->ajaxReturn($selRst);
		}

		private function timeFmtCge($selRst){
	        $timeNow=time();
	        $yesterday=date("Ymd",strtotime('-1 day'));
	        $justNow=60; //如果$shareTime-$timeNow<=60,则改为“刚刚”
	        $dividend=60; 
	        /*
	        *如果($shareTime-$timeNow)/$dividend>1,则改为“xx分钟前”,大于等于60小于120一个小时前,以此类推，大于等于1440即第二天直接记录时间;
	        */
	        foreach ($selRst as $key => $value) {
	          $selRst[$key]['content']=htmlspecialchars_decode($value['content']);
	          $time=$value['time'];
	          if(date("Ymd",$time)==$yesterday){
	            $selRst[$key]['time']="昨天";
	            continue;
	          }
	          $tempTime1=$timeNow-$time;
	          if($tempTime1<=$justNow){
	            $selRst[$key]['time']="刚刚";
	            continue;
	          }
	          $tempTime2=($timeNow-$time)/$dividend;
	          if($tempTime2<60){
	            $selRst[$key]['time']=floor($tempTime2)."分钟前";
	          }elseif($tempTime2<1440){
	            $selRst[$key]['time']=floor($tempTime2/60)."小时前";
	          }else{
	            $selRst[$key]['time']=date("Y年m月d日",$time);
	          }
	        }
	        return $selRst;
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
				$this->ajaxReturn(array("info"=>"exists"));
			}else{
				$likeTB=M();
				$selRst=$likeTB->table("like")->where("sid='%s' AND uid='%s'",$sid,$uid)->select();
				if(empty($selRst)){	
					$likeTB->table("sharepa")->where("sid='%s'",$sid)->setInc('likeSum');
					$data['sid']=$sid;
					$data['uid']=$uid;
					$data['likeTime']=time();
					$likeTB->table("like")->add($data);
					cookie($likeCkKey,1,time()+31536000);
					$this->ajaxReturn(array("info"=>"success"));
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
			$cltTB=M();
			$selRst=$cltTB->table("collection")->where("sid='%s' AND uid='%s' AND status=0",$data['sid'],$data['uid'])->select();
			if(empty($selRst)){
				$cltTB->table("collection")->field('cltId,uid,sid,cltTime,status')->add($data,$options=array(),$replace=true);
			}else{
				$cltTime=time();
				$cltTB->table("collection")->where("sid='%s' AND uid='%s'",$data['sid'],$data['uid'])->save(array("cltTime"=>$cltTime));
			}
			
		}

	}
?>