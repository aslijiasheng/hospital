<style type="text/css">
<!--
.sxm{width: 120px;overflow:hidden;background:transparent;border:1px solid #000;}
-->
</style>
<form id="pagerForm" method="post" action="index.php?action=section">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="zd"  value="<?php echo $this->_var['zd'];?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start'];?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over'];?>"/>
	<input type="hidden" name="tid"  value="<?php echo $this->_var['tid'];?>"/>
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=section" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名or电话:<input type="text" name="nt" size="12"/>
					</td>
					<td>
						诊断or治疗:<input type="text" name="zd" size="12"/>
					</td>
					<td>
						就诊时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<input type="hidden" name="tid"  value="<?php echo $this->_var['tid']; ?>"/>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">搜 索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="ksdj" href="?action=section&do=new&ksid=<?php echo $this->_var['tid']; ?>" target="dialog" rel="section" height="450" width="650"><span>新增登记</span></a></li>
				<li><a class="shuangchuan" href="?action=sell&do=tpad&ids={id}" target="navTab" rel="picadd" ><span>上传图片</span></a></li>
				<li><a class="duanxin" href="?action=smsmail&do=sms&id1={id}" target="dialog" width="600" height="330" rel="sms"><span>发送短信</span></a></li>
				<li><a class="huifang" href="?action=visits&do=new&id1={id}" target="dialog"><span>客户回访</span></a></li>
				<li><a class="huifang" href="?action=sell&do=picview&id1={id}" target="navTab" rel="picview"><span>图片对比</span></a></li>
				<li><a class="show" href="?action=sell&do=show&id2={id}" target="dialog" width="800" height="302"><span>明细</span></a></li>
				<li><a class="edit" href="?action=section&do=edit&id={id}" target="dialog" rel="section" height="450" width="650"><span>修改</span></a></li>
				<li><a class="delete" href="?action=section&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="95" style="width:95%;" >
			<thead>
				<tr>
					<th  align="center">ID</th>
					<th align="center">就诊ID</th>
					<th align="center">登记时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">年龄</th>
					<th align="center">治疗项目</th>
					<th align="center">治疗方法</th>
					<th align="center">疗程次数</th>
					<th align="center">主治医生</th>
					<th align="center">执行人</th>
					<th align="center">登记人</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>,<?php echo $this->_var['row']['infoid']; ?>,<?php echo $this->_var['row']['sellid']; ?>" >
				<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['sellid']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><a href="?action=sell&do=show&id=<?php echo $this->_var['row']['sellid']; ?>" target="dialog" width="800" height="302"><?php echo $this->_var['row']['name']; ?></a></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['nl']; ?></td>
					<td><select class="sxm" ><?php echo $this->_var['row']['zdjg_txt']; ?><?php echo $this->_var['row']['zl_txt']; ?></select></td>
					<td><?php echo $this->_var['row']['zlff']; ?></td>
					<td><?php echo $this->_var['row']['zlcs']; ?></td>
					<td><?php echo $this->_var['row']['doctorid_txt']; ?></td>
					<td><?php echo $this->_var['row']['zxr_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid_ks_txt']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="30" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>