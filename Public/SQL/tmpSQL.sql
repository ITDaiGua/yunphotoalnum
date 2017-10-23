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
	`rgstTime` varchar(11) not null, #注册时间
	`status` int default 0,	#0：正常、1：临时冻结、2：冻结
	key `login`(`umail`,`upw`,`status`)
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `uloginlog`(
	`uid` varchar(16) not null,
	`loginIp` varchar(128) not null,
	`loginTime` varchar(11) not null,
	`status` int not null #0：正常、1：密码错误
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `photoAlbum`(
	`uid` varchar(16) not null,
	`PAId` varchar(17) not null, #相册id
	`PAIdPrt` varchar(17) not null default 'top', 
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
	`PName` varchar(30) not null, #图片名
	`PNameft` varchar(60) not null,#全文索引分词
	`PLink` varchar(100) not null, #图片链接
	`status` int not null default 0, #0:正常、1：被删除
	primary key `p`(`uid`,`pid`,`PAId`)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `sharePA`(
	`sid` varchar(16) not null primary key, #共享文件夹id
	`uid` varchar(16) not null, #所有者id
	`PAId` varchar(17) not null, #所属文件夹id
	`sName` varchar(30) not null, #共享文件夹名
	`profile` varchar(200) not null, #共享文件夹简介
	`class` varchar(10) not null, #共享文件夹所属分类
	`skey` varchar(50) not null, #共享文件夹的关键词
	`lookSum` int unsigned not null default 0, #查看人数
	`likeSum` int unsigned not null default 0, #点赞人数
	`status` int not null default 0, #0：正常、1：用户取消共享或删除文件、2：违规删除
	unique key `s`(`uid`,`PAId`),
	fulltext key `sft`(`class`,`skey`)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `SPATipOff`(
	`stfId` varchar(16) not null primary key, #举报id
	`uid` varchar(16) not null, #举报人id
	`sid` varchar(16) not null, #共享文件夹id
	`style` varchar(10) not null, #举报的类型
	`explain` varchar(150) not null, #举报说明
	`TipOffTime` varchar(11) not null, #举报时间
	`handleAd` varchar(17), #处理的管理员
	`result` varchar(100), #处理结果
	`handleTime` varchar(11), #处理时间
	`status` int not null #0：处理中、1：处理不通过、2：处理通过
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;
create table if not exists `comments`(
	`cid` varchar(16) not null primary key, #评论的id
	`sid` varchar(16) not null, #评论的共享文件夹
	`uname` varchar(30) not null, #评论的用户名
	`content` varchar(140) not null, #评论的内容
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
	`cltTime` varchar(11) not null,#收藏的时间
	`status` int not null default 0,#0：正常、1：取消收藏
	unique key `clt`(`uid`,`sid`)
)DEFAULT CHARSET=UTF8;
#==============================================
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