<?php

if(isset($_POST["add"])){
	insert("user", ["name" => $_POST["name"], "account" => $_POST["account"], "password" => $_POST["password"]]);
}

if(isset($_POST["edit"])){
	update("user", ["name" => $_POST["name"], "account" => $_POST["account"], "password" => $_POST["password"]], ["id" => $_POST["edit"]]);
}

if(isset($_POST["del"])){
	del("user", ["id" => $_POST["del"]]);
}

$users = selects("*", "user", 1);
?>

<div class="row-fluid">
	<h3>使用者管理</h3>
	<hr>
	<div style="text-align:center;">
		<div class="btn-group">
			<button class="btn" type="button" onclick="$('#add').modal('show')">新增</button>
		</div>
		<br><br>
	</div>

	<div class="well">
		<table class="table">
			<thead>
				<th>使用者名稱</th>
				<th>帳號</th>
				<th>密碼</th>
			</thead>

			<tbody>
				<?php foreach($users as $user){?>
					<form method="post">
						<tr>
							<td><input type="text" name="name" value="<?= $user["name"]?>" required></td>
							<td><input type="text" name="account" value="<?= $user["account"]?>" required></td>
							<td><input type="text" name="password" value="<?= $user["password"]?>" required></td>

							<?php if($user["level"] == 0){?>
								<td>
									<div class="btn-group">
										<button class="btn" type="submit" name="edit" value="<?= $user["id"]?>">修改</button>
										<button class="btn" type="submit" name="del" value="<?= $user["id"]?>">刪除</button>
									</div>
								</td>
							<?php }?>
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
		<h4>新增使用者</h4>
	</div>

	<div class="modal-body">
		<p>使用者名稱</p>
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