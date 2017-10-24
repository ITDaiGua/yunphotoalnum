<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
class IndexController extends CommonOneController{
    public function index(){
        $styleLi1="style='background-color:#00a2ff;color:#fff;'";
        $init=array(
	       	"title"=>"首页",
	       	"styleLi1"=>$styleLi1,
	       	"viewType"=>"shareFolders",
	       	"searchURL"=>"/YunPhotoAlbum/",
	       	"placeholder"=>"搜索共享文件夹"
        );
        $getSharePA=D("IndexSelect");
        $condition=I('condition',"");
        //$condition="旅游";
        $page=I('page',"1",'trim');
        if(is_numeric($page)){
        	if($page<=1){
        		$page=1;
        	}elseif(!is_int($page)){
        		$page=floor($page);
        	}
        }else{
        	$page=1;
        }
      	if(empty($condition)){
      		$count=$getSharePA->where("status=%d",0)->cache(true,600)->count();
      		$selRst=$getSharePA->where("status=%d",0)->field('sid,sName,profile,sclass,shareTime')->order('shareTime desc')->page($page.',50')->cache(true,600)->select();
      	}else{
      		$tempArr=$getSharePA->query("select count(*) as tempCount from sharePA where match(sclass,skey) against('{$condition}' IN BOOLEAN MODE)");
      		$count=$tempArr[0]['tempCount'];
      		$offset=($page-1)*30;
      		$selRst=$getSharePA->query("select sid,sName,profile,sclass,shareTime from sharePA where match(sclass,skey) against('{$condition}' IN BOOLEAN MODE) order by shareTime desc limit {$offset},30");
      	}
      	$totalPage=ceil($count/50);
      	$timeNow=time();
      	$yesterday=date("Ymd",strtotime('-1 day'));
      	$justNow=60; //如果$shareTime-$timeNow<=60,则改为“刚刚”
      	$dividend=60; 
      	/*
      	*如果($shareTime-$timeNow)/$dividend>1,则改为“xx分钟前”,大于等于60小于120一个小时前,以此类推，大于等于1440即第二天直接记录时间;
      	*/
      	foreach ($selRst as $key => $value) {
      		$shareTime=$value['shareTime'];
      		if(date("Ymd",$shareTime)==$yesterday){
      			$selRst[$key]['shareTime']="昨天";
      			continue;
      		}
      		$tempTime1=$timeNow-$shareTime;
      		if($tempTime1<=$justNow){
      			$selRst[$key]['shareTime']="刚刚";
      			continue;
      		}
      		$tempTime2=($timeNow-$shareTime)/$dividend;
      		if($tempTime2<60){
      			$selRst[$key]['shareTime']=floor($tempTime2)."分钟前";
      		}elseif($tempTime2<1440){
      			$selRst[$key]['shareTime']=floor($tempTime2/60)."小时前";
      		}else{
      			$selRst[$key]['shareTime']=date("Y年m月d日",$shareTime);
      		}
      	}
       	$this->assign("init",$init);
        $this->assign("selRst",$selRst);
        $this->display('/CommonView/Index');
    }
}