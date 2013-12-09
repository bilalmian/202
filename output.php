<?php
	$ucid = $_POST['ucid'];
    $state = $_POST['list'];
	$email = $_POST['email'];
	$zip = $_POST['zip'];
	$addr = $_POST['address'];
	
	echo "<html>
		<div style = \"border:2px solid; border-radius:25px; text-align:center; width: 50%; margin:0px auto; \"> 
        UCID: $ucid <br>
		Municipality: $state <br>
		Email: $email <br>
		ZipCode: $zip <br>
		Address: $addr <br>
		</div>
		</html>";
		
?>