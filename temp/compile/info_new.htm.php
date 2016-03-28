<script type='text/javascript' src='javascripts/tags/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="javascripts/tags/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="javascripts/tags/jquery.tagsinput.css" />
<script src="javascripts/tags/jquery.tagsinput.js"></script>
<script type="text/javascript">
$('#tags').tagsInput({
'width':'330px',
'height':'50px',
'defaultText':'增加治疗项目', //默认文字
'removeWithBackspace' : true, //是否允许使用退格键删除前面的标签，false为阻止
autocomplete_url:'?action=info&do=chaxun2',
autocomplete:{selectFirst:true,width:'150px',autoFill:true}
});
</script>
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
		<form method="post" action="?action=info&do=new" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
				<div class="tabs"  eventType="click" >
					<div class="tabsHeader">
						<div class="tabsHeaderContent">
							<ul>
								<li><a href="javascript:;"><span>基本信息</span></a></li>
								<li><a href="javascript:;"><span>详细信息</span></a></li>
								<li><a href="javascript:;"><span>管理信息</span></a></li>
							</ul>
						</div>
					</div>
					<div class="tabsContent" >
						<div>
							<p>
								<label>客户名称：</label>
								<input name="name" class="required" type="text" size="30" value="" alt=""/>
							</p>
							<div id="search" class="unit"><label>客户电话：</label>
							<input name="k"  type="text" size="30" value="" />
							<span class="inputInfo">多号码登记请用"/"隔开</span>
							</div>
							<div id="search_auto"></div>
				
							<p>
								<label>预约时间：</label>
								<input name="yy_at"  type="text" size="15" class="date" readonly="true"/>
							</p>
							<div class="unit">
							<p style="width:250px;float:left">
								<label>性别：</label>
								<input type="radio" name="xb"  value="女" checked="checked"/>女
								<input type="radio" name="xb"  value="男" />男
							</p>
							<p style="width:250px;float:left">
								<label style="width:60px;">年龄：</label>
								<input name="nl" class="" type="text" size="8" value="" alt="" style="float:left"/>
							</p>
							</div>
							<div class="divider">divider</div>
							<div class="unit">
								<p>
								<label>预约方式：</label>
								<?php echo $this->_var['typeid_cn']; ?>
								<?php echo $this->_var['areaid_cn']; ?>
								</p>
							</div>
				
							<div class="unit">
								<label>治疗项目：</label>
								<input name="zxxm" class="" type="text" size="30"   />
							</div>
							<div class="unit">
							<label>科室选择：</label>
								<?php echo $this->_var['product_cn']; ?>
							</div>
				
							<div class="unit">
								<label>选择医生：</label>
								<?php echo $this->_var['doctor_cn']; ?>
							</div>
							<div class="unit">
								<label>备注：</label>
								<textarea  name="intro" rows="6" cols="45" ></textarea>
							</div>
						</div>
						<div>
						
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
						</div>
						<div>
							<?php if ($_SESSION['roleid'] == "1"): ?>
						<p>
						<label>上线选择：</label>
						<input name="sx.id"  type="text" size="30" value="" style="display:none;"/>
						<input name="sx.name"  type="text" size="20" value="" readonly/>
						<a class="btnLook" href="?action=info&do=listsx"  lookupGroup="sx" >上线选择》》</a>	
						</p><?php endif; ?>
						</div>
					</div>
					<div class="tabsFooter">
						<div class="tabsFooterContent"></div>
					</div>
				</div></div>
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
$('#search_auto').css({'width':$('#search input[name="k"]').width()+10});
$('#search input[name="k"]').change(function(){
$.post('?action=info&do=chaxun',{'value':$(this).val()},function(data){
if(data=='0') $('#search_auto').html('').css('display','none');
else $('#search_auto').html(data).css('display','block');
});
}); 
});
</script>
