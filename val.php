<!DOCTYPE html>
<?php
include("account.php");
($dbh = mysql_connect($hostname, $username, $password)) or die("Unable to connect to MySQL database");
mysql_select_db($project) or die("Incorrect database name");
?>
<head>
<script type="text/Javascript">
function check()
{
	var result = true;
	
	var p = /^[a-z]{2,3}[0-9]+/
	var s = document.getElementById("ucid").value
	
	if(s.search (p) == -1)
	{
		alert ("UCID must be 3 letters followed by one or more digits");
		result = false;
	}	
	
	return result;
	
}	


function errorCheck(id)
{
	
	s = document.getElementById(id).value
	
	
	p = /^[a-z]{3}[1-9]+/
	document.getElementById('error').innerHTML=""
	if(s.search(p) == -1)
	{
		document.getElementById('error').innerHTML = "Must be 3 letters followed by digit"
		//return false;
	
	}  
	
	p = /[~!@#$%^&*]/
	
	if(s.search(p) != -1)
	{
		document.getElementById('error').innerHTML = "Can not contain special characters"
		//return false;
	
	}  
	

	
	if(s.length > 8)
	{
		document.getElementById('error').innerHTML = "Can not be more than 8 characters"
		//return false;
	
	}  
	
	p = /^[0-9]/
	
	if(s.search(p) != -1)
	{
		document.getElementById('error').innerHTML = "Can not start with a number"
		//return false;
	
	}  
	
	p = /[A-Z]/
	
	if(s.search(p) != -1)
	{
		document.getElementById('error').innerHTML = "Can not contain captial letters"
		return false;
		
		
	}
	
	
	
	return true;

}
	
function infoHelper(id,action)
{
	if (action == 'show')
	{
		document.getElementById(id).style.display = 'block';
	}else{
			document.getElementById(id).style.display = 'none';
	
	}
	


}


</script>


</head>



<form  action = "output.php" onSubmit = "return check()" method = "POST">
<div style = "border: solid black thin;
			  width: 500px;
			  margin:0px auto;">
<fieldset>
<legend> Enter Data </legend>
<div name="error" id = "error">
</div>
<div name ="test" id = "test" style = "display:none; float:right; width:150px; height:100px; background:red; color:white;padding:5px;">
		Zipcode must be 5 or nine digits long
		if 9 digits separate last 4 with a dash
</div>
<input type = "text" name = "ucid" id = "ucid"
	
	autofocus
	required 
	title= "Must start with letter"
	placeholder = "Please enter UCID"
	onkeyup="errorCheck('ucid')"

> UCID <br> 


<input type = "password" name = "password"
auto-complete = "off" 
	required 
	title= "Must contain upper case letter, lower case letter and a number, 4-8 digits long and can contain # or ! "
	pattern ="(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9#!]{4,8}"
	id = "password"
> Password<br>


<input type = "email" name = "email"
    title = "Enter valid Email address"
	placeholder = "Please enter email"
	id = "email"
> Email <br>

<select name = "list" id ="list">
<option>Please select municipality</option>
<?php
$selectm = mysql_query("SELECT * FROM municipalities");

while($result = mysql_fetch_array($selectm)){
	echo "<option>".$result['Name']."</option>";
}
?>
</select><br>

<input type = "text" name = "zip"
	
	placeholder = "Please enter zipcode"
	id = "zip"
	title= "Must be 5-9 digit zip with only a single dash "
	onmouseover = "infoHelper('test','show')"
	onmouseout = "infoHelper('test','hide')"
	pattern="[0-9\-]{5,10}"
> ZipCode <br>

<input type = "text"
	id = "address"  name = "address"
	width="100" height="100" 
	pattern ="[a-zA-Z0-9\.,\-\s]+" title = "must be a valid address">
Address <br>







<input type = "submit" value = "submit" /> <br><br>



</fieldset>
</div>

</form>