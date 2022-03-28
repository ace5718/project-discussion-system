<?php
if(isset($_POST["del"])){
	
	
	del("project", ["id" => $_POST["del"]]);
}

$projects = selects("*", "project", 1);
?>

<div class="row-fluid">
	<h3>專案列表</h3>
	<hr>
	<div style="text-align:center;">
		<div class="btn-group">
			<a class="btn" href="?page=admin\project\add">新增</a>
		</div>
		<br><br>
	</div>

	<div style="display:flex;flex-wrap:wrap">
		<?php foreach($projects as $key=>$project){?>
			<form class="span3" style="margin:5px" method="post">
				<div class="well">
					<h4><?= "專案".($key + 1)."　".$project["name"]?></h4>
					
					<div style="text-align:right">
						<div class="btn-group">
							<a class="btn" href="?page=admin\project\update&project_id=<?= $project["id"]?>">修改</a>
							<button class="btn" type="submit" name="del" value="<?= $project["id"]?>">刪除</button>
						</div>
					</div>
				</div>
			</form>
		<?php }?>
	</div>
</div>


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