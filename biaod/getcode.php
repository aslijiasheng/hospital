<?php
   //生成数字和字母的验证码
   $num = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz1234567890'), 0, 4));
   //将生成的验证码写入session，备验证页面使用
    Session_start();
    $_SESSION["randcode"] = $num;
   //创建图片，定义颜色值
    Header("Content-type: image/PNG");
    srand((double)microtime()*1000000);
    $im = imagecreate(80,20);
    $black = ImageColorAllocate($im, 183, 0, 85);
    $gray = ImageColorAllocate($im, 200,200,200);
	$bgcolor = ImageColorAllocate($im, 183, 178, 152);
	//$colour = imagecolorallocate($image, 183, 178, 152);
    imagefill($im,0,0,$gray);

    //随机绘制两条虚线，起干扰作用
    $style = array($black, $bgcolor, $black, $bgcolor, $black, $gray, $gray, $gray, $gray, $gray);
    imagesetstyle($im, $style);
    $y1=rand(0,20);
    $y2=rand(0,20);
    $y3=rand(0,20);
    $y4=rand(0,20);
    imageline($im, 0, $y1, 80, $y3, IMG_COLOR_STYLED);
    imageline($im, 0, $y2, 80, $y4, IMG_COLOR_STYLED);

    //在画布上随机生成大量黑点，起干扰作用;
    for($i=0;$i<60;$i++)
    {
   imagesetpixel($im, rand(0,80), rand(0,20), $black);
    }
    //将四个数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
    $strx=rand(6,18);
    for($i=0;$i<4;$i++){
    $strpos=rand(1,6);
    imagestring($im,5,$strx,$strpos, substr($num,$i,1), $black);
    $strx+=rand(8,12);
    }
    ImagePNG($im);
    ImageDestroy($im);

?>
