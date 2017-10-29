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
			$this->ajaxReturn(array(array("pid"=>"dd","PName"=>"dds")));
		}
		
	}
?>