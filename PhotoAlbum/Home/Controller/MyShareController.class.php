<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class MyShareController extends CommonTwoController{
		public function index(){
			$styleLi3="style='background-color:#00a2ff;color:#fff;'";
      $init=array(
       	"title"=>"我的分享",
       	"styleLi3"=>$styleLi3,
       	"viewType"=>"myShare"
      );
      $TB=M("sharepa");
      $uid=session("uid");
      $rst=$TB->field("sid,sName")->where("uid='%s' AND status=0",$uid)->select();
      $this->assign("init",$init);
      $this->assign("MyShare",$rst);
      $this->display('/CommonView/Index');
		}

		public function cancleShare(){
			if(!IS_AJAX){
				exit("发生错误");
			}
			$data['sid']=trim(I("get.sid",""));
			if(empty($data['sid'])){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data['uid']=session("uid");
			$TB=M("sharepa");
			$rst=$TB->where("sid='%s' AND uid='%s' AND status=0",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}
	}
?>