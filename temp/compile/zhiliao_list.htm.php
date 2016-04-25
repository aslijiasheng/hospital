<form id="pagerForm" method="post" action="index.php?action=zhiliao">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="state" value="<?php echo $this->_var['state']; ?>" />
	<input type="hidden" name="salesid" value="<?php echo $this->_var['salesid']; ?>" />
	<input type="hidden" name="paidanid" value="<?php echo $this->_var['paidanid']; ?>" />
    <input type="hidden" name="numPerPage" value="20" />
</form>
<style type="text/css">
<!--
 form.tj{float:left;}
table.list td a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;font-size:12px;}
.sxm,.sxm2{width: 120px;overflow:hidden;background:transparent;border:1px solid #000;}
.sxm2 option{overflow:hidden;cursor:pointer;}
-->
</style>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=zhiliao" method="post" class="tj">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						客户名称:<input type="text" name="name" size="12"/>
					</td>
					<td>
						客户电话:<input type="text" name="tel" size="12"/>
					</td>
					<td>
						派单时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>					
					<td>
					<?php echo $this->_var['paidan_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					 <td>
					<input type="radio" name="state"  value="2" />未成交
						<input type="radio" name="state"  value="1" />已成交
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">				
				<li><a class="add" href="?action=zhiliao&do=single" target="dialog" rel="single" height="400" width="650"><span>新增记录</span></a></li>
				<li><a class="add" href="?action=zhiliao&do=xmadd&id={id}" target="dialog" rel="xmadd" ><span>增加治疗项目</span></a></li>
				<li><a class="shoufei" href="?action=money&do=pay&id2={id}" target="dialog"><span>收费</span></a></li>
				<li><a class="show" href="?action=zhiliao&do=show&id={id}" target="dialog"><span>查看明细</span></a></li>
				<li><a class="show" href="?action=sell&do=show&id2={id}" target="dialog" width="800" height="302"><span>来访明细</span></a></li>
				<li><a class="huifang" href="?action=visits&do=new&id1={id}" target="dialog"><span>回访</span></a></li>
				<li><a class="edit" href="?action=zhiliao&do=edit&id={id}" target="dialog" height="400" width="650"><span>修改</span></a></li>
			
				<li><a class="delete" href="?action=zhiliao&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			
			</ul>
		</div>
		<table class="list" layouth="91" style="width:95%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">派单时间</th>
					<th align="center">客户名称</th>
					<th align="center">性别</th>
					<th align="center">预约治疗</th>
					<th align="center">派单人</th>
					<th align="center">登记人</th>
					<th align="center">客户电话</th>
					<th align="center">治疗项目</th>
					<th align="center">治疗科室</th>
					<th align="center">治疗医生</th>
					<th align="center">来访id</th>
					<th align="center">状态</th>
					<th align="center">备注</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_90441900_1396488630');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_90441900_1396488630']):
?>
				<tr target="id" rel="<?php echo $this->_var['row_0_90441900_1396488630']['id']; ?>,<?php echo $this->_var['row_0_90441900_1396488630']['infoid']; ?>,<?php echo $this->_var['row_0_90441900_1396488630']['sellid']; ?>" >
					<td><?php echo $this->_var['row_0_90441900_1396488630']['id']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['created_at']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['name']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['xb']; ?></td>
					<td style="color:#f00;"><?php echo $this->_var['row_0_90441900_1396488630']['zhiliao_at']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['salesidinfo_txt']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['dh_txt']; ?></td>
					<td><select class="sxm" > <?php echo $this->_var['row_0_90441900_1396488630']['zxxm_txt']; ?><?php echo $this->_var['row_0_90441900_1396488630']['pd_txt']; ?></select><a class="an" href="?action=zhiliao&do=xmadd&id=<?php echo $this->_var['row_0_90441900_1396488630']['sellid']; ?>" target="dialog" rel="xmadd" <?php echo $this->_var['row_0_90441900_1396488630']['xs']; ?>>添加治疗项目</a></td>
					<td> <?php echo $this->_var['row_0_90441900_1396488630']['productid_txt']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['doctorid_txt']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['sellid']; ?></td>
					<td><?php echo $this->_var['row_0_90441900_1396488630']['state_txt']; ?></td>
					<td><select class="sxm2" title="<?php echo $this->_var['row_0_90441900_1396488630']['intro']; ?>"><option ><?php echo $this->_var['row_0_90441900_1396488630']['intro']; ?></option></select></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共派单<?php echo $this->_var['total']; ?>次&#9786;派单客人<?php echo $this->_var['row']['num']; ?>个</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>
