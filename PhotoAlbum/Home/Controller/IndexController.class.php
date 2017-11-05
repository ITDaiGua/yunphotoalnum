<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
class IndexController extends CommonOneController{
    private $admAuthStr="e51b9d5c21e543b8f93b9aa95b4c7cc7";
    private $typeArr=array("gif","jpeg","png","jpg");
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
      $arg=numCheck2($arg,1);
      if($arg>$totalPage){
        $arg=$totalPage;
      }
      return $arg;
    }

    public function showSH(){ //查找共享的图片
      $sid=trim(I("sid"));
      if(!$sid){
        echo '<script>window.location.href="/YunPhotoAlbum/";</script>';
        exit;
      }
      $getSH=D("IndexSelect");
      $selSPRst=$getSH->field("a.sid,a.uid,a.authorName,a.sName,a.profile,a.lookSum,a.likeSum,a.cltSum,a.shareTime,b.userImg")->table('sharepa a,user b')->where("a.sid='%s' AND a.status=0 AND a.uid=b.uid",$sid)->select();
      if(empty($selSPRst[0]['userImg'])){
        $selSPRst[0]['userImg']='/YunPhotoAlbum/Public/SysImg/uimg.jpg';
      }
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
      $page=numCheck2($page,2);
      $getSH=D("IndexSelect");
      $selRst=$getSH->field("sid,spLink,pid,PName")->table("sharePhoto")->where("sid='%s' AND status=0",$sid)->page("$page,30")->select();
      /*foreach ($selRst as $key => $value) {
        $selRst[$key]['PName']=$value['PName']."_".$page;
      }*/
      $this->ajaxReturn($selRst);
    }

    public function lookSum(){
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

    public function thumb1(){
      $subPath=trim(I('param.p'))."/";
      $fileName=trim(I('param.fn'));
      $type=strtolower(trim(I('param.t')));
      $path=$this->pathAuth1($subPath,$fileName,$type);
      $w=trim(I('param.w'));
      $h=trim(I('param.h'));
      $w=$this->imageSize($w);
      $h=$this->imageSize($h);
      echoImg($path,$type,$w,$h,6);
    }

    public function thumb1org(){
      $subPath=trim(I('param.p'))."/";
      $fileName=trim(I('param.fn'));
      $type=strtolower(trim(I('param.t')));
      $path=$this->pathAuth1($subPath,$fileName,$type);
      switch($type){
        case 'jpeg':
        case 'jpg':@header('Content-Type:image/jpg');break;
        case 'gif':@header('Content-Type:image/gif');break;
        case 'png':@header('Content-Type:image/png');break;
        default:@header('Content-Type:image/jpg');
      }
      readfile($path);
    }

    public function thumbAuth(){
      $sid=I('param.sid','','trim');
      $fileName=I('param.fn','','trim');
      $uid=I('param.u','','trim');
      $type=strtolower(I('param.t','','trim'));
      $path=$this->pathAuth($sid,$fileName,$uid,$type);
      $w=I('param.w','','trim');
      $h=I('param.h','','trim');
      $w=$this->imageSize($w);
      $h=$this->imageSize($h);
      echoImg($path,$type,$w,$h,6);
    }

    public function originImg(){
      $sid=I('param.sid','','trim');
      $fileName=I('param.fn','','trim');
      $uid=I('param.u','','trim');
      $type=strtolower(I('param.t','','trim'));
      $path=$this->pathAuth($sid,$fileName,$uid,$type);
      switch($type){
        case 'jpeg':
        case 'jpg':@header('Content-Type:image/jpg');break;
        case 'gif':@header('Content-Type:image/gif');break;
        case 'png':@header('Content-Type:image/png');break;
        default:@header('Content-Type:image/jpg');
      }
      readfile($path);
    }

    private function pathAuth1($subPath,$fileName,$type){
      $rootPath="./Public/";
      if(stripos($subPath,"tipoffImg")!==FALSE){
        $uid="-".session('uid');
        $admAuth=session('admAuth');
        if(stripos($subPath,$uid)===FALSE&&$admAuth!==$this->admAuthStr){
          $subPath="";
        }else{
          $subPath=$subPath;
        }
      }
      if(stripos($subPath,"image")!==FALSE){
        $subPath="";
      }
      if(!in_array($type,$this->typeArr)){
        $type="";
      }
      if(empty($subPath)||empty($fileName)||empty($type)){
        $path='./Public/SysImg/noexists.png';
      }else{
        $subPath=str_ireplace("-","/",$subPath);
        $path=$rootPath.$subPath.$fileName.".".$type;
      }
      return $path;
    }

    private function pathAuth($sid,$fileName,$uid,$type){
      $rootPath="./Public/image/";
      if(!in_array($type,$this->typeArr)||empty($fileName)){
        $path='./Public/SysImg/noAuth.png';
      }elseif(session("uid")===$uid){
        $path=$rootPath.$uid."/".$fileName.".".$type;
      }elseif(session("admSectionId")==="a001"&&session('admAuth')===$this->admAuth&&session('admRank')==="ad_1"){
        $path=$rootPath.$uid."/".$fileName.".".$type;
      }else{
        $authTb=D("IndexSelect");
        $sidSel=$authTb->field('sid,uid,status')->where("sid='%s' AND status=0",$sid)->cache(true,31536000)->find();
        if(!empty($sidSel)){
          $path=$rootPath.$sidSel['uid']."/".$fileName.".".$type;
        }else{
          $path='./Public/SysImg/noAuth.png';
        }
      }
      return $path;
    }

    private function imageSize($num){
      if(is_numeric($num)){
        if($num<=10){
          $num=10;
        }else{
          $num=$num;
        }
      }else{
        $num=150;
      }
      return floor($num);
    }
    
    public function getComment(){
      if(!IS_AJAX){
        PHPerr();
      }
      $sid=trim(I('get.sid'));
      $page=trim(I('get.page'));
      if(empty($sid)||empty($page)){
        PHPerr();
      }
      $page=numCheck2($page,1);
      $commentTB=M();
      $selRst=$commentTB->field("cid,sid,uname,content,time,status")->table("comments")->where("sid='%s' AND status=0",$sid)->order("time desc")->page("$page,30")->select();
      $selRst=$this->timeFmtCge3($selRst);
      $this->ajaxReturn($selRst);
    }

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
    
    private function timeFmtCge3($selRst){
        $timeNow=time();
        $yesterday=date("Ymd",strtotime('-1 day'));
        $justNow=60; //如果$shareTime-$timeNow<=60,则改为“刚刚”
        $dividend=60; 
        /*
        *如果($shareTime-$timeNow)/$dividend>1,则改为“xx分钟前”,大于等于60小于120一个小时前,以此类推，大于等于1440即第二天直接记录时间;
        */
        foreach ($selRst as $key => $value) {
          $selRst[$key]['content']=htmlspecialchars_decode($value['content']);
          $time=$value['time'];
          if(date("Ymd",$time)==$yesterday){
            $selRst[$key]['time']="昨天";
            continue;
          }
          $tempTime1=$timeNow-$time;
          if($tempTime1<=$justNow){
            $selRst[$key]['time']="刚刚";
            continue;
          }
          $tempTime2=($timeNow-$time)/$dividend;
          if($tempTime2<60){
            $selRst[$key]['time']=floor($tempTime2)."分钟前";
          }elseif($tempTime2<1440){
            $selRst[$key]['time']=floor($tempTime2/60)."小时前";
          }else{
            $selRst[$key]['time']=date("Y年m月d日",$time);
          }
        }
        return $selRst;
    }
}
