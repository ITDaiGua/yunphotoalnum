<?php
namespace Home\Model;
use Think\Model;
	class UserModel extends Model{
		protected $tablePrefix="";
		protected $trueTableName='user';
		protected $_map=array(
			'lgEmail'=>'umail',
			'lgPw'=>'upw'
		);
		protected $_validate=array(
			array('umail','email','邮箱格式不合法',0),
			array('upw','/^[0-9a-zA-Z\_]{6,18}$/','密码格式不正确',0)
		);
		protected $_auto=array(
			array("upw",'myMD5',3,'callback')
		);

		public function myMD5($upw){
			//测试密码：qwer_vd1232
			for($i=0;$i<5;$i++){
				$upw=md5($upw);
			}
			$pwprev=substr($upw,5,13);
			$pwnext=substr($upw,20,30);
			$upw=$pwnext."qer,tv/bn.-=4w56q1@".$upw."we54#*+".$pwprev;
			for($j=0;$j<6;$j++){
				$upw=md5($upw);
			}
			return $upw;
		}
	}
?>