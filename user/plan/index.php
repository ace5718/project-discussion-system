<?php
if(isset($_POST["del"])){
	del("plan", ["id" => $_POST["del"]]);
}

$check = check();

$targets = selects("*", "target", ["project_id" => $_GET["project_id"]]);

$plans = selects("*", "plan", ["project_id" => $_GET["project_id"]]);

if($check == 1){
	foreach($plans as $plan){
		$point = select("sum(point) as total", "plan_point", ["plan_id" => $plan["id"]])["total"];

		update("plan", ["total" => (is_null($point) ? 0 : $point)], ["id" => $plan["id"]]);
	}
	
	$plans = selects("*", "plan", ["project_id" => $_GET["project_id"]], " and ", " = ", "order by total desc");
}

if(isset($_POST["point"])){
	del("plan_point", ["user_id" => $_SESSION["user"]["id"], "plan_id" => $_POST["point"]]);
	
	foreach($targets as $target){
		insert("plan_point", ["user_id" => $_SESSION["user"]["id"], "plan_id" => $_POST["point"], "target_id" => $target["id"],"point" => $_POST["target".$target["id"]]]);
	}
	
	header("location:?page=user\plan\index&project_id=".$_GET["project_id"]);
}
?>

<div class="row-fluid">
	<h3>方案列表</h3>
	<hr>
	<div style="text-align:center">
		<div class="btn-group">
			<?php if(is_admin() || is_leader()){?>
				<a class="btn" type="button" href="?page=user/plan/target/index&project_id=<?= $_GET["project_id"]?>">指標管理</a>
				<a class="btn" href="?page=user/plan/add&project_id=<?= $_GET["project_id"]?>">新增</a>
			<?php }?>
			<a class="btn" href="?page=user/index">返回</a>
		</div>
	</div>

	<div style="display:flex;flex-wrap:wrap">
		<?php foreach($plans as $key=>$plan){
			$points = selects("*", "plan_point", ["plan_id" => $plan["id"], "user_id" => $_SESSION["user"]["id"]]);
			?>
			<div class="span3" style="margin:5px">
				<div class="well">
					<h4>
						<?= "執行方案名稱：".($key + 1)?>
						<br>
						<?= "執行方案說明：".$plan["name"]?>
					</h4>

					<?php if($check == 1){?>
						<p><?= "總分：".$plan["total"]?></p>
					<?php }?>

					<form method="post" style="text-align:right;margin:0px;">
						<div class="btn-group">
							<a class="btn" href="?page=user/plan/message/index&project_id=<?= $_GET["project_id"]?>&plan_id=<?= $plan["id"]?>">檢視</a>

							<?php if(count($points) == count($targets)){?>
								<button class="btn" type="button">已評分</button>
							<?php }else{?>
								<button class="btn " type="button" onclick="$('#<?= $plan["id"]?>').modal('show')">請評分</button>
							<?php }?>

							<?php if(is_admin() || is_leader()){?>
								<a class="btn" href="?page=user\plan\update&project_id=<?= $_GET["project_id"]?>&plan_id=<?= $plan["id"]?>">修改</a>
								<button class="btn" type="submit" name="del" value="<?= $plan["id"]?>">刪除</button>
							<?php }?>
						</div>
					</form>
				</div>
			</div>
		<?php }?>
	</div>
</div>

<?php foreach($plans as $plan){?>
	<form class="modal hide fade" id="<?= $plan["id"]?>" method="post">
		<div class="modal-header">
			<button class="close" type="button" data-dismiss="modal">&times;</button>
			<h4>評分</h4>
		</div>

		<div class="modal-body">
			<table class="table">
				<?php foreach($targets as $target){?>
					<tr>	
						<td><?= $target["name"]?></td>
						<?php for($i = 1; $i <= 5; $i++){?>
							<td><?= $i?><input style="width:25px;height:25px;margin:10px" type="radio" name="target<?= $target["id"]?>" value="<?= $i?>" <?= $i == 1 ? "checked" : "" ?>></td>
						<?php }?>
					</tr>
				<?php }?>
			</table>
		</div>

		<div class="modal-footer">
			<button class="btn" type="submit" name="point" value="<?= $plan["id"]?>">確定</button>
			<button class="btn" type="button" data-dismiss="modal">取消</button>
		</div>
	</form>
<?php }?>