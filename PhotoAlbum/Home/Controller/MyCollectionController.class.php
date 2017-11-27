<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class MyCollectionController extends CommonTwoController{
		public function index(){
			$styleLi4="style='background-color:#00a2ff;color:#fff;'";
      $init=array(
       	"title"=>"我的分享",
       	"styleLi4"=>$styleLi4,
       	"viewType"=>"myCollection"
      );
      $TB=M();
      $uid=session("uid");
      $rst=$TB->table("collection a,sharepa b")->field("a.cltId,a.sid,b.sName")->where("(a.uid='%s' AND a.status=0) AND (a.sid=b.sid)",$uid)->select();
      $this->assign("init",$init);
      $this->assign("myCollection",$rst);
      $this->display('/CommonView/Index');
		}

		public function cancleClt(){
			if(!IS_AJAX){
				exit("发生错误");
			}
			$data['cltId']=trim(I("get.cltId",""));
			if(empty($data['cltId'])){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data['uid']=session("uid");
			$TB=M("collection");
			$rst=$TB->where("cltId='%s' AND uid='%s'",$data)->save(array("status"=>1));
			if($rst===FALSE){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$this->ajaxReturn(array("info"=>"success"));
		}
	}
?>