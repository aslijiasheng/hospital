<form id="pagerForm" method="post" action="?action=zhtj&do=sjjs">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=info" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12"/>
					</td>

					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
					</td>
					<td>
					搜索重复数据
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
			<form onsubmit="return navTabSearch(this);" action="?action=zhtj&do=sjjs" method="post">
			    <li><input type="radio" name="ms"  value="tel" checked="checked"/>按电话
                    <input type="radio" name="ms"  value="name" />按姓名</li>
					<li><button type="submit">搜索</button></li>
			  </form>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:500px;">
			<thead>
				<tr>
					<th align="center">客户电话</th>
					
					<th align="center">重复次数</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td ><?php echo $this->_var['row']['tel']; ?></td>
					<td><?php echo $this->_var['row']['dd']; ?></td>
					<td ><a href="?action=zhtj&do=sjjs2&tel=<?php echo $this->_var['row']['tel']; ?>" target="navTab" rel="重复详细">详细</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条，有重复的数据/每页显示50条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>