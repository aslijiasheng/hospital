<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="created_at" value="<?php echo $this->_var['row']['created_at']; ?>" />
		<input type="hidden" name="salesid" value="<?php echo $this->_var['row']['salesid']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称： </label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>	
				</div>
				<div class="unit">
					<label>客户电话：</label>
					<input name="tel" class="" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>" alt=""/>
				</div>
				<div class="unit">
				<p>
					<label>预约时间：</label>
					<input name="yy_at"  type="text" size="20" value="<?php echo $this->_var['row']['yy_at']; ?>" class="date" readonly="true"/>
					<a class="inputDateButton" href="javascript:;">选择</a>
				</p>
				<p>
					<label class="required">性别：</label>
                    <input type="radio" name="xb"  value="女" <?php echo $this->_var['row']['checked0']; ?> />女
                    <input type="radio" name="xb"  value="男" <?php echo $this->_var['row']['checked1']; ?> />男
				</p>
				<p>
					<label>年龄：</label>					
					<input name="nl" class="" type="text" size="10" value="<?php echo $this->_var['row']['nl']; ?>" alt=""/>
				</p>
				</div>
				<div class="divider">divider</div>
				<?php if ($_SESSION['roleid'] == "1"): ?>
				 <div class="unit">
					<label>登记人调整：</label>
					<?php echo $this->_var['salesid_cn']; ?>
				</div>
				<div class="divider">divider</div><?php endif; ?>
				<div class="unit">
					<p>
					<label>预约方式：</label>
					<?php echo $this->_var['typeid_cn']; ?>
					<?php echo $this->_var['areaid_cn']; ?>
					</p><?php if ($_SESSION['roleid'] == "1"): ?>
					<p>
					<label>上线选择：</label>
					<input name="sx.id"  type="text" size="30" value="<?php echo $this->_var['row']['parentid']; ?>" style="display:none;"/>
                    <input name="sx.name"  type="text" size="20" value="<?php echo $this->_var['row']['sxname']; ?>" readonly/>
					<a class="btnLook" href="?action=info&do=listsx" lookupGroup="sx" >上线选择》》</a>	
				    </p><?php endif; ?>
				</div>
				<div class="unit">
					<label>整形项目：</label>
					<input name="zxxm" class="" type="text" size="30" value="<?php echo $this->_var['row']['zxxm']; ?>"/>
				</div>

				<div class="unit">
					<label>科室选择：</label>
					<?php echo $this->_var['product_cn']; ?>
				</div>
				<div class="unit">
					<label>医生选择：</label>
					<?php echo $this->_var['doctor_cn']; ?>
				</div>
				<div class="divider">divider</div>
				<div class="unit">
				<p>
					<label>身份证号：</label>
					<input name="card" class="" type="text" size="30" value="<?php echo $this->_var['row']['card']; ?>" alt=""/>
				</p>
				<p>
					<label>客户邮箱：</label>
					<input name="mail" class="" type="text" size="30" value="<?php echo $this->_var['row']['mail']; ?>" alt=""/>
				</p>
				<p>
					<label>QQ号：</label>
					<input name="qq" class="" type="text" size="30" value="<?php echo $this->_var['row']['qq']; ?>" alt=""/>
				</p>
				<p>
					<label>客户地址/单位：</label>
					<input name="address" class="" type="text" size="30" value="<?php echo $this->_var['row']['address']; ?>" alt=""/>
				</p>
				<p>
					<label>来源关键词：</label>
					<input name="keyword" type="text" size="30" value="<?php echo $this->_var['row']['keyword']; ?>" alt=""/>
				</p>
				</div>
				<div class="unit">
					<label>备注：</label>
					<textarea class="xheditor" name="intro" rows="6" cols="45"  tools="mini"><?php echo $this->_var['row']['intro']; ?></textarea>
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