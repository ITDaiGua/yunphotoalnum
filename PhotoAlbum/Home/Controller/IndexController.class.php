<?php
namespace Home\Controller;
use Home\Controller\CommonOneController;
class IndexController extends CommonOneController{
    public function index(){
        $styleLi1="style='background-color:#00a2ff;color:#fff;'";
        $init=array(
	       	"title"=>"首页",
	       	"styleLi1"=>$styleLi1,
	       	"viewType"=>"shareFolders"
        );
        $this->assign("init",$init);
        $dd=M("IndexSelect");
        $this->display('/CommonView/Index');
    }
}