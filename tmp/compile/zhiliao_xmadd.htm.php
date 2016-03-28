<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=zhiliao&do=xmadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['infoid']; ?>" />
		<input type="hidden" name="sellid" value="<?php echo $this->_var['row']['sellid']; ?>" />
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<div class="pageFormContent" layoutH="56">
					<table class="list nowrap itemDetail" addButton="增加治疗项目" width="90%">
						<thead>
							<tr>
								<th type="text" name="zlxm.id[]" defaultVal="#index#" size="3" fieldClass="digits">排序</th>
								<th type="text" name="zlxm.title[]" size="30" fieldClass="required">治疗项目</th>
								<th type="text" name="zlxm.num[]" size="3" fieldClass="digits">治疗次数</th>
								<th type="del" width="60">操作</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				<div class="divider d">divider</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>

