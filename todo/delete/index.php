<?php 
include("../../../tuongndphp/config.php");
	$id=$_GET['id'];
	if (isset($id)){					
 			db();
            global $link;
			$sql="DELETE FROM tuongnd_todo WHERE id='$id'";			
			$insertTodo = mysqli_query($link, $sql);

			header("Location: ../../../tuongndphp");
		
	}
?>