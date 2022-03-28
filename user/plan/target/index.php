<?php

if(isset($_POST["add"])){
	insert("target", ["name" => $_POST["name"], "project_id" => $_GET["project_id"]]);
}

if(isset($_POST["edit"])){
	update("target", ["name" => $_POST["name"]], ["id" => $_POST["edit"]]);
}

if(isset($_POST["del"])){
	del("target", ["id" => $_POST["del"]]);
}

$targets = selects("*", "target", ["project_id" => $_GET["project_id"]]);
?>

<div class="row-fluid">
	<h3>指標管理</h3>
	<hr>
	<div style="text-align:center;">
		<div class="btn-group">
			<button class="btn" type="button" onclick="$('#add').modal('show')">新增</button>
			<a class="btn" href="?page=user\plan\index&project_id=<?= $_GET["project_id"]?>">返回</a>
		</div>
		<br><br>
	</div>

	<div class="well">
		<table class="table">
			<thead>
				<th>指標名稱</th>
			</thead>

			<tbody>
				<?php foreach($targets as $target){?>
					<form method="post">
						<tr>
							<td><input style="width:80%" type="text" name="name" value="<?= $target["name"]?>" required></td>							

							<td>
								<div class="btn-group">
									<button class="btn" type="submit" name="edit" value="<?= $target["id"]?>">修改</button>
									<button class="btn" type="submit" name="del" value="<?= $target["id"]?>">刪除</button>
								</div>
							</td>
						</tr>
					</form>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>


<form class="modal hide fade" id="add" method="post">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>新增指標</h4>
	</div>

	<div class="modal-body">
		<p>指標名稱</p>
		<input type="text" name="name" required>
	</div>

	<div class="modal-footer">
		<button class="btn" type="submit" name="add"> 確定</button>
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>