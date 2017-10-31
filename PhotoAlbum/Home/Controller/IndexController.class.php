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
        $condition=I('param.condition',"综合");
        $init['condition']=$condition;
        $lastpg=I('param.lastpg',"1");
        $page=I('param.page',"1");
         //echo $page;
      	if($condition=="综合"){
      		$count=$getSharePA->where("status=%d",0)->cache(true,1)->count();
          $totalPage=ceil($count/50);
          $page=$this->numCheck($page,$totalPage);
      		$selRst=$getSharePA->where("status=%d",0)->field('sid,sName,profile,sclass,shareTime')->order('shareTime desc')->page($page.',50')->cache(true,1)->select();
      	}else{
          $condLen=mb_strlen($condition,"utf8");
          if($condLen>30){
            $condLen=30;
          }
          $contmp="";
          for($i=0;$i<$condLen;$i++){
            $contmp.=mb_substr($condition,$i,1,"utf8")." ";
          }
          $condition=$contmp;
      		$tempArr=$getSharePA->query("select count(*) as tempCount from sharePA where match(sclass,skey) against('{$condition}' IN BOOLEAN MODE)");
      		$count=$tempArr[0]['tempCount'];
          $totalPage=ceil($count/50);
          $page=$this->numCheck($page,$totalPage);
      		$offset=($page-1)*50;
      		$selRst=$getSharePA->query("select sid,sName,profile,sclass,shareTime from sharePA where match(sclass,skey) against('{$condition}' IN BOOLEAN MODE) order by shareTime desc limit {$offset},50");
      	}
      	$lastpg=$this->numCheck($lastpg,$totalPage);
        $init['page']=$page;
        $init['lastpg']=$lastpg;
        $selRst=$this->timeFmtCge($selRst);
        $init["totalPage"]=$totalPage;
        $this->assign("init",$init);
        $this->assign("selRst",$selRst);
        $this->display('/CommonView/Index');
    }

    private function numCheck($arg,$totalPage){
      /*if(is_numeric($arg)){
        if($arg<=1){
          $arg=1;
        }elseif(!is_int($arg)){
          $arg=floor($arg);
        }
      }else{
        $arg=1;
      }*/
      //$arg=$this->numCheck2($arg,1);
      $arg=numCheck2($arg,1);
      if($arg>$totalPage){
        $arg=$totalPage;
      }
      return $arg;
    }

   /* private function numCheck2($num,$minNum){
      if(is_numeric($num)){
        if($num<=$minNum){
          $num=$minNum;
        }elseif(!is_int($num)){
          $num=floor($num);
        }
      }else{
        $num=$minNum;
      }
      return $num;
    }*/

    private function timeFmtCge($selRst){
        $timeNow=time();
        $yesterday=date("Ymd",strtotime('-1 day'));
        $justNow=60; //如果$shareTime-$timeNow<=60,则改为“刚刚”
        $dividend=60; 
        /*
        *如果($shareTime-$timeNow)/$dividend>1,则改为“xx分钟前”,大于等于60小于120一个小时前,以此类推，大于等于1440即第二天直接记录时间;
        */
        foreach ($selRst as $key => $value) {
          $selRst[$key]['sclass']=str_replace(";","",$value['sclass']);
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
        return $selRst;
    }

    /*private function timeFmtCge2($selRst){
      foreach ($selRst as $key => $value) {
        $selRst[$key]['shareTime']=date("Y-m-d",$value['shareTime']);
      }
      return $selRst;
    }*/

    public function showSH(){ //查找共享的图片
      $sid=trim(I("sid"));
      if(!$sid){
        echo '<script>window.location.href="/YunPhotoAlbum/";</script>';
        exit;
      }
      $getSH=D("IndexSelect");
      $selSPRst=$getSH->field("sid,uid,authorName,sName,profile,lookSum,likeSum,cltSum,shareTime")->where("sid='%s' AND status=0",$sid)->select();
     // $selSPRst=$this->timeFmtCge2($selSPRst);
      $selSPRst=timeFmtCge2($selSPRst);
      $selRst=$getSH->field("spLink,pid,PName")->table("sharePhoto")->where("sid='%s' AND status=0",$sid)->page("1,30")->select();
      $this->assign("selSPRst",$selSPRst);
      $this->assign("selRst",$selRst);
      $this->display();
    }

    public function showMoreSH(){
      $sid=trim(I("get.sid"));
      if(!IS_AJAX){
        PHPerr();
      }
      if(empty($sid)){
        PHPerr();
      }
      $page=trim(I('get.page'));
      //$page=$this->numCheck2($page,2);
      $page=numCheck2($page,2);
      $getSH=D("IndexSelect");
      $selRst=$getSH->field("spLink,pid,PName")->table("sharePhoto")->where("sid='%s' AND status=0",$sid)->page("$page,30")->select();
      foreach ($selRst as $key => $value) {
        $selRst[$key]['PName']=$value['PName']."_".$page;
      }
      $this->ajaxReturn($selRst);
      //print_r($selRst);
    }

    function lookSum(){
      $sid=trim(I("post.sid"));
      if(!IS_AJAX){
        PHPerr();
      }
      if(empty($sid)){
        PHPerr();
      }
      $lookSumKey=md5($sid."lookSum");
      if(!cookie("$lookSumKey")){
        $IncLookSum=D("IndexSelect");
        $IncLookSum->where("sid='%s'",$sid)->setInc("lookSum");
      }
      cookie($lookSumKey,"1",time()+31536000);
    }
}
