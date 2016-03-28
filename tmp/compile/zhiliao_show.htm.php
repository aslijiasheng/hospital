
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
				</p>
				<p>
					<label>派单人：</label>
					<?php echo $this->_var['row']['salesid_txt']; ?>
				</p>
				<p>
					<label>到诊情况：</label>
					<?php echo empty($this->_var['row']['fz']) ? '不详' : $this->_var['row']['fz']; ?>
				</p>
				<p>
					<label>治疗科室：</label>
					<?php echo $this->_var['row']['productid_txt']; ?>
				</p>
				<p>
					<label>治疗项目：</label>
					<?php echo $this->_var['row']['zxxm']; ?>
				</p><p>
					<label>治疗医生：</label>
					<?php echo $this->_var['row']['doctorid_txt']; ?>
				</p>
				<p>
					<label>派单时间：</label>
					<?php echo $this->_var['row']['created_at']; ?>
				</p>				
				<p>
					<label>备注：</label>
					<?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?>
				</p>
			</div>
	</div>
</div>