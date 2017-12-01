<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class InfoController extends CommonTwoController{
		public function index(){
			if(!IS_AJAX){
				exit("发生错误");
			}
			$infoTB=M("info");
			$timeLen=604800;  //一周的时间长度;
			$loopSum=1;	//循环查询的次数;
			$canSave=true; //当查询为空时，判断是否修改信息的状态，防止短时间内重复操作数据库
			while($loopSum<=15) {
				$isLogin=session("isLogin");
				if($isLogin!="isLogin"){
					$this->ajaxReturn(array("info"=>"noLogin"));
					break;
				}
				$uid=session("uid");
				$minTime=time()-$timeLen;		//查询未读信息的最小时间
				$rst=$infoTB->where("uid='%s' and publishTime>%d and status=0",$uid,$minTime)->find();
				if($rst===FALSE){
					$this->ajaxReturn(array("info"=>"error"));
					break;
				}
				if(empty($rst)){
					if($canSave){
						$infoTB->where("uid='%s' and publishTime<=%d and status=0",$uid,$minTime)->save(array("status"=>1));
						$canSave=false;
						sleep(2); //停止2秒再执行
					}
					if($loopSum===15){
						$this->ajaxReturn(array("info"=>""));
					}
				}else{
					$this->ajaxReturn(array("info"=>"exists"));
					break;
				}
			}
		}

		public function getInfo(){
			$infoTB=M("info");
			$uid=session("uid");
			$timeLen=604800;  //一周的时间长度;
			$minTime=time()-$timeLen;		//查询未读信息的最小时间
			$rst=$infoTB->where("uid='%s' and publishTime>%d and status=0",$uid,$minTime)->find();
			$this->assign("info",$rst);
			$this->display();
		}
	}
?>