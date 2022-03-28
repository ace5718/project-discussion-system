<?php
require_once("db.php");

if(!isset($_SESSION["user"]) && $_GET["page"] != "login"){
	header("location:?page=login");
}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta name="viewport" content="initial-scale=1">

		<link rel="stylesheet" href="css\jquery-ui.css">
		<link rel="stylesheet" href="css\bootstrap.min.css">
		<link rel="stylesheet" href="css\bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css\main.css">

		<script src="js\jquery.min.js"></script>
		<script src="js\jquery-ui.min.js"></script>
		<script src="js\bootstrap.min.js"></script>
		<script src="js\highcharts.js"></script>
	</head>

	<body>
		<?php if($_GET["page"] != "login"){?>
			<div class="navbar navbar-static-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<a class="brand">專案討論系統</a>

						<div class="nav-collapse collapse">
							<ul class="nav">
								<li><a href="?page=user\index">個人專案</a></li>
								<?php if(is_admin()){?>
									<li><a href="?page=admin\user">使用者管理</a></li>
									<li><a href="?page=admin\project\index">專案管理</a></li>
									<li><a href="?page=admin\chart\select">統計管理</a></li>
								<?php }?>
							</ul>

							<ul class="nav pull-right">
								<li><a href="?page=logout">登出</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php }?>
		
		<div class="container">
			<?php include_once($_GET["page"].".php") ?>
		</div>
	</body>
</html>