<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=zhiliao&do=edit" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />

			<div class="pageFormContent" layoutH="56">
				<div  >
					<label>客户名称：</label>
					<input name="k" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>#<?php echo $this->_var['row']['tel']; ?>" readonly="true"/>	
					<span class="inputInfo"><a href="?action=info&do=show&id=<?php echo $this->_var['row']['infoid']; ?>" style="color:#f00;" target="dialog">[预约资料]</a></span>	</div>
					<div class="unit">
					<label>治疗时间：</label>
					<input name="zhiliao_at"  type="text" size="30" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" value="<?php echo $this->_var['row']['zhiliao_at']; ?>" readonly="true"/>
					<span class="inputInfo">预约治疗大概时间</span>
				    </div>
				<div class="divider d">divider</div>
				<table class="list"  style="width:469px">
			<thead>
				<tr>
					<th align="center">派单id</th>
					<th align="center">项目名称</th>
					<th align="center">疗程次数</th>
					<th align="center">已治疗</th>
					<th align="center">派单时间</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_69451300_1396662970');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_69451300_1396662970']):
?>
				<tr target="id" rel="<?php echo $this->_var['row_0_69451300_1396662970']['id']; ?>" >
					<td ><input name="zlid[]" value="<?php echo $this->_var['row_0_69451300_1396662970']['id']; ?>" type="checkbox" checked="checked"></td>
					<td><input name="title[]" type="text" size="30" value="<?php echo $this->_var['row_0_69451300_1396662970']['title']; ?>" alt=""/></td>
					<td><input name="num[]" type="text" size="5" value="<?php echo $this->_var['row_0_69451300_1396662970']['num']; ?>" alt=""/></td>
					<td><?php echo $this->_var['row_0_69451300_1396662970']['num_z']; ?></td>
					<td><?php echo $this->_var['row_0_69451300_1396662970']['created_at']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
				<div class="unit" style="display:none;">
				  <label>治疗项目：</label>
				<input name="zxxm" type="text" size="30" value="<?php echo $this->_var['row']['zxxm']; ?>" alt=""/>	
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
					<label>派单备注：</label>
					<textarea name="intro"  cols="45" rows="3"><?php echo $this->_var['row']['intro']; ?></textarea>
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

