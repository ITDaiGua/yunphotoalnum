create database YunPhotoAlbum;
#=======================================
use YunPhotoAlbum;
create table if not exists `user`(
	`uid` varchar(16) not null primary key,
	`umail` varchar(40) not null unique,
	`uname` varchar(30) not null,
	`upw` varchar(32) not null,
	`autonym` varchar(18),
	`usex` enum('男','女') not null default '男',
	`userImg` varchar(100),
	`securityQst` varchar(100),
	`securityAsw` varchar(32),
	`rgstTime` varchar(11) not null,
	`status` int default 0,
	key `login`(`umail`,`upw`)
)DEFAULT CHARSET=UTF8;
#==============================================
use YunPhotoAlbum;