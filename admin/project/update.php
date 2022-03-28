<?php

if(isset($_POST["project"])){
	update("project", ["name" => $_POST["name"], "des" => $_POST["des"]], ["id" => $_GET["project_id"]]);
}

$programs = selects("*", "program", ["project_id" => $_GET["project_id"]]);

if(isset($_POST["program"])){
	foreach($programs as $program){
		if(!isset($_POST["id"]) || !is_numeric(array_search($program["id"], $_POST["id"]))){
			del("program", ["id" => $program["id"]]);
		}
	}

	if(isset($_POST["id"])){
		for($i = 0; $i < count($_POST["id"]); $i++){
			if($_POST["id"][$i] == -1){
				insert("program", ["name" => $_POST["name"][$i], "des" => $_POST["des"][$i], "project_id" => $_GET["project_id"]]);
			}else{
				update("program", ["name" => $_POST["name"][$i], "des" => $_POST["des"][$i]], ["id" => $_POST["id"][$i]]);
			}
		}		
	}

	$programs = selects("*", "program", ["project_id" => $_GET["project_id"]]);
}

if(isset($_POST["user_id"])){
	foreach($_POST["user_id"] as $user_id){
		insert("member", ["user_id" => $user_id, "project_id" => $_GET["project_id"]]);
	}
}

if(isset($_POST["leader"])){
	update("member", ["leader" => 0], ["project_id" => $_GET["project_id"]]);
	update("member", ["leader" => 1], ["id" => $_POST["leader"]]);
}

if(isset($_POST["del"])){
	del("member", ["id" => $_POST["del"]]);
}

$project = select("*", "project", ["id" => $_GET["project_id"]]);

$members = selects("*", "member", ["project_id" => $_GET["project_id"]]);

$users = selects("*", "user", ["level" => 0]);
?>

<div class="row-fluid">
	<h3>修改專案</h3>
	<hr>
	<div style="text-align:center">
		<div class="btn-group">
			<a class="btn" href="?page=admin\project\index">返回</a>
		</div>
		<br><br>
	</div>

	<div class="span6" style="margin:0px">
		<form class="well" method="post" style="text-align:center">
			<h4>專案內容</h4>

			<table class="table">
				<thead>
					<th>專案名稱</th>
					<th>專案說明</th>
				</thead>

				<tbody>
					<tr>
						<td><input type="text" name="name" value="<?= $project["name"]?>" required></td>
						<td><textarea type="text" name="des" required><?= $project["des"]?></textarea></td>
						<td><button class="btn" type="submit" name="project">確定</button></td>
					</tr>
				</tbody>
			</table>
		</form>

		<div class="well">
			<div style="text-align:center">
				<h4>組員列表</h4>
				<div class="btn-group">
					<button class="btn" type="button" onclick="$('#add').modal('show')">新增組員</button>
				</div>
				<br><br>
			</div>

			<table class="table">
				<thead>
					<th>組員名稱</th>
					<th>組長</th>
				</thead>

				<tbody>
					<?php foreach($members as $member){
						$user = select("*", "user", ["id" => $member["user_id"]]);
						?> 
						<form method="post">
							<tr>
								<td><?= $user["name"]?></td>
								<td><?= $member["leader"] == 1 ? "是" : ""?></td>
								<td>
									<div class="btn-group">
										<button class="btn" type="submit" name="leader" value="<?= $member["id"]?>">指定</button>
										<button class="btn" type="submit" name="del" value="<?= $member["id"]?>">刪除</button>
									</div>
								</td>							
							</tr>
						</form>
					<?php }?>					
				</tbody>
			</table>
		</div>
	</div>

	<div class="span6">
		<form class="well" method="post">
			<div style="text-align:center">
				<h4>面向內容</h4>
				<div class="btn-group">
					<button class="btn add" type="button">新增面向</button>
					<button class="btn" type="submit" name="program">確定</button>
				</div>
				<br><br>
			</div>

			<table class="table" id="program">
				<thead>
					<th>面向名稱</th>
					<th>面向說明</th>
				</thead>

				<tbody>
					<input type="hidden" id="count" value="<?= count($programs)?>">
					<?php foreach($programs as $program){?>
						<tr>
							<td><input type="text" name="name[]" value="<?= $program["name"]?>" required></td>
							<td><textarea type="text" name="des[]" required><?= $program["des"]?></textarea></td>
							<td><button class="btn del" type="button">刪除</button></td>

							<input type="hidden" name="id[]" value="<?= $program["id"]?>">
						</tr>
					<?php }?>
				</tbody>
			</table>
		</form>
	</div>
</div>

<script>
	var count = 1

	$(document).on("click", ".add", function(){
		if(count < 10){
			$('#program').append(`
				<tr>
					<td><input type="text" name="name[]" required></td>
					<td><textarea type="text" name="des[]" required></textarea></td>
					<td><button class="btn del" type="button">刪除</button></td>

					<input type="hidden" name="id[]" value="-1">
				</tr>
			`)

			count ++
		}
	})

	$(document).on("click", ".del", function(){
		$(this).parents('tr').remove()
		count --
	})
</script>

<form class="modal hide fade" id="add" method="post">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>新增組員</h4>
	</div>

	<div class="modal-body">
		<table class="table">
			<?php foreach($users as $user){
				$member = select("*", "member", ["project_id" => $_GET["project_id"], "user_id" => $user["id"]]);
				if(is_null($member)){
				?>
				<tr>
					<td><label for="<?= $user["id"]?>"><?= $user["name"]?></label></td>
					<td><input type="checkbox" name="user_id[]" id="<?= $user["id"]?>" value="<?= $user["id"]?>"></td>
				</tr>
			<?php }
			}?>
		</table>
	</div>

	<div class="modal-footer">
		<button class="btn" type="submit" name="member">確定</button>
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>
