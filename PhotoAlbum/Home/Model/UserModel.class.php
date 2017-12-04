<?php
namespace Home\Model;
use Think\Model;
	class UserModel extends Model{
		protected $patchValidate = true;
		protected $tablePrefix="";
		protected $trueTableName='user';
		protected $_map=array(
			'lgEmail'=>'umail',
			'lgPw'=>'upw',
			"newPw"=>"upw",
			"newPw2"=>"upw",
			"umail2"=>"umail",
			"answer"=>"securityAsw",
			"myNewPw"=>"upw"
		);
		protected $_validate=array(
			array('umail','email','邮箱格式不合法',0),
			array('upw','/^[0-9a-zA-Z\_]{6,18}$/','密码格式不正确',0),
			array('uname','/^[\x{4E00}-\x{9FA5}A-Za-z0-9_]{2,6}$/u','必须是2-8位中文或英文或数字或下划线组成',0),
			array('uname','','用户名已存在',0,'unique',2),
			array('umail','','邮箱已被注册',0,'unique',2),
			//array('umail','','邮箱已被注册',0,'unique',1),
			array('cmfupw','upw','必须与上一个密码相同',0,'confirm'),
			array('cmfNewPw','upw','必须与上一个密码相同',0,'confirm'),
			array('cmfNewPw2','upw','必须与上一个密码相同',0,'confirm'),
			array('cmfMyNewPw','upw','必须与上一个密码相同',0,'confirm')
		);
		protected $_auto=array(
			array("upw",'myMD5',3,'callback'),
			array("securityAsw","myMD5",3,'callback')
		);

		public function myMD5($upw){
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