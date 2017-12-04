create database YunPhotoAlbum; #云相册系统数据库
#=======================================
use YunPhotoAlbum;
create table if not exists `user`(
	`uid` varchar(16) not null primary key,
	`umail` varchar(40) not null unique,
	`uname` varchar(30) not null,
	`upw` varchar(32) not null,
	`autonym` varchar(30), #用户真实姓名
	`usex` enum('男','女') not null default '男',
	`birthday` varchar(11),
	`profile` varchar(250), #用户简介
	`userImg` varchar(100),	#用户头像地址
	`securityQst` varchar(100), #密保
	`securityAsw` varchar(32),	#密保答案
	`rgstTime` date not null, #注册时间
	`status` int default 0,	#0：正常、1：临时冻结、2：冻结
	key `login`(`umail`,`upw`,`status`)
)DEFAULT CHARSET=UTF8;
#==============================================
insert into `user`(`uid`,`umail`,`uname`,`upw`,`usex`,`rgstTime`,`status`) 
values('u789123','1571190643@qq.com','莫白柏','asadce15xscvbn2er','男','1234567899
','0'),('u7871123','1789461315@qq.com','刘焕子','asadce15xscvbn2er','男','1508847812
','0');
#==============================================
use YunPhotoAlbum;
create table if not exists `uloginlog`(
	`uid` varchar(30) not null,
	`loginIp` varchar(128) not null,
	`loginTime` varchar(11) not null,
	`status` int not null #0：正常、1：密码错误
	index `lgerr`(`uname`,`loginTime`)
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
delimiter //
CREATE TRIGGER `lgErr_count`
BEFORE INSERT ON `uloginlog` FOR EACH ROW
BEGIN
	IF new.status=1 THEN
		set @maxTime=(select unix_timestamp(now()));
		set @minTime=@maxTime-900;
		set @errcount=(select count(*) from uloginlog where uid=new.uid and (loginTime between @minTime and @maxTime));
		IF @errcount>=4 THEN
			update user set status=1 where uid=new.uid;
		END IF;
	END IF;
END//
delimiter ;
#==============================================
use YunPhotoAlbum;
create table if not exists `photoAlbum`(
	`uid` varchar(16) not null,
	`PAId` varchar(17) not null, #相册id
	#`PAIdPrt` varchar(17) not null default 'top', 
	#相册的父文件夹,top表示顶级文件夹,PAId为pa001则表示默认文件夹,不能被删除
	`PAName` varchar(30) not null default '未命名', #文件夹名
	`status` int not null default 0, #文件夹状态,0：正常、1：被删除
	primary key `pa`(`uid`,`PAId`)
)DEFAULT CHARSET=UTF8;
#PAId为pa01是默认文件夹，不能删除
#==============================================
use YunPhotoAlbum;
create table if not exists `photo`(
	`uid` varchar(16) not null,
	`pid` varchar(16) not null,	#图片id
	`PAId` varchar(17) not null, #图片所属文件夹id
	#`PName` varchar(30) not null, #图片名
	#`PNameft` varchar(60) not null,#全文索引分词
	`PLink` varchar(100) not null, #图片链接
	`status` int not null default 0, #0:正常、1：被删除
	primary key `p`(`uid`,`pid`,`PAId`)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `sharePA`(
	`sid` varchar(16) not null primary key, #共享文件夹id
	`uid` varchar(16) not null, #所有者id
	`authorName` varchar(30) not null,#共享作者的用户名
	`PAId` varchar(17) not null, #所属文件夹id
	`sName` varchar(30) not null, #共享文件夹名
	`profile` varchar(200) not null, #共享文件夹简介
	`sclass` varchar(10) not null, #共享文件夹所属分类
	`skey` varchar(50) not null, #共享文件夹的关键词
	`lookSum` int unsigned not null default 0, #查看人数
	`likeSum` int unsigned not null default 0, #点赞人数
	`cltSum` int unsigned not null default 0,#收藏人数
	`shareTime` varchar(11) not null, #共享的时间
	`status` int not null default 0 #0：正常、1：用户取消共享或删除文件、2：违规删除
	/*unique key `s`(`uid`,`PAId`),*/
	#FULLTEXT(`class`,`skey`)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8;
#==============================================
ALTER TABLE `sharePA` ADD FULLTEXT `sft`(`sclass`,`skey`);
select * from sharePA where match(class,skey) against('风景' IN BOOLEAN MODE);
mysql -uroot -p
#==============================================
insert into sharePA values('s123456','u789123',
	'莫白柏','这是文件夹','这是我的旅游记录','旅游','风景;热情',0,0,'1234567899',0)
#=============================================
insert into sharePA values('s123487','u7871123',
	'刘焕子','2017.8.9北京','北京旅游纪念相册，图修得不好，请见谅','旅游','旅游、自然',0,0,'1508847812',0)
#=================================================
use YunPhotoAlbum;
delimiter //
CREATE TRIGGER `cancleShare` #取消共享的触发器，用于更改共享图片库的图片状态
AFTER UPDATE ON `sharepa`
FOR EACH ROW
BEGIN
      IF new.status=1 THEN
      	update `sharephoto` set status=1 where sid=new.sid;
      END IF;
END//
delimiter ;
#==============================================
use YunPhotoAlbum;
create table if not exists `sharePhoto`(
	`sid` varchar(16) not null,	#共享文件夹的id
	`pid` varchar(16) not null, #共享图片的id
	#`PName`  varchar(30) not null, #图片名
	`spLink` varchar(100) not null, #共享图片的链接
	`status` int default 0, #0：正常、1：被删除
	primary key `sapt`(`sid`,`pid`)
)DEFAULT CHARSET=UTF8;
#=============================================
insert into sharePhoto values('s123456','p1547896','__PUBLIC__/image/p1547896.jpg',0),
	('s123487','p1547897','__PUBLIC__/image/p1547897.jpg',0),
	('s123456','p4678945','__PUBLIC__/image/p4678945.jpg',0)
#==============================================
use YunPhotoAlbum;
create table if not exists `SPATipOff`(
	`stfId` varchar(16) not null primary key, #举报id
	`uid` varchar(16) not null, #举报人id
	`sid` varchar(16) not null, #共享文件夹id
	`style` varchar(10) not null, #举报的类型
	`tpContactWay` varchar(11) not null,#举报人的联系方式
	`tpexplain` varchar(150) not null, #举报说明
	`tpImgs` text,#举报的图片
	`TipOffTime` varchar(11) not null, #举报时间
	`handleAd` varchar(17), #处理的管理员
	`result` varchar(100), #处理结果
	`handleTime` varchar(11), #处理时间
	`status` int not null, #0：处理中、1：处理不通过、2：处理通过
	unique key `stfuk`(`uid`,`sid`)
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `comments`(
	`cid` varchar(16) not null primary key, #评论的id
	`sid` varchar(16) not null, #评论的共享文件夹
	`uname` varchar(30) not null, #评论的用户名
	`content` text not null, #评论的内容
	`time` varchar(11) not null, #评论时间
	`status` int not null default 0, #0：正常、1：被删除
	`tipOffSum` int not null default 0, #举报次数，举报超过10次将推送给管理员处理
	`isIgnore` int not null default 0, #是否忽略举报，默认否，0：否、1：是
	key `cmt`(`sid`,`status`) #fff
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `collection`(
	`cltId` varchar(18) not null primary key, #收藏的id
	`uid` varchar(16) not null, #收藏的用户id
	`sid` varchar(30) not null, #收藏的共享文件夹的id
	#`sName` varchar(30) not null,	#收藏的共享文件夹的名字
	`cltTime` varchar(11) not null,#收藏的时间
	`status` int not null default 0,#0：正常、1：取消收藏
	unique key `clt`(`uid`,`sid`)
)DEFAULT CHARSET=UTF8;
#===============================================
use YunPhotoAlbum;
delimiter //
CREATE TRIGGER `inc_afterClt`
AFTER INSERT ON `collection`
FOR EACH ROW
BEGIN
      update `sharePA` set cltSum=cltSum+1 where sid=new.sid;
END//
delimiter ;
#===============================================
use YunPhotoAlbum;
delimiter //
CREATE TRIGGER `cancleClt`
AFTER UPDATE ON `collection`
FOR EACH ROW
BEGIN
	IF new.status=1 THEN
      update `sharepa` set cltSum=cltSum-1 where sid=old.sid;
    END IF;
END//
delimiter ;
#===============================================
use YunPhotoAlbum;
create table if not exists `like`(
	`sid` varchar(16) not null,
	`uid` varchar(16) not null,
	`likeTime` varchar(11) not null,
	primary key `lk`(`sid`,`uid`)
)DEFAULT CHARSET=UTF8;
#===============================================
create database YunCompany; #云公司内部数据库
#=======================================
use YunCompany;
create table if not exists `staff`(
	`sfid` varchar(16) not null primary key, #员工工号
	`name` varchar(30) not null, #员工姓名
	`section` varchar(21) not null, #所属部门
	`sectionId` varchar(12) not null, #部门编号
	`IDNumber` varchar(18) not null unique, #身份证号码
	`birthday` varchar(11) not null, #出生日期
	`address` varchar(100) not null, #贯籍
	`rank` varchar(21) not null, #员工级别
	`status` int not null #0：正常、1：离职
)DEFAULT CHARSET=UTF8;
#=======================================
use YunCompany;



#=======================================
select sid,sName,profile,class,shareTime from sharePA where status=0  order by shareTime desc;
insert into sharephoto values("s123456","p79456","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p79457","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p794555","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p79267","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p791457","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p78456","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p85457","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0),
	("s123456","p25496","大海","/YunPhotoAlbum/Public/image/p1547896.jpg",0)
#==========================================
create table if not exists `info`(  /*用户通知表*/
	`iid` varchar(16) not null primary key,
	`uid` varchar(16) not null,
	`title` varchar(20) not null,
	`content` varchar(300) not null ,
	`publishTime` int(10) unsigned not null,
	`status` tinyint not null default 0,
	key `uid_title`(`uid`,`title`(30))
)DEFAULT CHARSET=UTF8;
#==========================================
insert into `info`(`uid`,`title`,`content`,`publishTime`,`status`) values(
'u789123456','用户通知','这只是一个测试',1512052617,0);
#==========================================
管理员身份：admid、admRank、admSectionId、admAuth=e51b9d5c21e543b8f93b9aa95b4c7cc7
admRank=ad_1：普通员工、ad_2：部门主管、ad_3：高级管理
admSectionId=a001:高级管理、a002:客服部、a003:法务部、a004:运营部