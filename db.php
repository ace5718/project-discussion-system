<?php

session_start();
$db = new mysqli("127.0.0.1.","admin","1234","web01");
$db->query("set names utf8");

function exarray($data, $s = " and ", $o = " = "){
	if(is_array($data)){
		$row = [];
		foreach($data as $key=>$value){
			if(is_numeric($key)){
				$row[] = " $value ";
			}else{
				if($o == " like "){
					$row[] = "`$key` $o '%{$value}%'";
				}else{
					$row[] = "`$key` $o '{$value}'";
				}
			}
		}
		return implode($s, $row);
	}
	return $data;
}

function select($from, $table, $where, $s = " and ", $o = " = ", $other = ""){
	global $db;
	$sql = "select $from from `$table` where ".exarray($where, $s, $o).$other;

	$res = $db->query($sql);

	if($res){
		return $res->fetch_assoc();
	}

	echo $sql;
}

function selects($from, $table, $where, $s = " and ", $o = " = ", $other = ""){
	global $db;
	$sql = "select $from from `$table` where ".exarray($where, $s, $o).$other;

	$res = $db->query($sql);

	if($res){
		$data = [];
		while($row = $res->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}

	echo $sql;
}

function insert($table, $set){
	global $db;
	$sql = "insert into `$table` set ".exarray($set, " , ");

	$res = $db->query($sql);

	if($res){
		return $db->insert_id;
	}

	echo $sql;
}

function update($table, $set, $where, $s = " and ", $o = " = "){
	global $db;
	$sql = "update `$table` set ".exarray($set, " , ")." where ".exarray($where, $s, $o);

	$res = $db->query($sql);

	if(!$res){
		echo $sql;
	}
}

function del($table, $where, $s = " and ", $o = " = "){
	global $db;
	$sql = "delete from `$table` where ".exarray($where, $s, $o);

	$res = $db->query($sql);

	if(!$res){
		echo $sql;
	}
}





function login($account, $password){
	$user = select("*", "user", ["account" => $account, "password" => $password]);

	if(is_array($user)){
		return $user;
	}
	
	return "登入失敗";
}

function is_admin(){
	return $_SESSION["user"]["level"] == 1;
}

function is_leader(){
	$member = select("*", "member", ["user_id" => $_SESSION["user"]["id"], "project_id" => $_GET["project_id"]]);
	return $member["leader"] == 1;
}

function check(){
	$target_count = count(selects("*", "target", ["project_id" => $_GET["project_id"]]));
	
	$member_count = count(selects("*", "member", ["project_id" => $_GET["project_id"]]));
	
	$plans = selects("*", "plan", ["project_id" => $_GET["project_id"]]);
	
	$admin = select("*", "user", ["level" => 1]);
	
	if($target_count == 0){
		return 0;
	}
	
	foreach($plans as $plan){
		$people = select("count(user_id) as people", "plan_point", ["plan_id" => $plan["id"], "user_id != {$admin['id']}"])["people"];
		
		if(($people / $target_count) < $member_count){
			return 0;
		}
	}
	
	return 1;
}
?>