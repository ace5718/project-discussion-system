<?php

if(isset($_POST["message"])){
	$data = ["name" => $_POST["name"], "des" => $_POST["des"], "program_id" => $_GET["program_id"]];

	if(isset($_POST["father"])){
		$data["father"] = $_POST["father"];
	}

	if($_FILES["file"]["name"] != ""){
		$md5 = md5(date(time()));
		$type = explode("/", $_FILES["file"]["type"]);
		$file = $md5.".".$type[1];
		move_uploaded_file($_FILES["file"]["tmp_name"], "C:/xampp/htdocs/web01/file/".$file);

		$data["type"] = $type[0];
		$data["file"] = $file;
	}

	insert("message", $data);
}

if(isset($_POST["point"])){
	insert("message_point", ["user_id" => $_SESSION["user"]["id"], "message_id" => $_POST["point"], "point" => $_POST["value"]]);

	header("location:?page=user/program/message/index&project_id=".$_GET["project_id"]."&program_id=".$_GET["program_id"]);
}

$plan = select("*", "plan", ["id" => $_GET["plan_id"]]);

$plan_messages = selects("*", "plan_message", ["plan_id" => $_GET["plan_id"]]);

$messages = [];

foreach($plan_messages as $plan_message){		
	$messages[] = select("*", "message", ["id" => $plan_message["message_id"]]);
}
?>

<div class="row-fluid">
	<h3><?= $plan["name"]?></h3>
	<hr>

	<form style="text-align:center;margin:0px;" method="post">
		<div class="btn-group">
			<button class="btn" type="button" onclick="$('#des').modal('show')">檢視說明</button>
			<a class="btn" href="?page=user\plan\index&project_id=<?= $_GET["project_id"]?>">返回</a>
		</div>
		<br><br>
	</form>

	<div class="accordion" id="message">
		<?php foreach($messages as $key=>$message){
			$point = select("*", "message_point", ["message_id" => $message["id"], "user_id" => $_SESSION["user"]["id"]]);

			$total = select("sum(point) as total", "message_point", ["message_id" => $message["id"]])["total"];

			$people = count(selects("*", "message_point", ["message_id" => $message["id"]]));
			?>
			<div class="accordion-group">
				<div class="accordion-heading clearfix" style="background-color:#eee">
					<p class="pull-right">
						<input class="check" style="width:25px;height:25px;" type="checkbox" value="<?= $message["id"]?>">
					</p>

					<h4 class="accordion-toggle" data-toggle="collapse" data-parent="#message" href="#<?= $message["id"]?>">
						<?= "編號：".($key + 1)."　標題：".$message["name"]?>
					</h4>
				</div>

				<div class="accordion-body collapse" style="background-color:#fff" id="<?= $message["id"]?>">
					<p>
						<?= "說明：".$message["des"]?>
					</p>

					<?php if($message["type"] == "image"){?>
						<img style="width:100%;" src="<?= "../web01/file/".$message["file"]?>" alt="img">
					<?php }elseif($message["type"] == "audio"){?>
						<audio style="width:100%;" src="<?= "../web01/file/".$message["file"]?>" controls></audio>
					<?php }elseif($message["type"] == "video"){?>
						<video style="width:100%;" src="<?= "../web01/file/".$message["file"]?>" controls></video>
					<?php }?>

					<p>
						<?= "發表的時間：".$message["time"]?>
					</p>

					<?php if(!is_null($message["father"])){?>					
						<a href="?page=user\plan\message\father&project_id=<?= $_GET["project_id"]?>&plan_id=<?= $_GET["plan_id"]?>&father=<?= $message["father"]?>">原始的意見</a>
					<?php }?>
					<hr>

					<p>
						已被評價人數：<?= $people?>
						被評價總分：<?= is_null($total) ? 0 : $total ?>
						評分：<?= is_null($point) ? "未評分" :  $point["point"] ?>
					</p>
				</div>
			</div>
		<?php }?>
	</div>
</div>

<form class="modal hide fade" id="des" method="post" >
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>面向說明</h4>
	</div>

	<div class="modal-body">
		<?= $plan["des"]?>
	</div>

	<div class="modal-footer">
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>

<form class="modal hide fade" id="add" method="post" enctype="multipart/form-data">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>新增意見</h4>
	</div>

	<div class="modal-body">
		<p>標題</p>
		<input type="text" name="name" required>
		<p>說明</p>
		<textarea type="text" name="des" required></textarea>
		<br>
		<input type="file" name="file">
	</div>

	<div class="modal-footer">
		<button class="btn" type="submit" name="message">確定</button>
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>

<form class="modal hide fade" id="more" method="post" enctype="multipart/form-data">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>延伸意見</h4>
	</div>

	<div class="modal-body">
		<p>標題</p>
		<input type="text" name="name" required>
		<p>說明</p>
		<textarea type="text" name="des" required></textarea>
		<br>
		<input type="file" name="file">
		<input type="hidden" name="father" id="father">
	</div>

	<div class="modal-footer">
		<button class="btn" type="submit" name="message">確定</button>
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>

<form class="modal hide fade" id="error" method="post" >
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">&times;</button>
		<h4>操作說明</h4>
	</div>

	<div class="modal-body">
		請先勾選意見
	</div>

	<div class="modal-footer">
		<button class="btn" type="button" data-dismiss="modal">取消</button>
	</div>
</form>

<script>
	$('.more').click(function(){
		let id = []
		
		$('.check:checked').each(function(i, e){
			id.push($(this).val())
		})
		
		console.log(id.join(","))
		
		if(id.length > 0){
			$('#more').modal('show')
			$('#father').val(id.join(","))
		}else{
			$('#error').modal('show')
		}
	})
</script>