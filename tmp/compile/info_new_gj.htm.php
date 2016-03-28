<style>
#search{font-size:14px;position:relative;width:530px;height: 28px;}
#search .d{height: 10px;overflow:hidden;}
#search_auto{border:1px solid #B8D0D6;border-top:2px solid #f00; position:absolute;top:70px;left:135px; display:none;z-index:100;background:#fff;padding:5px;}
#search_auto li{background:#FFF; text-align:left;line-height:20px;}
#search_auto li.cls,li.cls2{color:#183152;background:#F0F4F6;height: 20px;overflow:hidden;line-height:20px;margin-top:5px;}
#search_auto li.cls a{display:block;width: 50px;height: 20px;overflow:hidden;float:right;padding:0;margin:0;text-align:center;line-height:20px;color:#183152;}
#search_auto li a{display:block; padding:5px 6px; cursor:pointer; color:#666;}
#search_auto li a:hover{background:#D8D8D8; text-decoration:none; color:#000;}

select.input{margin-right:2px;}
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
				   
				<p>
					<label>客户名称：</label>
					<input name="name" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<div id="search" class="unit"><label>客户电话：</label>
				<input name="k" class="phone" type="text" size="30" value="" />
				<span class="inputInfo">多号码登记请用"/"隔开</span>
				</div>
				<div id="search_auto"></div>
				<div class="unit">
				<p>
					<label>预约时间：</label>
					<input name="yy_at"  type="text" size="9" class="date" readonly="true"/>
				</p>
				<p>
					<label>性别：</label>
                    <input type="radio" name="xb"  value="女" checked="checked"/>女
                    <input type="radio" name="xb"  value="男" />男
				</p>
				<p>
					<label>年龄：</label>
					<input name="nl" class="" type="text" size="9" value="" alt=""/>
				</p>
				</div>
				<div class="divider">divider</div>
				<div class="unit">
					<p>
					<label>预约方式：</label>
					<?php echo $this->_var['typeid_cn']; ?>
					<?php echo $this->_var['areaid_cn']; ?>
					</p><?php if ($_SESSION['roleid'] == "1"): ?>
					<p>
					<label>上线选择：</label>
					<input name="sx.id"  type="text" size="30" value="" style="display:none;"/>
                    <input name="sx.name"  type="text" size="20" value="" readonly/>
					<a class="btnLook" href="?action=info&do=listsx"  lookupGroup="sx" >上线选择》》</a>	
				    </p><?php endif; ?>
				</div>
				
				<div class="unit">
					<label>整形项目：</label>
					<input name="zxxm" class="" type="text" size="30" value="" alt=""/>
				</div>
				<div class="unit">
				<label>科室选择：</label>
				<?php echo $this->_var['product_cn']; ?>
				 </div>
				
				 <div class="unit">
				  <label>选择医生：</label>
				<?php echo $this->_var['doctor_cn']; ?>
				</div>
				 <div class="divider">divider</div>
				 <div class="unit">
				<p>
					<label>身份证号：</label>
					<input name="card" class="" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>客户邮箱：</label>
					<input name="mail"  class="email" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>QQ号：</label>
					<input name="qq" class="" type="text" size="30" value="" alt=""/>
				</p>
				 <p>
					<label>客户地址/单位：</label>
					<input name="address" class="" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>来源关键词：</label>
					<input name="keyword" class="" type="text" size="30" value="" alt=""/>
				</p>
				
				</div>
			<div class="unit">
				<label>备注：</label>
				<textarea  name="intro" rows="6" cols="45" ></textarea>
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

<script>
$(function(){
 
$('#search_auto').css({'width':$('#search input[name="k"]').width()+4});
$('#search input[name="k"]').keyup(function(){
$.post('?action=info&do=chaxun',{'value':$(this).val()},function(data){
if(data=='0') $('#search_auto').html('').css('display','none');
else $('#search_auto').html(data).css('display','block');
});
});
 
});
</script>