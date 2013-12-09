<?php


include("account.php");
($dbh = mysql_connect($hostname, $username, $password)) or die("Unable to connect to MySQL database");
mysql_select_db($project) or die("Incorrect database name");


$password = sha1($_POST ['password']);


$passCheck = mysql_query("SELECT COUNT(*) FROM passHash WHERE Password = '$password'");

if (mysql_result($passCheck,0) > 0){
	$reportType = $_POST["reportType"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	
	if($reportType == 'single'){
		$user = mysql_query("SELECT * FROM Registered WHERE UserName = '$username'");
		$report = mysql_fetch_array($user);
		
		$content .="
			
			<center>
			<h1> Single User Report </h1>
			<table border=0 width=30%   >
			<tr>
			<td width=33% >".$report['UserName']."<br>".$report['FullName']."<br>".$report['Email']."</td>
			<td width = 33%></td>
			<td width=33%  >".nl2br($report['Address'])."</td>
			</tr>
			";
		
		$lookupGrade = mysql_query("SELECT * FROM Grades WHERE UserName ='".$report['UserName']."'");	
		while($grade = mysql_fetch_array($lookupGrade)){
			$content .="
			<tr ><td colspan = 3 style = \"background-color: lightgrey \"> Course: ".$grade['Course']."</td></tr>
			<tr>
				<td width = 33%> Grade 1: ". $grade['A1']."</td> 
				<td width = 33%> Grade 2: ". $grade['A2']."</td> 
				<td width = 33%> Grade 3: ". $grade['A3']."</td> 
			</tr>
			<tr ><td colspan = 3 style = \"text-align: right; background-color: lightgrey \"> Total: ".$grade['Total']."</td></tr>
					
			
			
			";
			$content .= "<tr><td colspan = \"3\"><br /></td></tr>";
			}
			$content .= "<tr><td colspan = \"3\"><hr /></td></tr>";
			
			
			$content .="
			</table>
			  <a href = \"index.html\"> Click here to go back </a> &nbsp; &nbsp;   <a href = \"reports.html\"> Click here for another report </a> 
			</center>";
		

	}else{
		$user = mysql_query("SELECT * FROM Registered ");
		$content .= "<center><h1> All Users Report </h1>";
		while($report = mysql_fetch_array($user)){
		
		$content .="
			
			<center>
			<table border=0 width=30%   >
			<tr>
			<td width=33% >".$report['UserName']."<br>".$report['FullName']."<br>".$report['Email']."</td>
			<td width = 33%></td>
			<td width=33%  >".nl2br($report['Address'])."</td>
			</tr>
			";
		
		$lookupGrade = mysql_query("SELECT * FROM Grades WHERE UserName ='".$report['UserName']."'");	
		while($grade = mysql_fetch_array($lookupGrade)){
			$content .="
			<tr ><td colspan = 3 style = \"background-color: lightgrey \"> Course: ".$grade['Course']."</td></tr>
			<tr>
				<td width = 33%> Grade 1: ". $grade['A1']."</td> 
				<td width = 33%> Grade 2: ". $grade['A2']."</td> 
				<td width = 33%> Grade 3: ". $grade['A3']."</td> 
			</tr>
			<tr ><td colspan = 3 style = \"text-align: right; background-color: lightgrey \"> Total: ".$grade['Total']."</td></tr>
					
			
			
			";
			$content .= "<tr><td colspan = \"3\"><br /></td></tr>";
			}
			$content .= "<tr><td colspan = \"3\"><hr /></td></tr>";
			
			$content .="
			</table>
			 <a href = \"index.html\"> Click here to go back </a> &nbsp; &nbsp;   <a href = \"reports.html\"> Click here for another report </a> 
			</center>";
		}
		
			
	}
			echo $content;

}
else{echo"Your password is incorrect";}

$content = "<html><body>$content</body></html>";

if($email != ""){
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "To: $email" . "\r\n";
	$headers .= 'From: IT202 Assignment 2 <sab9@njit.edu>' . "\r\n";
	mail($email, "It202 User report", $content, $headers);
}



?>