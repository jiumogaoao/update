<?php 
function sendFile($version,$hostdir){
	header("Content-type:text/html;charset=utf-8"); 
// $file_name="cookie.jpg"; 
$file_name=$_GET["version"]; 
//用以解决中文不能显示出来的问题 
$file_name=iconv("utf-8","gb2312",$version.".zip"); 
$file_sub_path=$hostdir."\down\\"; 
$file_path=$file_sub_path.$version.".zip"; 
//首先要判断给定的文件存在与否 
if(!file_exists($file_path)){ 
echo "没有该文件文件"; 
return ; 
} 
$fp=fopen($file_path,"r"); 
$file_size=filesize($file_path); 
//下载文件需要用到的头 
Header("Content-type: application/zip"); 
Header("Accept-Ranges: bytes"); 
Header("Accept-Length:".$file_size); 
Header("Keep-Alive：timeout=5, max=100");
Header("Content-Disposition: attachment; filename=".$file_name); 
$buffer=1024; 
$file_count=0; 
//向浏览器返回数据 
while(!feof($fp) && $file_count<$file_size){ 
$file_con=fread($fp,$buffer); 
$file_count+=$buffer; 
echo $file_con; 
} 
//fclose($fp); 
	}
$hostdir=dirname(__FILE__);

//获取本文件目录的文件夹地址	
  $filesnames = scandir($hostdir."\down");
//获取也就是扫描文件夹内的文件及文件夹名存入数组 $filesnames

  //print_r ($filesnames);
$lastest=0;
foreach ($filesnames as $name) {
//echo $name; 
if($name!="."&&$name!=".."){
$name=	explode('.',$name);
$name=(int)$name[0];
if($name>$lastest){
	$lastest=$name;
	}
	}
}
if((int)$_GET["version"]<$lastest){
	sendFile($lastest,$hostdir);
	}else{
		echo "无更新";
		}
?> 