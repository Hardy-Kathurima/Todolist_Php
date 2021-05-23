<?php 
require_once 'database/connection.php';

if(isset($_GET['task'] ,$_GET['id'])){

	$task = htmlspecialchars($_GET['task']);
	$id = htmlspecialchars($_GET['id']);

	switch($task){
		case 'done';
		$update = "UPDATE todos SET done=1 WHERE id=:id";
		$stmt = $conn->prepare($update);
		$stmt->execute([':id'=>$id]);
		header('Location:index.php');
		break;
	}
}