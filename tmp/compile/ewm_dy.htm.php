
<style type="text/css">
<!--
.imgfl{float:left;padding:0 4px;}
-->
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="#" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />	
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
				</div>
				<div class="unit">
					<img class="imgfl" border='0' src='<?php echo $this->_var['row']['ewmsrc']; ?>' /> <textarea rows="5" cols="50" class="textInput" name="intro">凭此短信来院治疗-昆山百达丽整形美容医院1</textarea>
				</div>
			</div>
			
			<div class="formBar">
				<ul>
					<input type="button" id="btnPrint" value="打印预览" onclick="DLPrinter.PrintPreview()" />
<input type="button" id="btnPrint" value="选择打印机" onclick="DLPrinter.Print()" />
<input type="button" id="btnPrint" value="直接打印" onclick="DLPrinter.PrintDirect()" />
				</ul>
				
			</div>
		</form>
	</div>
</div>
 <OBJECT ID="DLPrinter" CLASSID="CLSID:5C230622-45E5-4e3c-893C-3BFDDC4DB5E4"  codebase="print/DLPrinter.cab" height="0" width="0" ></OBJECT>
<script>
  DLPrinter.MarginLeft=0;
  DLPrinter.MarginRight=0;
  DLPrinter.MarginTop=0;
  DLPrinter.MarginBottom=0;
  DLPrinter.CopyCount=1;
  DLPrinter.PageHeader="";
  DLPrinter.PageFooter="";
  DLPrinter.IsLandScape=0;
  DLPrinter.ContentURL="<?php echo $this->_var['cfg']['app']; ?>?action=smsmail&do=ewmsc&id=<?php echo $this->_var['row']['id']; ?>";    
</script>

