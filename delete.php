<?php 
require_once 'database/connection.php';

if(isset($_GET['id'])){
	$id = htmlspecialchars($_GET['id']);

	$delete = 'DELETE FROM todos WHERE id=:id';
	$stmt = $conn->prepare($delete);
	if($stmt->execute([':id'=>$id])){
	header('location:index.php');
	}
}

 ?>