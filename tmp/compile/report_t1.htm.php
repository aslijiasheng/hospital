  <script src="chajian/chart/js/highcharts.js"></script>
<script src="chajian/chart/js/modules/exporting.js"></script>
		<script type="text/javascript">
		function toDecimal(x) {  
            var f = parseFloat(x);  
            if (isNaN(f)) {  
                return;  
            }  
            f = Math.round(x*100)/100;  
            return f;  
        }//小数点控制
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'csztqy',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $this->_var['row']['bt']; ?>'
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ toDecimal(this.percentage) +' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ toDecimal(this.percentage) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: <?php echo $this->_var['row']['data']; ?>
            }]
        });
    });
    
});
		</script>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=report&do=t1" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						选择时间范围:<input type="text" name="time_start" size="10" class="date" value="<?php echo $this->_var['postdate_start']; ?>" readonly="true" />
						-<input type="text" name="time_over" size="10" class="date" value="<?php echo $this->_var['postdate_over']; ?>" readonly="true" />
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
			<li></li>
			</ul>
		</div>
		<style type="text/css">
		<!--
		.lt{width:30%;float:left;}
		.rt{width:62%;float:left;}
		-->
		</style>
		<div class="lt">
		<table class="list" layouth="65" style="width:250px">
			<thead>
				  <tr>
					<th rowspan="2">区域</th>
					<th rowspan="2">数量</th>
				  </tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_34375300_1366868450');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_34375300_1366868450']):
?>
				<tr>
					<td><?php echo $this->_var['row_0_34375300_1366868450']['title']; ?></td>
					<td><?php echo $this->_var['row_0_34375300_1366868450']['num']; ?></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<tr class="count_hh">
					<td>合计</td>
					<td><?php echo $this->_var['list2']['num']; ?></td>
				</tr>
			</tbody>
		</table></div>
		<div id="csztqy" class="rt" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
	</div>
</div>