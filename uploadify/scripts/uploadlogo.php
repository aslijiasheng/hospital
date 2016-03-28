<?php
date_default_timezone_set('Asia/Shanghai');//cs时间规范
session_start();//开启
if (!empty($_FILES)) {
	error_reporting(0);
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';

	$new_file_name = new_name( $_FILES['Filedata']['name']);
	$targetFile =  str_replace('//','/',$targetPath) . $new_file_name;
	if (!file_exists($targetPath)) {
		@mkdir($targetPath, 0777);
	}

		//防止中文文件名乱码
		move_uploaded_file($tempFile,iconv('utf-8','gbk', $targetFile));
		
		//返回文件相对地址
		echo get_relative_path($targetFile);
		$sj=date("Y-m", time());
$sj2=date("Y-m-d H:i:s", time());
file_put_contents('../rizhi/'.$sj.'.txt',$sj2."：".$_SESSION['username']."--上传了文件".$_FILES['Filedata']['name']."--保存路径".$targetFile.";\r\n",FILE_APPEND);
		
}


 function new_name($filename){
	$ext = pathinfo($filename);
	$ext = $ext['extension'];
	if ($ext=='jpg'||$ext=='gif'||$ext=='png'||$ext=='JPG'||$ext=='GIF'||$ext=='PNG') 
	{
	$name = basename($filename,$ext); 
	$name = "logo".'.'.$ext;
	return $name;
	}
	else
	{
	return;
	}
 }


 function get_relative_path($path,$dir = 'upload'){
	return substr($path,strpos($path,$dir),strlen($path ));
 }
?>