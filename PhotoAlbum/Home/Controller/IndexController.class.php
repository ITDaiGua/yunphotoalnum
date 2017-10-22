<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class IndexController extends CommonController{
    public function index(){
       $this->assign("title","首页");
       $styleLi1="style='background-color:#00a2ff;color:#fff;'";
       $this->assign("styleLi1",$styleLi1);
       $dd=D('IndexSelect');
       $this->display();
    }
}