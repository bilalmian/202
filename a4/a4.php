<?php
include ("account.php");
($dbh = mysql_connect($hostname, $username, $password)) or die("Unable to connect to MySQL database");
mysql_select_db($project) or die("Incorrect database name");

	$active = $_GET['active'];
	
	if($active == "logIn")
	{
		$uname = $_GET['uname'];
		$pass = $_GET['pass'];
		
		$check = mysql_query("SELECT * FROM chat where name = '$uname' AND password = '$pass'");
		
		
		if (mysql_num_rows($check) > 0){
			$data = mysql_fetch_assoc($check);
		
			$output['uname'] = $data['name'];
			$output['status'] = "Logged In";
			$output['content'] = $data['content'];
		}else{
			$output['uname'] = $uname;
			$output['status'] = "Failed";
		
		}
	echo json_encode($output);	
		
	}else if ($active == "update"){
	
		$uname = $_GET['uname'];
		$content = $_GET['content'];
		
		mysql_query("UPDATE chat set content = '$content' WHERE name = '$uname' ");
	
	}else if ($active == "getListen"){
	
		$listenTo = $_GET['listenTo'];
		
		$getContent=mysql_query("SELECT * FROM chat where name = '$listenTo' ");
			$data = mysql_fetch_assoc($getContent);
			
			$output['content'] = $data['content'];
			echo json_encode($output);
	}else if ($active == "getUsers"){
	
		$users = mysql_query("SELECT name FROM chat");
			while($list = mysql_fetch_assoc($users)){
			
				$output['name'][] = $list['name'];
				
			}
			echo json_encode($output);
	}				
	
	
		
		
?>