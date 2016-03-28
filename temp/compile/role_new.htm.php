<script type="text/javascript" > 
$("document").ready(function(){     
     $("#action_all").click(function(){   
		if(this.checked){   
			$("input[name='action[]']").each(function(){this.checked=true;});
			$("#btn1").html("反选");   
		}else{   
			$("input[name='action[]']").each(function(){this.checked=false;});   
			$("#btn1").html("全选"); 
		}   
	 });   
});
</script>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=role&do=new" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>用户组名称：</label>
					<input type="text" name="title" class="required" size="30" value=""/>
				</p>
				<p>
					<label>页面权限：<input type="checkbox" id="action_all"><span id="btn1">全选</span></label>
				</p>
				<div style="width:100%;">
					<?php echo $this->_var['checkbox_role_action']; ?>
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