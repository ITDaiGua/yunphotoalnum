<?php
namespace Home\Controller;
use Home\Controller\CommonTwoController;
	class AjaxOptController extends CommonTwoController{
		public function comment(){
			if(!IS_AJAX){
				$this->PHPcmterr();
			}
			$commentTB=M();
			$data['content']=trim(I("post.comment"));
			$data['sid']=trim(I('post.sid'));
			if(empty($data['content'])||empty($data['sid'])){
				$this->PHPcmterr();
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

		private function PHPcmterr(){
			exit("发生错误,<span id='PHPcmterr'>3</span>秒后为你跳转...<script>
				var PHPcmterr=document.getElementById('PHPcmterr');var time=3;
				setInterval(function(){
					if(time==0){location.reload();}
					PHPcmterr.innerText=time;
					time--;
				},1000);</script>");
		}
	}
?>