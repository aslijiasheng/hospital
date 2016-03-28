<div class="page">
	<div class="pageContent">
		<form method="post" action="#" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['mt2']['id']; ?>" />	
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
				<?php echo $this->_var['mt2']['content']; ?>
			</div>
			
			<div class="formBar">
				<ul>
					<input type="button" id="btnPrint" value="直接打印" onclick="DLPrinter.PrintDirect()" style="cursor:pointer"/>
					<input type="button" id="btnPrint" value="打印预览" onclick="DLPrinter.PrintPreview()" style="cursor:pointer"/>
					<input type="button" id="btnPrint" value="选择打印机" onclick="DLPrinter.Print()" style="cursor:pointer"/>

				</ul>
				
			</div>
		</form>
	</div>
</div>
 <OBJECT ID="DLPrinter" CLASSID="CLSID:5C230622-45E5-4e3c-893C-3BFDDC4DB5E4"  codebase="DLPrinter.cab" height="0" width="0" ></OBJECT>
<script>
  DLPrinter.MarginLeft="<?php echo $this->_var['mt2']['mar_l']; ?>";
  DLPrinter.MarginRight="<?php echo $this->_var['mt2']['mar_r']; ?>";
  DLPrinter.MarginTop="<?php echo $this->_var['mt2']['mar_u']; ?>";
  DLPrinter.MarginBottom="<?php echo $this->_var['mt2']['mar_d']; ?>";
  DLPrinter.CopyCount=1;
  DLPrinter.PageHeader="<?php echo $this->_var['mt2']['p_u']; ?>";
  DLPrinter.PageFooter="<?php echo $this->_var['mt2']['p_d']; ?>";
  DLPrinter.IsLandScape="<?php echo $this->_var['mt2']['p_m']; ?>";
  DLPrinter.ContentURL="http://<?php echo $this->_var['mt2']['url']; ?><?php echo $this->_var['mt']['app']; ?>?action=sell&do=print&type=dy&id=<?php echo $this->_var['mt2']['id']; ?>";    
</script>

