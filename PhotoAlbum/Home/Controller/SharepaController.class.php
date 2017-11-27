<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class SharepaController extends CommonTwoController{

		protected $rules1=array(
			//array("PAId","require",'不能为空',1),
			array("sclass","require","必须选择分类",1),
			array("sName","require","不能为空",1),
			array("profile","require","不能为空",1),
			array("skey","require","不能为空",1)
		);

		/*protected $autoRules1=array(
			array("status",0),
			array("lookSum",0),
			array("likeSum",0),
			array("cltSum",0),
			array("shareTime","time",0,"function")
		);*/

		public function index(){
			if(!IS_AJAX){
				PHPerr();
			}
			$PAId=trim(I('post.PAId',''));
			if(empty($PAId)){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$UTBTmp=M();
			$rstExists=$UTBTmp->table("photo")->where("PAId='%s' AND status=0",$PAId)->select();
			if(empty($rstExists)){
				$this->ajaxReturn(array("info"=>"error1"));
			}
			$UTB=D("Share");
			$rstExists2=$UTB->where("PAId='%s' AND status=0",$PAId)->find();
			if(!empty($rstExists2)){
				$this->ajaxReturn(array("info"=>"error2"));
			}
			$data=$UTB->field("sName,profile,sclass,skey")->validate($rules1)->create();
			if(!$data){
				$this->ajaxReturn(array("info"=>"error"));
			}
			$data['sid']="s".time().mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
			$data['uid']=session("uid");
			$data['authorName']=session("uname");
			$data['PAId']=$PAId;
			$addRst=$UTB->add($data);
			if($addRst){
				$dataTmp=$this->parseData($rstExists,$data['sid']);
				$addAll=$UTBTmp->execute($dataTmp);
				if($addAll){
					$this->ajaxReturn(array("info"=>"success"));
				}
				$this->ajaxReturn(array("info"=>"error"));
			}else{
				$this->ajaxReturn(array("info"=>"error"));
			}
		}

		private function parseData($data,$sid){
			$query="insert into `sharephoto`(`sid`,`pid`,`spLink`,`status`) values";
			foreach($data as $key => $value) {
				$imgURL=$value['PLink'];
				$imgURL=str_ireplace("thumb1","thumbAuth",$imgURL);
				$imgURL=str_ireplace("/u/","/p/",$imgURL);
				$imgURL=rtrim($imgURL,"/");
				$imgURL=$imgURL."/sid/".$sid."/w/159/h/190";
				$query.="(";
				$query.="'".$sid."',";
				$query.="'".$value['pid']."',";
				//$query.="'".$value['PName']."',";
				$query.="'".$imgURL."',";
				$query.="0";
				$query.="),";
			}
			$query=rtrim($query,",");
			return $query;
		}
	}
?>