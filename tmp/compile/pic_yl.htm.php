<script src="javascripts/c_picll.js" type="text/javascript"></script>
<style type="text/css"> 
<!--
body{cursor:pointer;}
img{border:0;}
td, a {font-size:12px; color:#000000} 
#Layer1 {position:absolute; z-index:100; top: 10px;right:10px;} 
#Layer2 {position:absolute; z-index:1;}
td img{cursor:pointer;width: 20px;height: 20px;}
.yt{max-width:1300px;}
--> 
</style> 

 <div style="height:550px;overflow-y:auto;">
<div id="Layer1"> 
<table border="0" cellspacing="2" cellpadding="0"> 
<tr> 
<td> </td> 
<td><img src="uploadify/img/up.gif"  onClick="clickMove('up')" title="向上"></td> 
<td> </td> 
</tr> 
<tr> 
<td><img src="uploadify/img/left.gif"  onClick="clickMove('left')" title="向左"></td> 
<td><img src="uploadify/img/zoom.gif"  onClick="realsize();" title="还原"></td> 
<td><img src="uploadify/img/right.gif"  onClick="clickMove('right')" title="向右"></td> 
</tr> 
<tr> 
<td> </td> 
<td><img src="uploadify/img/down.gif"  onClick="clickMove('down')" title="向下"></td> 
<td> </td> 
</tr> 
<tr> 
<td> </td> 
<td><img src="uploadify/img/zoom_in.gif"  onClick="bigit();" title="放大"></td> 
<td> </td> 
</tr> 
<tr> 
<td> </td> 
<td><img src="uploadify/img/zoom_out.gif"  onClick="smallit();" title="缩小"></td> 
<td> </td> 
</tr> 
</table> 
</div>
 
<div id='hiddenPic' style='position:absolute; left:0px; top:0px; width:0px; height:0px; z-index:1; visibility: hidden;'><img name='images2' src='chajian/slt/slt.php?src=<?php echo $this->_var['cfg']['app']; ?><?php echo $this->_var['row']['wz']; ?>&w=900' ></div> 
<div id='block1' onmouseout='drag=0' onmouseover='dragObj=block1; drag=1;' style='z-index:5; height: 0; left: 0px; position: absolute; top: 0px; width: 0' class="dragAble"> <img class="yt" name='images1' src='chajian/slt/slt.php?src=<?php echo $this->_var['cfg']['app']; ?><?php echo $this->_var['row']['wz']; ?>&w=900'  ></div>
</div>