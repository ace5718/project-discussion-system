<?php
if(count($_POST) > 0){
	$user = login($_POST["account"], $_POST["password"]);
	
	if(is_array($user)){
		$_SESSION["user"] = $user;
		
		header("location:?page=user/index");
	}else{
		echo "<script>alert('{$user}')</script>";
	}
}
?>

<form method="post" id="center">
	<div class="center">
		<h3>專案討論系統</h3>
		<hr><br>
		<input type="text" name="account" placeholder="account">
		<br><br>
		<input type="password" name="password" placeholder="password">
		<br><br><br>
		<button type="submit">Login</button>
	</div>
</form>