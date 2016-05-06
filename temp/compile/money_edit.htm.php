<style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:left;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 800px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
<div class="page">
    <?php if(empty($_SESSION['prewdata'])){?>
	<div class="pageContent">
		<form method="post" action="?action=money&do=printpriew" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
		<input type="hidden" name="sellid" value="<?php echo $this->_var['sellid']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称： </label>
					<input name="name" class="required" type="text" size="30" readonly value="<?php echo $this->_var['row']['name']; ?>" alt=""/>	
				</div>
				<div class="unit">
				<p>
					<label>开票时间：</label>
					<input name="yy_at"  type="text" size="20" value="<?php echo $this->_var['row']['yy_at']; ?>" class="date" readonly="true"/>
					<a class="inputDateButton" href="javascript:;">选择</a>
				</p>
				<p>
					<label class="required">性别：</label>
					<input name="xb" class="required" type="text" size="30" readonly value="<?php echo $this->_var['row']['xb']; ?>" alt=""/>	
				</p>
				<p>
					<label>年龄：</label>					
					<input readonly name="nl" class="" type="text" size="10" value="<?php echo $this->_var['row']['nl']; ?>" alt=""/>
				</p>
				</div>
				<table class="list " width="90%">
						<thead>
							<tr>
								<th type="text" name="zlxm.title[]" size="30" >开票项目</th>
								<th type="text" name="zlxm.num[]" size="10" fieldClass="digits">单价</th>
								<th type="text" name="zlxm.num[]" size="10" fieldClass="digits">数量</th>
								<th type="text" name="zlxm.num[]" size="10" fieldClass="digits">折扣额</th>
								<th type="text" name="zlxm.num[]" size="30" fieldClass="digits">附注</th>
							</tr>
						</thead>
						<tbody>
<?php 
$_from = $this->_var['sellinforow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
$i = 0;
    foreach ($_from AS $this->_var['row']):
?>
							<TR  sizset="0" >
                                <TD ><INPUT class="textInput" id="zlxm_title_<?php echo $i;?>" name="zlxm.title[]" size=30 value="<?php echo $this->_var['row']['item']; ?>" ></TD>
								<TD ><INPUT class="number textInput" id="zl_danjia_<?php echo $i;?>" name="zl.danjia[]" size=10 value="<?php echo $this->_var['row']['money_ss']; ?>" onchange="sumjine(this.value, <?php echo $i;?>)"></TD>
								<TD ><INPUT class="number textInput"  id="zl_num_<?php echo $i;?>" name="zl.num[]" size=10></TD>
								<TD ><INPUT class="number textInput"   id="zl_zhekoue_<?php echo $i;?>" name="zl.zhekoue[]" size=10></TD>
								<TD ><INPUT class="textInput"   id="zl_beizhu_<?php echo $i;?>" name="zl.beizhu[]" size=30></TD>
							</TR>

			<?php $i++; endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</tbody>
					</table>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>

	</div>
    <?php }else{?>
<?php 
        $priewdata = $_SESSION['prewdata'];
    $_SESSION['prewdata'] = "";
?>

	<div class="pageContent">
                    <div class="invoice-box"  id='printpriew'>
<table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6" style="text-align:center">
                                昆山百达丽医疗美容门诊部付款<br><br>
                                专用收据<br><br>
                </td>
            </tr>
            
            
            
            <tr class="heading">
                <td>
                开票日期: <?php echo $priewdata['yy_at']; ?>
                </td>
                
                <td colspan=3>
                    姓名: <?php echo $priewdata['name']; ?>
                </td>
                
                <td>
                    性别: <?php echo $priewdata['xb']; ?>
                </td>
                
                <td>
                    年龄: <?php echo $priewdata['nl']; ?>
                </td>
                
            </tr>
            
            <tr class="item">
                <td style="width:30%">开票项目</td>
                <td style="width:10%">单价</td>
                <td style="width:10%">数量</td>
                <td style="width:10%">折扣额</td>
                <td style="width:10%">金额(人民币)</td>
                <td style="width:20%">附注</td>
            </tr>
            <?php foreach($priewdata['item'] as $key => $item):?> 
            <tr class="item">
                <td><?php echo $item['title'];?></td>
                <td><?php echo $item['danjia'];?></td>
                <td><?php echo $item['num'];?></td>
                <td><?php echo $item['zhekoue'];?></td>
                <td><?php echo $item['jine'];?></td>
                <td><?php echo $item['beizhu'];?></td>
            </tr>
            
            <?php endforeach;?> 
          
        </table>
                    </div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="button" onclick = "javascript:$.printBox('printpriew')">打印</button></div></div></li>
				</ul>
			</div>
	</div>
    <?php }?>
</div>
