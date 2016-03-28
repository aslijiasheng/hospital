  <script src="chajian/chart/js/highcharts.js"></script>
<script src="chajian/chart/js/modules/exporting.js"></script>
<?php echo $this->_var['row']['sj2']; ?>
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
                renderTo: 'cszt'
            },
            title: {
                text: '<?php echo $this->_var['row']['bt']; ?>'
            },
            xAxis: {
                categories: <?php echo $this->_var['row']['bt2']; ?>
            },
            tooltip: {
                formatter: function() {
                    var s;
                    if (this.point.name) { // the pie chart
                        s = ''+
                            this.point.name +': ￥'+ this.y +' RMB';
                    } else {
                        s = ''+
                            this.x  +': '+ this.y;
                    }
                    return s;
                }
            },
            labels: {
                items: [{
                    html: '渠道金额统计',
                    style: {
                        left: '550px',
                        top: '200px',
                        color: 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: '登记数量',
                data: <?php echo $this->_var['row']['sja1']; ?>
            }, {
                type: 'column',
                name: '到院',
                data: <?php echo $this->_var['row']['sja2']; ?>
            }, {
                type: 'column',
                name: '派单',
                data: <?php echo $this->_var['row']['sja3']; ?>
            }, {
                type: 'spline',
                name: '初诊人数',
                data: <?php echo $this->_var['row']['sja4']; ?>,
                marker: {
                	lineWidth: 2,
                	lineColor: Highcharts.getOptions().colors[3],
                	fillColor: 'white'
                }
            },{
                type: 'spline',
                name: '复诊人数',
                data: <?php echo $this->_var['row']['sja5']; ?>,
                marker: {
                	lineWidth: 2,
                	lineColor: Highcharts.getOptions().colors[3],
                	fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total consumption',
                data: <?php echo $this->_var['row']['data']; ?>,
                center: [600, 100],
                size: 110
            }]
        });
    });
    
});
		</script>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=report&do=t2" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						选择时间范围:<input type="text" name="time_start" size="10" class="date" value="<?php echo $this->_var['postdate_start']; ?>" readonly="true" />
						-<input type="text" name="time_over" size="10" class="date" value="<?php echo $this->_var['postdate_over']; ?>" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
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
			<li><a class="delete" href="?action=report&do=t2t" target="navTab" rel="t2t"><span>统计图</span></a></li>	
			</ul>
		</div>
		<div layouth="64" style="overflow-y:auto;">
		
		<table class="list" style="width:95%">
		<div id="cszt" style="min-width: 400px; height: 300px; margin: 0 auto;"></div>
			<thead>
				  <tr>
					<th rowspan="2">类型</th>
					<th rowspan="2">数量</th>
					<th rowspan="2">到院</th>
					<th rowspan="2">派单</th>
					<th rowspan="2">金额</th>
				  </tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_24781700_1396595087');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_24781700_1396595087']):
?>
				<tr>
					<td><?php echo $this->_var['row_0_24781700_1396595087']['title']; ?></td>
					<td><?php echo $this->_var['row_0_24781700_1396595087']['num']; ?></td>
					<td><?php echo $this->_var['row_0_24781700_1396595087']['num2']; ?>个|初诊:<?php echo $this->_var['row_0_24781700_1396595087']['num2_c']; ?>|复诊:<?php echo $this->_var['row_0_24781700_1396595087']['num2_f']; ?></td>
					<td><?php echo $this->_var['row_0_24781700_1396595087']['num3']; ?></td>
					<td><?php echo $this->_var['row_0_24781700_1396595087']['num4']; ?></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<tr class="count_hh">
					<td>合计</td>
					<td><?php echo $this->_var['list2']['num']; ?></td>
				</tr>
				<tr>
					
				</tr>
			</tbody>
		</table>
		</div>
	</div>
</div>