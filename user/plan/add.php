<?php

if(count($_POST) > 0){
	$id = insert("plan", ["name" => $_POST["name"], "des" => $_POST["des"], "project_id" => $_GET["project_id"]]);
		
	foreach($_POST["message_id"] as $message_id){
		$message = select("*", "message", ["id" => $message_id]);
		
		insert("plan_message", ["message_id" => $message_id, "program_id" => $message["program_id"], "plan_id" => $id]);
	}
	
	header("location:?page=user\plan\index&project_id=".$_GET["project_id"]);
}

$programs = selects("*", "program", ["project_id" => $_GET["project_id"]]);

function message_orderby($program_id){
	$messages = selects("*", "message", ["program_id" => $program_id]);
	
	foreach($messages as $message){
		$point = select("sum(point) as total", "message_point", ["message_id" => $message["id"]])["total"];
		
		update("message", ["total" => (is_null($point) ? 0 : $point)], ["id" => $message["id"]]);
	}
}
?>

<div class="row-fluid">
	<h3>新增方案</h3>
	<hr>

	<form method="post" style="text-align:center;">
		<div style="text-align:center;">
			<div class="btn-group">
				<button class="btn" type="submit">確定</button>
				<a class="btn" href="?page=user\plan\index&project_id=<?= $_GET["project_id"]?>">返回 </a>
			</div>
			<br><br>
		</div>

		<div class="well">
			<p>方案名稱</p>
			<input type="text" name="name" required>
			<p>方案說明</p>
			<textarea text="text" name="des" required></textarea>
		</div>

		<div class="well" id="program">
			<table class="table">
				<thead>
					<th>面向名稱</th>
					<th>意見名稱</th>					
				</thead>
				
				<tbody>
					<?php foreach($programs as $program){
						message_orderby($program["id"]);
						
						$messages = selects("*", "message", ["program_id" => $program["id"]], " and ", " = ", " order by total desc");
						?>
						<tr>
							<td><?= $program["name"]?></td>
							<td>
								<select name="message_id[]">
									<?php foreach($messages as $message){?>
										<option value="<?= $message["id"]?>"><?= $message["name"]."　總分：".$message["total"]?></option>
									<?php }?>
								</select>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</form>
</div>

<script>
	var count = 1

	$(document).on("click", ".add", function(){
		if(count < 10){
			$('#program').append(`
				<div style="margin-top:10px;">
					<p>面向名稱</p>
					<input type="text" name="program_name[]" required>
					<p>面向說明</p>
					<textarea text="text" name="program_des[]" required></textarea>
					<br>
					<button class="btn del" type="button">刪除</button>
				</div>
			`)

			count ++
		}
	})

	$(document).on("click", ".del", function(){
		$(this).parent('div').remove()
		count --
	})
</script>


<form class="modal hide fade" id="add" method="post">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>新增使用者</h4>
	</div>

	<div class="modal-body">
		<p>使用者管理</p>
		<input type="text" name="name" required>
		<p>帳號</p>
		<input type="text" name="account" required>
		<p>密碼</p>
		<input type="text" name="password" required>
	</div>

	<div class="modal-footer">
		<button class="btn" type="submit" name="add"> 確定</button>
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>