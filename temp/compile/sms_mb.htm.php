<form id="pagerForm" method="post" action="?action=smsmail&do=smsmb">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page" >
 <div class="pageHeader" >
	<form id="pagerForm" onsubmit="return dialogSearch(this);" action="?action=smsmail&do=smsmb" method="post">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td >
					短信内容:
					<input type="text" value=""  name="intro" size="36">
				</td>
				<td >
				<?php echo $this->_var['smslm_cn']; ?>
				</td>
				<td><div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div></td>
				<td><a class="buttonActive" href="?action=smsmail&do=smsmb&id=" target="dialog"><span>刷新</span></a></td>
				<td>操作后要点下刷新，才会刷新数据</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
		<div style="height:350px;">
				<div layoutH="20" style="float:left; display:block; overflow:auto; width:180px; border:solid 1px #CCC; line-height:21px; background:#fff; border-left:solid 0px #CCC;">
				    <ul class="tree treeFolder expand" oncheck="kkk">
						<li ><a href="javascript" >系统共用</a>
							
							<ul><?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
								<li><a href="?action=smsmail&do=smsmb&id=<?php echo $this->_var['row']['id']; ?>" target="ajax" rel="smsbox"><?php echo $this->_var['row']['title']; ?></a></li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</li>
						<li><a href="javascript">我的短信</a>
							<ul><?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
								<li><a href="?action=smsmail&do=smsmb&id=<?php echo $this->_var['row']['id']; ?>" target="ajax" rel="smsbox"><?php echo $this->_var['row']['title']; ?></a></li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</li>
						<li><a href="javascript" >栏目操作</a>
							<ul>
								<li><a href="tpl/sms_lm_new.htm" target="ajax" rel="smsbox">创建栏目</a></li>
								<li><a href="?action=smsmail&do=smslmxg&id=" target="ajax" rel="smsbox">修改栏目</a></li>
								<li><a href="?action=smsmail&do=smslmxg&id=del" target="ajax" rel="smsbox">删除栏目</a></li>
							</ul>
						</li>
				     </ul>
				</div>
	<div class="panelBar top2">
		<ul class="toolBar">
			<li><a class="add" href="?action=smsmail&do=smsnew2" target="ajax" rel="smsbox"><span>添加</span></a></li>
			<li><a class="delete" href="?action=smsmail&do=sms2del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="?action=smsmail&do=sms2xg&id={id}" target="dialog" mask="true"><span>修改</span></a></li>
		</ul>
	</div>				
				<div id="smsbox" class="unitBox" style="margin-left:181px;">

				  
	<table class="table" width="99%" layoutH="110" rel="smsbox">
		<thead>
				<tr>
					<th  orderfield="id">id</th>
					<th orderfield="intro">短信内容</th>
					<th width="30">选择</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['intro']; ?></td>
					<td>
					<a class="btnSelect" href="javascript:$.bringBack({intro:'<?php echo $this->_var['row']['intro']; ?>'})" title="查找带回">选择</a>
				</td>
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


	

