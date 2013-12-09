<?php


include("account.php");
($dbh = mysql_connect($hostname, $username, $password)) or die("Unable to connect to MySQL database");
mysql_select_db($project) or die("Incorrect database name");
//echo "Connected to MySQL<br>";

if ($_REQUEST["password"] == "password") {
    $username = $_REQUEST["username"];
    $fullName = $_REQUEST["fullName"];
    $email    = $_REQUEST["email"];
    $address  = $_REQUEST["address"];
    
    $fullName = mysql_real_escape_string($fullName);
    
    $sql = "insert into Registered values ('$username' , '$fullName' , '$email', '$address')";
    
    mysql_query($sql);
    $error = mysql_error();
    
    if ($error != "") {
		echo "<html>
		<div style = \"border:2px solid; border-radius:25px; text-align:center; width: 50%; margin:0px auto; \"> 
        Failed to register user $username<br><br>
		Reason: user $username name exists<br><br>
		 <a href = \"index.html\"> Click here to go back </a> 
		</div>
		</html>";
    } else {
        echo " <html>
		<div style = \"border:2px solid; border-radius:25px; text-align:center; width: 50%; margin:0px auto; \"> 
		User $username was registered succuessfully<br><br>
		an email was sent to $email to confirm address: $address <br><br>
        <a href = \"index.html\"> Click here to go back </a> 
		</div>
		<html>"
		;
    }
    
} else {
    echo "Incorrect password, please try again";
}
?>