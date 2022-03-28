<?php

if(count($_POST) > 0){
	header("location:?page=admin\chart\index&project_id=".$_POST["project_id"]."&type=".$_POST["type"]."&picture=".$_POST["picture"]);
}

$temps = selects("*", $_GET["type"], ["project_id" => $_GET["project_id"]]);

$data = [];

foreach($temps as $temp){
	if($_GET["type"] == "program"){
		$data[] = [$temp["name"], count(selects("*", "message", ["program_id" => $temp["id"]]))];
	}else{
		$data[] = [$temp["name"], intval(select("sum(point) as total", "plan_point", ["plan_id" => $temp["id"]]))];
	}
}

$projects = selects("*", "project", 1);
?>

<input type="hidden" id="data" value="<?= htmlspecialchars(json_encode($data)) ?>">

<div class="row-fluid">
	<h3>統計管理</h3>
	<hr>
	<form method="post" class="well">
		<table class="table">
			<thead>
				<th>專案名稱</th>
				<th>檢視項目</th>
				<th>圖表類型</th>				
			</thead>
			
			<tbody>
				<tr>
					<td>
						<select name="project_id">
							<?php foreach($projects as $project){?>
								<option value="<?= $project["id"]?>" <?= $_GET["project_id"] == $project["id"] ? "selected" : ""?>><?= $project["name"]?></option>
							<?php }?>
						</select>
					</td>
					
					<td>
						<select name="type" id="type">
							<option value="program" <?= $_GET["type"] == "program" ? "selected" : "" ?>>專案面向</option>
							<option value="plan" <?= $_GET["type"] == "plan" ? "selected" : "" ?>>執行方案</option>
						</select>
					</td>
					
					<td>
						<select name="picture" id="picture">
							<option value="pie" <?= $_GET["picture"] == "pie" ? "selected" : "" ?>>圓餅圖</option>
							<option value="bar" <?= $_GET["picture"] == "bar" ? "selected" : "" ?>>長條圖</option>
							<option value="line" <?= $_GET["picture"] == "line" ? "selected" : "" ?>>折線圖</option>
						</select>
					</td>
					
					<td>
						<button class="btn" type="submit">確定</button>
					</td>
				</tr>
			</tbody>
		</table>
		<label>
		<div id="chart"></div>
	</form>
</div>

<script>
	var data = JSON.parse($('#data').val())
	
	let name = data.map(item => item[0])

	let value = []
	
	data.map(item => 
		value.push({
			name:item[0],
			y:item[1]
		})
	)
	
	Highcharts.chart('chart', {
		chart:{
			type:$('#picture').val()
		},
		title:{
			text:$('#type option:selected').text()
		},
		xAxis:{
			categories:name
		},
		plotOptions:{
			bar:{
				dataLabels:{
					enabled:true
				}
			},
			line:{
				dataLabels:{
					enabled:true
				}
			},
			pie:{
				dataLabels:{
					enabled:true,
					format:'{point.name}: {point.y}'
				}
			},
		},
		series:[{data:value}]
	})
</script>