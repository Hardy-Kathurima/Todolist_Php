<?php 
try{

 $conn = new PDO('mysql:host=localhost;dbname=todolist', 'root', '');
 
}
catch(PDOException $e){

echo $e->getMessage();

}

 ?>