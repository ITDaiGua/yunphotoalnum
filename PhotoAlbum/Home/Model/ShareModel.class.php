<?php
namespace Home\Model;
use Think\Model;
	class ShareModel extends Model{
		protected $patchValidate = true;
		protected $tablePrefix="";
		protected $trueTableName='sharepa';
		protected $_auto=array(
			array("sclass","sclassNew",1,"callback"),
			array("skey","skeyNew",1,"callback"),
			array("status",0),
			array("lookSum",0),
			array("likeSum",0),
			array("cltSum",0),
			array("shareTime","time",1,"function")
		);

		public function sclassNew($sclass){
			$sclassLen=mb_strlen($sclass,"utf8");
			$sclassNew="";
			for($i=0;$i<$sclassLen;$i++){
				$sclassNew.=mb_substr($sclass,$i,1,"utf8").";";
			}
			return $sclassNew;
		}

		public function skeyNew($skey){
			$skey=preg_replace("/[^\x{4e00}-\x{9fa5}A-Za-z0-9 ]/u","",$skey);
			$skeyLen=mb_strlen($skey,"utf8");
			$skeyNew="";
			for($i=0;$i<$skeyLen;$i++){
				$skeyNew.=mb_substr($skey,$i,1,"utf8").";";
			}
			return $skeyNew;
		}
	}
?>