<?php


include("account.php");
($dbh = mysql_connect($hostname, $username, $password)) or die("Unable to connect to MySQL database");
mysql_select_db($project) or die("Incorrect database name");
echo "Connected to MySQL<br>";

if ($_REQUEST["password"] == "password") {
    $username = $_REQUEST["username"];
    $course   = $_REQUEST["course"];
    $a1       = $_REQUEST["a1"];
    $a2       = $_REQUEST["a2"];
    $a3       = $_REQUEST["a3"];
    
    $check = "insert into Registered values  ('$username', '' , '' , '')";
    mysql_query($check);
    
    if (mysql_error() == "") {
        mysql_query(" delete from Registered where UserName = '$username'");
        echo "<html>
		<div style = \"border:2px solid; border-radius:25px; text-align:center; width: 50%; margin:0px auto; \"> 
		User $username has not been registered please <br><br>
		<a href = \"register.html\">click here </a> to register user
		</div>
		";
        exit;
    }
    $sql = "insert into Grades values ('$username' , '$course' , '$a1', '$a2' , '$a3' , '')";
    mysql_query($sql);
    
    if (mysql_error() != "") {
        if ($a1 != "") {
            mysql_query("update Grades set A1 = '$a1' where UserName = '$username' and Course = '$course'");
        }
        
        if ($a2 != "") {
            mysql_query("update Grades set A2 = '$a2' where UserName = '$username' and Course = '$course'");
        }
        
        if ($a3 != "") {
            mysql_query("update Grades set A3 = '$a3' where UserName = '$username' and Course = '$course'");
        }
    }
    
    mysql_query("update Grades set Total = A1 + A2 + A3 where UserName = '$username' and Course = '$course'");
    
    echo "
	<div style = \"border:2px solid; border-radius:25px; text-align:center; width: 50%; margin:0px auto; \"> 
	User $username has been graded<br><br>
	<a href = \"grades.html\">click here </a>to grade another user
	</div>
	";
}
?>
