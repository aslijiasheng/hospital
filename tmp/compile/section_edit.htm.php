
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=section&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="zid" value="<?php echo $this->_var['row']['zlid']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<input name="xm" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" readonly/>
				</div>
				<div class="unit">
					<label class="required">到诊详细：</label>
                    <input type="text" name="dzxx"  size="30" value="<?php echo $this->_var['row']['xb']; ?> 电话：<?php echo $this->_var['row']['tel']; ?>"  readonly/>
				</div>
				<div class="divider d">divider</div>
			<table class="list"  style="width:469px">
			<thead>
				<tr>
					<th align="center">项目id</th>
					<th align="center">项目名称</th>
					<th align="center">疗程次数</th>
					<th align="center">已治疗次数</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_65625200_1375673013');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_65625200_1375673013']):
?>
				<tr target="id" rel="<?php echo $this->_var['row_0_65625200_1375673013']['id']; ?>" >
				<td><?php echo $this->_var['row_0_65625200_1375673013']['id']; ?></td>
					<td><?php echo $this->_var['row_0_65625200_1375673013']['title']; ?></td>
					<td><?php echo $this->_var['row_0_65625200_1375673013']['num']; ?></td>
					<td><?php echo $this->_var['row_0_65625200_1375673013']['num_z']; ?></td>
					<td ><input name="zlid[]" value="<?php echo $this->_var['row_0_65625200_1375673013']['id']; ?>" type="checkbox" checked="checked"></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
			</table>
				<div class="unit">
					<label>其他项目：</label>
					<input name="zdjg"  type="text" size="30" value="<?php echo $this->_var['row']['zdjg']; ?>" />
				</div>
				<div class="divider d">divider</div>
				<div class="unit">
					<label>治疗方法：</label>
					<input name="zlff"  type="text" size="30" value="<?php echo $this->_var['row']['zlff']; ?>"/>
				</div>
				<div class="unit">
					<label>治疗次数：</label>
					<input name="zlcs"  type="text" size="5" value="<?php echo $this->_var['row']['zlcs']; ?>"/>
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
					<input name="zx.orgxh"  type="text" size="30" value="<?php echo $this->_var['row']['zxr']; ?>" style="display:none;"/>
                    <input name="zx.orgName"  type="text" size="30" value="<?php echo $this->_var['row']['zxr_txt']; ?>" readonly/>
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