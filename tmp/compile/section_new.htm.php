<style type="text/css">
<!--
a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;}
-->
</style>
<script type="text/javascript">
	function yy(p)
	{
		var element=document.getElementById("mytext");
		//location.href="Show_Blog.aspx?blogid=" + data;   
            //获取<a>标签对象  
            var a = document.getElementById("zzz");  
            //指定<a>标签的href  
            a.href ="?action=zhiliao&do=listzl&id="+element.value;  
            //取消<a>标签原先的onclick事件,使<a>标签点击后通过href跳转(因为无法用js跳转)^-^  
           
	}
</script>

<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=section&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="kh.infoid" value="<?php echo $this->_var['row']['infoid']; ?>" id="mytext"/>
		<input type="hidden" name="kh.sellid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="salesid" value="<?php echo $_SESSION['userid']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<input name="kh.name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" readonly/>
					<a class="btnLook" href="index.php?action=sell&ms=dy"  lookupGroup="kh" <?php echo $this->_var['row']['xs2']; ?> >添加记录》》显示昨天和今天到院客人</a>
					<span class="inputInfo" <?php echo $this->_var['row']['xs2']; ?>>(通过查找回带当天到院客人)</span>
				</div>
				<div class="unit">
					<label >到诊详细：</label>
                    <input type="text" name="kh.tel"  size="30" value="<?php echo $this->_var['row']['fz_cn']; ?>&#9758;<?php echo $this->_var['row']['tel']; ?>&#9758;<?php echo $this->_var['row']['xb']; ?>"  readonly/>
				</div>
				<div class="unit">
					<label>年龄：</label>
					<input name="kh.nl"  type="text" size="5" value="<?php echo $this->_var['row']['nl']; ?>" alt=""/>
					<span class="inputInfo">如果年龄不对,请修改</span>
				</div>
				<div class="divider d">divider</div>
				<input type="hidden" name="kh.pdxm" size="50"  id=""/>
				<a class="an" id="zzz" onclick="yy()" href="javascript:void()" target="ajax" rel="pdBox" >增加治疗项目</a>
				
				<div class="unit">
				<div id="pdBox" class="unitBox">
					点击"增加治疗项目"，获取派单项目信息，没显示则没派单，通知派单
				</div></div>
				<a class="an" onclick="qt.style.display=''">没有派单项目手动输入</a>
				<div class="unit" id="qt" style="display:none;">
					<label></label>
					<input name="zdjg"  type="text" size="30" value="" alt=""/><span class="inputInfo" >(找不到手动输入)</span>
				</div>
				<div class="divider d">divider</div>
				
				<div class="unit">
					<label>治疗方法：</label>
					<input name="zlff"  type="text" size="30" value="" alt=""/>
					
				</div>
				<div class="unit">
					<label>治疗次数：</label>
					<input name="zlcs"  type="text" size="5" value="" alt=""/>
				</div>
				<div class="unit">
				<label>科室选择：</label>
				<?php echo $this->_var['product_cn']; ?>
				 </div>
				<div class="unit">
				 	<label>主治医生：</label>
					<?php echo $this->_var['doctor_cn']; ?>
				</div>
				<div class="unit">
					<label>执行人：</label>
					
					<input name="zx.orgxh"  type="text" size="30" value="" style="display:none;"/>
                    <input name="zx.orgName"  type="text" size="30" value="" readonly/>
					<a class="btnLook" href="?action=user&do=listzxdh"  lookupGroup="zx" >添加执行人》》</a>
					<span class="inputInfo">(通过复选框多值查找回带)</span>
				</div>
				<div class="unit">
					<label>备注：</label>
					<textarea rows="5" cols="60" class="textInput" name="intro"></textarea>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>