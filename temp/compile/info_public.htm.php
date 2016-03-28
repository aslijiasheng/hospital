
<form id="pagerForm" method="post" action="index.php?action=info&list=public">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="typeid"  value="<?php echo $this->_var['typeid']; ?>"/>
	<input type="hidden" name="salesid2"  value="<?php echo $this->_var['salesid2']; ?>"/>
	<input type="hidden" name="productid"  value="<?php echo $this->_var['productid']; ?>"/>
	<input type="hidden" name="visitnum"  value="<?php echo $this->_var['visitnum']; ?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start']; ?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over']; ?>"/>
	<input type="hidden" name="nt"  value="<?php echo $this->_var['nt']; ?>"/>
	<input type="hidden" name="zxxm"  value="<?php echo $this->_var['zxxm']; ?>"/>
	<input type="hidden" name="doctorid"  value="<?php echo $this->_var['doctorid']; ?>"/>
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=info&list=public" name="form1" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12" x-webkit-speech lang="zh-CN" />
					</td>
					<td>
						登记时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					 <td>
					<input type="radio" name="visitnum"  value=">=" />已到院
						<input type="radio" name="visitnum"  value="<" />未到院
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit" name="submit">搜 索</button></div></div>
					</td>
				</tr>
				
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
			    <li><a class="add" href="?action=info&do=receive&id={id}" target="ajaxTodo" title="确定要领取该客户?"><span>领取</span></a></li>
				<li><a class="edit" href="?action=info&do=edit&id={id}" target="navTab" rel="infoedit"><span>修改</span></a></li>
				<li><a class="show" href="?action=info&do=log&id={id}" target="dialog" height="450" width="800"><span>查看客户日志</span></a></li>
				<li><a class="show" href="?action=info&do=show&id={id}" target="dialog"><span>查看明细</span></a></li>
				<li class="line">line</li>
				<?php if ($_SESSION['roleid'] == "1"): ?>
				<li><a class="delete" href="?action=info&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<?php endif; ?>
			</ul>
		</div><style type="text/css">
		<!--
		.ks{float:left;width:81%;overflow:hidden;}
		.ksc{width: 100%;overflow:hidden;}
		-->
		</style>
		<div class="ksc">
		<div class="ks" >
		<table class="table" layouth="114" style="width:100%;float:left;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">登记时间</th>
					<th align="center" style="width:60px;">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">年龄</th>
					<th align="center">登记人</th>
					<th align="center">来院</th>
					<th align="center">回访</th>
					<th align="center">区域</th>
					<th align="center">预约方式</th>
					<th align="center">预约时间</th>
					<th align="center">预约科室</th>
					<th align="center">预约医生</th>
					<th align="center">预约项目</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr class="cs" target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created']; ?></td>
					<td class="<?php echo $this->_var['row']['vip']; ?>"><a href="?action=info&do=intro&id=<?php echo $this->_var['row']['id']; ?>" target="ajax" rel="infopublic"><?php echo $this->_var['row']['name']; ?></a></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['nl']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
					<td><?php echo $this->_var['row']['hfnum']; ?></td>
					<td><?php echo $this->_var['row']['areaid_txt']; ?></td>
					<td><?php echo $this->_var['row']['typeid_txt']; ?></td>
					<td style="color:#f00;"><?php echo $this->_var['row']['yy_at']; ?></td>
					<td><?php echo $this->_var['row']['productid_txt']; ?></td>
					<td><?php echo $this->_var['row']['doctorid_txt']; ?></td>
					<td><?php echo $this->_var['row']['zxxm']; ?></td>
					
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		</div>
		<div id="infopublic"  style="width:19%;float:left;background:#fff;overflow:hidden;" layouth="94">
			
			<style type="text/css">
			<!--
				.accordionContent{font-size:12px;line-height:22px;}
				.accordionContent .nr{padding:3px;line-height:24px;width:96%;height: 92%;overflow:hidden;}
				a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;}
			-->
			</style>
		<div class="accordion" >
		<div class="accordionHeader">
			<h2>更多信息</h2>
		</div>
		<div class="accordionContent" layouth="146">
		<div class="nr">姓名：<?php echo $this->_var['row2']['name']; ?>&<?php echo $this->_var['row2']['tel']; ?><br/>
		&#9758;<?php echo $this->_var['row2']['intro']; ?><br/>
		<div class="divider">divider</div>
		<span style="color:#f00;">来院记录》</span>
		<div class="nr"><iframe
src="?action=sell&do=chaxun1&id=<?php echo $this->_var['row2']['id']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
		</div>
		<div class="accordionHeader">
			<h2>回访记录</h2>
		</div>
		<div class="accordionContent" layouth="146">
			<div class="nr"><iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row2']['id']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
		
	</div>
		 </div>
		</div>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>
