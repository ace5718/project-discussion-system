<?php

if(count($_POST) > 0){
	update("project", ["speak" => $_POST["speak"]], ["id" => $_GET["project_id"]]);
}

$project = select("*", "project", ["id" => $_GET["project_id"]]);

$programs = selects("*", "program", ["project_id" => $_GET["project_id"]]);
?>

<div class="row-fluid">
	<h3><?= $project["name"] ?></h3>
	<hr>
	
	<form style="text-align:center" method="post">
		<div class="btn-group">
			<button class="btn" type="button" onclick="$('#des').modal('show')">檢視說明</button>
			<?php if(is_admin() || is_leader()){?>
			 <button class="btn" type="submit" name="speak" value="<?= $project["speak"] == 1 ? 0 : 1?>"><?= $project["speak"] == 1 ? "停止發表意見" : "開始發表意見" ?></button>
			<?php }?>
			<a class="btn" href="?page=user/index">返回</a>
		</div>
		<br><br>
	</form>
	
	<div style="display:flex;flex-wrap:wrap">
		<?php foreach($programs as $key=>$program){?>
			<form class="span3" style="margin:5px" method="post">
				<div class="well" onclick="window.location.href = '?page=user/program/message/index&project_id=<?= $_GET["project_id"]?>&program_id=<?= $program["id"]?>' ">
					<h4><?= "面向".($key + 1)."　".$program["name"]?></h4>
				</div>
			</form>
		<?php }?>
	</div>
</div>


<form class="modal hide fade" id="des" method="post">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>專案說明</h4>
	</div>

	<div class="modal-body">
		<?= $project["des"] ?>
	</div>

	<div class="modal-footer">		
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>