<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
class IndexController extends CommonOneController{
    public function index(){
       $this->assign("title","首页");
       $styleLi1="style='background-color:#00a2ff;color:#fff;'";
       $this->assign("styleLi1",$styleLi1);
       $this->assign("viewType","shareFolders");
       $dd=M("IndexSelect");
       $this->display('/CommonView/Index');
    }
}