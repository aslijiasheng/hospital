<style type="text/css">
<!--

.search span{float:left;line-height:25px;}
-->
</style>
<div class="pageContent search">
	<form  onsubmit="return navTabSearch(this);" action="index.php?action=info" name="form1" method="post">
		<div class="pageFormContent" layoutH="58">
			<div class="unit">
				<label>姓名(或)电话：</label>
				<input type="text" name="nt" size="25" x-webkit-speech lang="zh-CN" />
			</div>
			<div class="divider">divider</div>
			<div class="unit">
				<label>登记时间：</label>
				<input type="text" name="time_start" size="9" class="date" readonly="true" />
						<span>--</span><input type="text" name="time_over" size="9" class="date" readonly="true" />
			</div>
			<div class="unit">
				<label>预约时间：</label>
				<input type="text" name="yy_at" size="9" class="date" readonly="true" />
			</div>
			<div class="unit">
				<label>是否到院：</label>
				<input type="radio" name="visitnum"  value=">=" />已到院
						<input type="radio" name="visitnum"  value="<" />未到院
			</div>
			<div class="divider">divider</div>
			<div class="unit">
				<?php echo $this->_var['salesid_cn']; ?><?php echo $this->_var['typeid_cn']; ?><?php echo $this->_var['product_cn']; ?><?php echo $this->_var['doctor_cn']; ?><?php echo $this->_var['parentid_cn']; ?>
			</div>
			<div class="divider">divider</div>
			<div class="unit">
			<label>上线选择：</label>
					<input name="sx.id"  type="text" size="30" value="" style="display:none;"/>
                    <input name="sx.name"  type="text" size="25" value="" readonly/>
					<a class="btnLook" href="?action=info&do=listsx"  lookupGroup="sx" >上线选择》》</a>
			</div>
			<div class="unit">
				<label>预约项目：</label>
				<input type="text" name="zxxm" size="25" x-webkit-speech lang="zh-CN" />
			</div>
			<div class="unit">
				<label>会员卡号：</label>
				<input type="text" name="card" size="25" x-webkit-speech lang="zh-CN" />
			</div>
			<div class="unit">
				<label>Q Q号：</label>
				<input type="text" name="qq" size="25" x-webkit-speech lang="zh-CN" />
			</div>
			<div class="unit">
				<label>备 注：</label>
				<textarea type="text" name="intro" rows="6" cols="45" x-webkit-speech lang="zh-CN" /></textarea>
			</div>
			
			<div class="divider">divider</div>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">开始搜索</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="reset">清空重输</button></div></div></li>
			</ul>
		</div>
	</form>
</div>