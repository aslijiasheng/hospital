<style type="text/css">
	ul.rightTools {float:right; display:block;}
	ul.rightTools li{float:left; display:block; margin-left:5px}
</style>
<form id="pagerForm" method="post" action="index.php?action=config">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=config" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						名称:<input type="text" name="title" size="10"/>
					</td>
					<td>
						类型:<?php echo $this->_var['select_type_cn']; ?>
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
		<div  style="float:left;  overflow:auto; width:170px; line-height:21px; background:#fff; ">
		<div class="panelBar"></div>
				    <ul class="tree treeFolder" layoutH="70">
						<li><a href="javascript">栏目分类</a>
							<ul>
								<?php echo $this->_var['row1']['type']; ?>
							</ul>
						</li>
						
				     </ul>
			</div>

		<div id="confingBox" class="unitBox" style="float:left; width:78%; border:solid 1px #b8d0d6;border-top:none;borter-bottom:none; line-height:21px; background:#fff;">
		
		<div class="panelBar">
			<ul class="toolBar">				
				<li><a class="add" href="?action=config&do=new&lmid=<?php echo $this->_var['row1']['lmid']; ?>" target="dialog"><span>添加</span></a></li>
				<li><a class="edit" href="?action=config&do=edit&id={id}" target="dialog"><span>修改</span></a></li>
				<li><a class="delete" href="?action=config&do=del&id={id}" target="ajaxTodo" title="配置关联项目很多,不建议删除!<br/>您针对确定要删除吗?"><span>删除</span></a></li>
				<li class="line">line</li>
				
			</ul>
		</div>		
		<table class="list" layouth="97" style="width:95%">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">类型</th>
					<th align="center">名称</th>
					<th align="center">创建时间</th>
					<th align="center">更新时间</th>
					<th align="center">状态</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['type_cn']; ?></td>
					<td><?php echo $this->_var['row']['title']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['updated_at']; ?></td>
					<td><?php echo $this->_var['row']['xs_cn']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>

	  </div>
</div>


	

