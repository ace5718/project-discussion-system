<?php 

$projects = selects("*", "project", 1);
header("location:?page=admin\chart\index&project_id=".$projects[0]["id"]."&type=program&picture=pie");
?>

