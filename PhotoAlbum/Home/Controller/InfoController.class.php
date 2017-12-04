<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class InfoController extends CommonTwoController{
		public function index(){
			if(!IS_AJAX){
				exit("发生错误...");
			}
			$infoTB=M("info");
			$timeLen=604800;  //一周的时间长度;
			$uid=session("uid");
			$minTime=time()-$timeLen;		//查询未读信息的最小时间
			$rst=$infoTB->where("uid='%s' and publishTime>%d and status=0",$uid,$minTime)->find();
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			if(empty($rst)){
				$infoTB->where("uid='%s' and publishTime<=%d and status=0",$uid,$minTime)->save(array("status"=>1));
				$this->ajaxReturn(array("info"=>"notexists"));
			}else{
				$this->ajaxReturn(array("info"=>"exists"));
			}
		}
	}
?>