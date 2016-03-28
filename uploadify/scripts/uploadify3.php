<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination

//本文件由uploadify官方提供，第一php网对其进行了修改和注释
$targetFolder = 'uploads'; //设置上传目录

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];

	$targetFile =$targetFolder. '/' . $_FILES['Filedata']['name'];//上传后的图片路径
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); //允许的文件后缀
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $_FILES['Filedata']['name'];//上传成功后返回给前端的数据
		file_put_contents($_POST['id'].'.txt','上传成功了！');
	} else {
		echo '不支持的文件类型';
	}
}
?>