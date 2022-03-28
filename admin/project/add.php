<?php

if(count($_POST) > 0){
	$id = insert("project", ["name" => $_POST["project_name"], "des" => $_POST["project_des"]]);
	
	for($i = 0; $i < count($_POST["program_name"]); $i ++){
		insert("program", ["name" => $_POST["program_name"][$i], "des" => $_POST["program_des"][$i], "project_id" => $id]);		
	}
	
	header("location:?page=admin\project\index");
}

?>

<div class="row-fluid">
	<h3>新增專案</h3>
	<hr>

	<form method="post" style="text-align:center;">
		<div style="text-align:center;">
			<div class="btn-group">
				<button class="btn" type="submit">確定</button>
				<a class="btn" href="?page=admin\project\index">返回 </a>
			</div>
			<br><br>
		</div>

		<div class="well">
			<p>專案名稱</p>
			<input type="text" name="project_name" required>
			<p>專案說明</p>
			<textarea text="text" name="project_des" required></textarea>
		</div>

		<div class="well" id="program">
			<button class="btn add" type="button">新增面向</button>

			<div style="margin-top:10px;">
				<p>面向名稱</p>
				<input type="text" name="program_name[]" required>
				<p>面向說明</p>
				<textarea text="text" name="program_des[]" required></textarea>
				<br>
				<button class="btn del" type="button">刪除</button>
			</div>
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