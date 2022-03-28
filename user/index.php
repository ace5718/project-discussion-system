<?php
if(is_admin()){
	$projects = selects("*", "project", 1);
}else{
	$members = selects("*", "member", ["user_id" => $_SESSION["user"]["id"]]);
	
	$projects = [];
	
	foreach($members as $member){
		$projects[] = select("*", "project", ["id" => $member["project_id"]]);
	}
}

?>

<div class="row-fluid">
	<h3>個人專案</h3>
	<hr>

	<div style="display:flex;flex-wrap:wrap">
		<?php foreach($projects as $key=>$project){?>
			<form class="span3" style="margin:5px" method="post">
				<div class="well">
					<h4><?= "專案".($key + 1)."　".$project["name"]?></h4>
					
					<div style="text-align:right">
						<div class="btn-group">
							<a class="btn" href="?page=user\program\index&project_id=<?= $project["id"]?>">面向列表</a>
							<a class="btn" href="?page=user\plan\index&project_id=<?= $project["id"]?>">方案列表</a>						
						</div>
					</div>
				</div>
			</form>
		<?php }?>
	</div>
</div>
