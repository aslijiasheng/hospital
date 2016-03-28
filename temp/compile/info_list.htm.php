<form id="pagerForm" method="post" action="index.php?action=info">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="typeid"  value="<?php echo $this->_var['typeid']; ?>"/>
	<input type="hidden" name="salesid"  value="<?php echo $this->_var['salesid']; ?>"/>
	<input type="hidden" name="productid"  value="<?php echo $this->_var['productid']; ?>"/>
	<input type="hidden" name="visitnum"  value="<?php echo $this->_var['visitnum']; ?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start']; ?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over']; ?>"/>
	<input type="hidden" name="nt"  value="<?php echo $this->_var['nt']; ?>"/>
	<input type="hidden" name="zxxm"  value="<?php echo $this->_var['zxxm']; ?>"/>
	<input type="hidden" name="doctorid"  value="<?php echo $this->_var['doctorid']; ?>"/>
	<input type="hidden" name="sx_id"  value="<?php echo $this->_var['sx_id']; ?>"/>
	<input type="hidden" name="yyat"  value="<?php echo $this->_var['yyat']; ?>"/>
</form>
<style type="text/css">
<!--
.ito,.nto{background:url("themes/default/images/button/imgX.gif") -2px no-repeat; display:block; width:18px; height:18px; text-indent:-999px; overflow:hidden;}
.nto{background-position: -25px -1px}
-->
</style>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=info" name="form1" method="post">
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
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit" name="submit">搜 索</button></div></div>
					</td>
					<td>
					<div ><a class="button" href="?action=info&do=search" target="dialog" mask="true" rel="search" title="高级搜索" height="450" width="650"><span>高级搜索</span></a></div>
					</td>
				</tr>
				
			</table>
			
		</div>
		</form>
	</div>
	<style type="text/css">
	<!--
	.page .pageContent .panelBar{overflow:visible;}
	.page .pageContent .panelBar ul.toolBar{overflow:visible;}
	.page .pageContent .panelBar ul.toolBar li{overflow:visible;}
.nLi{position:relative; z-index:1;}
.sub2{top:0px;  position:absolute;border:none;width:120px;background:transparent;display:none;}
.sub2 div{background:#fff;color:#999;overflow:hidden;padding:0 5px;border:1px solid #b8d0d6;}
.sub2 div a.sun{height: 25px;width:104px;display:block;line-height:25px;background:none;width: 100%,}
.sub2 div a.sun:hover{background:none;background:#f5f5f5;text-decoration:none;width: 100%}
-->
</style>
	<div class="pageContent">
		<div class="panelBar" >
			<ul class="toolBar" style="overflow:visible;">
			    <li><a class="add" href="?action=info&do=new" target="dialog" rel="khdj" height="450" width="650" ><span>客户登记</span></a></li>
				<li class="line">line</li>
				<li><a class="laifang" href="?action=info&do=visit&id={id}" target="dialog" height="350" width="600"><span>挂号</span></a></li>
				<li><a class="show" href="?action=info&do=show&id={id}" target="dialog"  height="500" width="900"><span>查看明细</span></a></li>
				<li class="line">line</li>
				<li class="nLi" ><a class="huifang" href="?action=visits&do=new&id={id}" target="dialog" height="340" width="600"><span>回访</span></a>
					<ul class="sub2" style="left:-65px;">
							<div style="margin-top:25px;"><a class="sun" style="font-weight:400;font-size:12px;" href="?action=visits&do=new&id={id}" target="dialog" height="340" width="600">回访&回访提醒</a>
							<a class="sun" style="font-weight:400;font-size:12px;" href="?action=info&do=zyy&id={id}" target="dialog" >再次预约提醒</a></div>
					</ul>
				</li>
				<li class="nLi" ><a class="duanxin" href="?action=smsmail&do=sms&id={id}" target="dialog" width="600" height="330" rel="sms"><span>短信邮件</span></a>
					<ul class="sub2" style="left:-40px;">
							<div style="margin-top:25px;"><a class="sun" style="font-weight:400;font-size:12px;" href="?action=smsmail&do=sms&id={id}" target="dialog" width="600" height="330" rel="sms">发送短信</a>
							<a class="sun" style="font-weight:400;font-size:12px;" href="?action=smsmail&do=send&id={id}" target="dialog" height="550" width="800">发送邮件</a></div>
					</ul>
				</li>
				<li><a class="duanxin" href="?action=smsmail&do=smsyhq&id={id}" target="dialog" rel="sms"><span>优惠券</span></a></li>
				<li><a class="huiyuan" href="?action=info&do=agent&id={id}" target="dialog"><span>设为会员</span></a></li>
				<!--<li><a class="add" href="?action=smsmail&do=ewmnew&id={id}" target="dialog"><span>二维码</span></a></li>-->
                <li><a title="确实要放弃这些记录吗?" target="selectedTodo" rel="ids" posttype="string" href="?action=info&do=allgiveup&ids={ids}" class="delete"><span>批量放弃</span></a></li>
				
				<li><a class="show" href="?action=info&do=giveup&id={id}" target="dialog"><span>放弃</span></a></li>
				<li><a class="edit" href="?action=info&do=edit&id={id}" target="navTab" rel="infoedit"><span>修改</span></a></li>
				<li><a class="delete" href="?action=info&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<li class="line">line</li>
				<li><a class="show" href="?action=info&do=log&id={id}" target="dialog" height="450" width="800"><span>客户日志</span></a></li>
				<li><a class="icon" href="?action=info&do=date" target="dwzExport" ><span>导出EXCEL</span></a></li>
				<li><a class="icon" href="?action=info&date=dc" target="dwzExport" targetType="navTab" ><span>导出2EXCEL</span></a></li>
				<li class="nLi" ><a class="chazhao" href="javascript:"><span>其他</span></a>
					<ul class="sub2" style="left:-65px;">
							<div style="margin-top:25px;"><a class="sun" style="font-weight:400;font-size:12px;" href="template/sjjs_tj.htm" target="dialog">重复数据</a></div>
					</ul>
				</li>
				
			</ul>
			<script  type="text/javascript">
				jQuery(".toolBar").slide({type:"menu",titCell:".nLi", targetCell:".sub2", effect:"slideDown", delayTime:300 ,triggerTime:0, returnDefault:false});
				</script>
		</div><style type="text/css">
		<!--
		.ks{float:left;width:81%;overflow:hidden;}
		.ksc{width: 100%;overflow:hidden;}
		-->
		</style>
		<div class="ksc">
		<div class="ks" >
		<table class="list" layouth="94" style="width:98%;float:left;">
			<thead>
				<tr>
                    <th class="" style="width: 18px; cursor: default;"><div class="gridCol" title=""><input type="checkbox" group="ids" class="checkboxCtrl"></div></th>
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
                    <td style="width: 18px;"><div><input name="ids" value="<?php echo $this->_var['row']['id']; ?>" type="checkbox"></div></td>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created']; ?></td>
					<td class="<?php echo $this->_var['row']['vip']; ?>"><a href="?action=info&do=intro&id=<?php echo $this->_var['row']['id']; ?>" target="ajax" rel="infoBox" style="font-size:12px"><?php echo $this->_var['row']['name']; ?></a></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['nl']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td ><?php echo $this->_var['row']['visitnum_pic']; ?></td>
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
		<style type="text/css">
		<!--
		.nr{overflow-y:auto;padding:5px;color:#333;line-height:22px;}
		-->
		</style>
		<div id="infoBox"  style="width:19%;float:left;background:#fff;overflow:hidden;" layouth="94">
			
		<div class="accordion" >
		<div class="accordionHeader">
			<h2>更多信息</h2>
		</div>
		<div class="accordionContent" layouth="146" >
		<div class="nr" >姓名：<?php echo $this->_var['row2']['name']; ?>&<?php echo $this->_var['row2']['tel']; ?><br/>
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
			<span>每页显示：</span><select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>
