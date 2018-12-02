<?php
	
	///session_set_cookie_params(12*3600); 	
	
	session_start();
 	$server = 'localhost';
	
	$database = 'todolist';

	$userDB = 'root';
	$passwordDB = '';
	$dbprefix = '';
	
	$ftpserver="";
	$ftplogin="";
	$ftppassword="";

	function db(){
    global $link;
    $link = mysqli_connect('localhost', 'root', '', 'todolist') or die("couldn't connect to database");
    return $link;
}

   
?>