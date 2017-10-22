<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class IndexController extends CommonController{
    public function index(){
       $this->assign("title","首页");
       $this->display();
    }
}