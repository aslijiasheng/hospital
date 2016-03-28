<?php
/*
web接口工作示例
本接口完成：
接收短信，自动回复短信
接收呼叫，自动回复短信
发送短信
接收发送短信状态
接收发送短信回执报告
*/

/*
测试方式一：
print_r($_POST);

*/

date_default_timezone_set('Asia/Shanghai');

//测试代码，正式测试请注释掉exit();
//exit();

$pre = "sms_";

if($_POST["{$pre}key"] != '123'){
	exit();
}

if($_POST["{$pre}action"]=='receive'){
	//收到短信，做自己业务逻辑，然后下面输出的内容会被短信猫重新发送出去
	//短信猫POST过来的参数为：port,action,time,mobile,content
	//参数意义分别为：串口、动作、时间、发送者号码、短信内容
	exit(file_get_contents("php://input"));
}
elseif($_POST["{$pre}action"]=='ring'){
	//收到呼叫，做自己业务逻辑，然后下面输出的内容会被短信猫重新发送出去
	//短信猫POST过来的参数为：port,action,mobile
	//参数意义分别为：串口、动作、来电号码
	exit(file_get_contents("php://input"));
}



/*
也可以在代码里请求http://猫的ip地址:6000/?key=123&id=1&mobile=15000000000&message=test

例如：file_get_contents('http://localhost:6000/?key=123&id=1&mobile=15000000000&message=test');
*/
?>
