<form id="pagerForm" method="post" action="index.php?action=sell">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="typeid"  value="<?php echo $this->_var['typeid'];?>"/>
	<input type="hidden" name="salesid"  value="<?php echo $this->_var['salesid'];?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start'];?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over'];?>"/>
	<input type="hidden" name="fz"  value="<?php echo $this->_var['fz'];?>"/>
	<input type="hidden" name="productid"  value="<?php echo $this->_var['productid']; ?>"/>
</form>
<style type="text/css">
<!--
 form.tj{float:left;}
 /* level*/
.sxm{width: 150px;overflow:hidden;background:transparent;border:1px solid #000;}
td.zlff{overflow:hidden;width: 100px;white-space:nowrap;text-overflow:ellipsis;}
td.zlff a{font-size:12px;display:block;}
-->
</style>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=sell" method="post" class="tj">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话: <input type="text" name="nt" size="12"/>
					</td>
					 <td>
						<?php echo $this->_var['diagnosis_cn']; ?>
					</td>
					<td>
						来访时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>					
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
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
			    <!--<li><a class="edit" href="?action=zhiliao&do=single&id={id}" target="dialog" rel="zhiliao"><span>派单</span></a></li>-->
				<li><a class="shoufei" href="?action=sell&do=print&id={id}" target="dialog" height="350" ><span>打印信息</span></a></li>
				<li><a class="shuangchuan" href="?action=sell&do=tpad&id={id}" target="navTab" rel="picadd" ><span>上传图片</span></a></li>
				<li class="line">line</li>
				<li><a class="shoufei" href="?action=money&do=pay&id={id}" target="dialog"><span>收费</span></a></li>
				<li><a class="huiyuan" href="?action=info&do=agent&id1={id}" target="dialog"><span>设为会员</span></a></li>
				<li class="line">line</li>
				<!--<li><a class="ksdj" href="?action=section&do=new&id={id}" target="dialog" rel="section"><span>科室登记</span></a></li>-->
				<li><a class="huifang" href="?action=visits&do=new&id1={id}" target="dialog"><span>回访</span></a></li>
				<li><a class="duanxin" href="?action=smsmail&do=sms&id1={id}" target="dialog" width="600" height="330" rel="sms"><span>短信</span></a></li>
				<li><a class="show" href="?action=sell&do=show&id={id}" target="dialog" width="800" height="302"><span>明细</span></a></li>
				<li><a class="huifang" href="?action=sell&do=picview&id1={id}" target="navTab" rel="picview"><span>图片对比</span></a></li>
				<li><a class="edit" href="?action=sell&do=edit&id={id}" target="dialog" height="350" width="600"><span>修改</span></a></li>
				 <?php if ($_SESSION['roleid'] == "1"): ?>
				<li><a class="delete" href="?action=sell&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<?php endif; ?>
			</ul>
		</div>
		<style type="text/css">
		<!--
		.ks{float:left;width:81%;overflow:hidden;}
		.ksc{width:100%;overflow:hidden;}
		-->
		</style>
		<div class="ksc">
		<div class="ks" >
		<table class="list" layouth="94" style="width:100%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">挂号时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">接待人</th>
					<th align="center">登记人</th>
					<th align="center">预约方式</th>
					<th align="center">挂号科室</th>
					<th align="center">挂号医生</th>
					<th align="center">挂号项目</th>
					<th align="center">复诊次数</th>
					<th align="center">到诊情况</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>,<?php echo $this->_var['row']['infoid']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created']; ?></td>
					<td class="<?php echo $this->_var['row']['vip']; ?> zlff"><a href="?action=sell&do=intro&id=<?php echo $this->_var['row']['id']; ?>" target="ajax" rel="sellBox"><?php echo $this->_var['row']['name']; ?></a></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['salesid2_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['typeid_txt']; ?></td>
					<td><?php echo $this->_var['row']['productid_txt']; ?></td>
					<td><?php echo $this->_var['row']['doctorid_txt']; ?></td>
					<td class="zlff"> <?php echo $this->_var['row']['zxxm']; ?> | <?php echo $this->_var['row']['item']; ?></td>

					<td><?php echo $this->_var['row']['fz_count']; ?></td>
					<td><?php echo $this->_var['row']['fz_cn']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		</div>
		<div id="sellBox"  style="width:18%;float:left;background:#fff;overflow:hidden;" layouth="94">
			
			<style type="text/css">
				<!--
				.accordionContent{font-size:12px;}
				.accordionContent .nr{padding:3px;line-height:24px;width:95%;height: 92%;overflow:hidden;}
				-->
			</style>
		<div class="accordion" >
		<div class="accordionHeader">
			<h2>更多信息</h2>
		</div>
		<div class="accordionContent" layouth="146">
		<div class="nr">
		来访备注：<?php echo $this->_var['row2']['intro']; ?></br>
		预约信息：</br>
		<iframe
src="?action=info&do=chaxun1&id=<?php echo $this->_var['row2']['infoid']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
		<div class="accordionHeader">
			<h2>回访记录</h2>
		</div>
		<div class="accordionContent" layouth="146">
			<div class="nr"><iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row2']['infoid']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
	</div>
		 </div>
		</div>
		<div class="panelBar">
			<div class="pages">
				<span>共来访<?php echo $this->_var['total']; ?>次&#9786;来访<?php echo $this->_var['list2']['num']; ?>个（初诊<?php echo $this->_var['list2']['num2']; ?>个|复诊<?php echo $this->_var['list2']['num3']; ?>个|复诊次数<?php echo $this->_var['list2']['num4']; ?>个）</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="6" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>
