<?php 
header('Content-type: application/json');
$file_name=$_GET["version"];  

$hostdir=dirname(__FILE__);

//获取本文件目录的文件夹地址	
  $filesnames = scandir($hostdir."\down");

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
	echo '{"version":'.$lastest.'}';
	}else{
		echo '{"version":0}';
		}
?> 