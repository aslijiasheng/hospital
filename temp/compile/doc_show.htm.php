<style type="text/css">
<!--
.title h1{text-align:center;line-height:50px;font-size:18px;font-weight:bold;}
.lm{text-align:center;}
#show{width: 90%;line-height:2em;color:#333;clear:both;padding-left:5px;}
#show *{margin:0;padding:0;list-style:none;line-height:2em;}
#show p{width: 100%;height:100%; line-height:2.8em;clear:both;font-size:14px;}
#show table{border-collapse:collapse;border-spacing:0;}
#show img{border:0;}
#show a{color:#1d53bf;}
#show ul{list-style:none;padding:0; margin:0;}
#show caption,#show th {text-align:left;}
#show h1,#show h2,#show h3,#show h4,#show h5,#show h6{font-size:100%;}
table#listhf{clear:both;width:90%;border-top:1px solid #ccc;line-height:24px;}
table#listhf tr{width:100%;font-size:14px;clear:both;}
table#listhf tr td.lf{float:left;width:10%;background:#f2f2f2;text-align:center;padding-bottom:8px;}
table#listhf tr td.rf{float:left;width:80%;padding-left:10px;padding-top:10px;}
table#listhf tr td.rf img{border:0;}
table#listhf p{width: 100%;}
#listhf img.tx{border:1px solid #ccc;padding:1px;margin-top:8px;}
.z_hf{margin-left:20px;width:60%;border:1px solid #ccc;padding:8px;margin-bottom:18px;line-height:24px;}
.z_hf a{color:#1d53bf;}
.zz{color:#1d53bf;font-size:12px;}
a.hfr{color:#666;font-size:12px;}
.jju{height: 10px;overflow:hidden;clear:both;}
.kjhf{clear:both;margin-top:50px;}
.kjhf h2{height: 35px;line-height:35px;}
.sm{color:#999;padding-top:20px;clear:both;}
-->
</style>

<form id="pagerForm" method="post" action="?action=doc&do=show&id=<?php echo $this->_var['row']['fyid']; ?>">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="45">
			<div class="content" <?php echo $this->_var['row']['xs2']; ?>>
				<div class="title">
					<h1><?php echo $this->_var['row']['title']; ?></h1>
				</div>
				<div class="lm">
					所属栏目：<?php echo $this->_var['row']['doctid_txt']; ?> <span class="sm"> <?php echo $this->_var['row']['created_at']; ?>&#9758; </span><a href="#hfk">[回复]</a>|<a href="?action=doc&do=edit&id=<?php echo $this->_var['row']['id']; ?>" target="navTab">[编辑]</a>
				</div>
				<div class="divider">divider</div>
				<div id="show" style="clear:both;">
					<div><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
					<span class="sm">&#9758;----by: <b class="zz"><?php echo $this->_var['row']['salesid_txt']; ?> </b>发布时间 <?php echo $this->_var['row']['created_at']; ?> <a href="#hfk">[回复]</a></span>
				</div>
			</div>
				<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_83859500_1396500345');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_83859500_1396500345']):
?>
				<table id="listhf" target="id" rel="<?php echo $this->_var['row_0_83859500_1396500345']['id']; ?>">
				<tr >
				<td class="lf" valign="top" ><img class="tx" src="" width="50" height="50"/><br/>by：<span class="zz"><?php echo $this->_var['row_0_83859500_1396500345']['salesid_txt']; ?></span></td>
				<td class="rf"><?php echo $this->_var['row_0_83859500_1396500345']['title_r']; ?><div class="jju"></div><span class="sm">&#9758;---- <?php echo $this->_var['row_0_83859500_1396500345']['created_at']; ?> <a class="hfr" href="?action=doc&do=reply&hid=<?php echo $this->_var['row_0_83859500_1396500345']['id']; ?>" target="dialog">[回复]</a></span><div class="jju"></div>
				<div class="z_hf" <?php echo $this->_var['row_0_83859500_1396500345']['xs']; ?>><?php echo $this->_var['row_0_83859500_1396500345']['intro_r']; ?></div></td>
				</tr></table>		
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

		<div class="kjhf">
		<form method="post" action="?action=doc&do=reply" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="docid" value="<?php echo $this->_var['row']['id']; ?>" />
		<a name="hfk"></a>
		<h2>发表回复</h2>
		<label>内容：</label>
		<textarea   class="xheditor" name="introtj" rows="15" cols="60" upLinkUrl="upload.php" upLinkExt="zip,rar,txt,doc,xls"></textarea>
		<label></label>
		<div class="buttonActive"><div class="buttonContent"><button type="submit">发表</button></div></div>
		</div>	</form>	
		</div>
	</div>
	<div class="panelBar">
			<div class="pages">	
			</div>
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="8" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>
		</div>
</div>