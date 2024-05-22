<?php
session_start();
$link=mysqli_connect("localhost","root","","voting");
if(isset($_POST["sub"]))
{
  $userid=$_POST["t1"];
  $pass=$_POST["t2"];
  $privilege=$_POST["t3"];
  $sql= "select * from information where
  userid='$userid' and pass='$pass' and privilege='$privilege'";
  $result=mysqli_query($link,$sql);
  $row=mysqli_fetch_row($result);
   if($row>1)
    {
      $_SESSION['name']=$row[3];
	  $_SESSION['userdata']=$row;
	  header('Location:vot.php');
    }
	else
	{
		echo'<script>
		alert("INCORRECT LOGIN");
		</script> ';
	}
}
?>
<html>
  <head>
     <title> voting system</title>
  <link href="dsg.css" rel="stylesheet" >
  </head>
  <div class="d3"><img src="vote.png"></img></div>
  <body>
  <div class="heading"><u><h1>ONLINE VOTING</h1></u><hr> </div>
  <div class="bd">
    <form action="#" method="POST">
                USER ID<input type="text" name="t1" placeholder="Enter user id"><br><br>
                PASSWORD<input type="password" name="t2" placeholder="Enter Password"><br><br>
                PRIVILEGE<select class="dropbox" type="select" name="t3"><br>
                <option value="voter">VOTER</option>
                <option value="contestant">CONTESTANT</option></select><br><br>
                <input class="lb" type="submit" name="sub" value="LOGIN">
                <br><br>
                <font size=4>new user?</font><a href="signup.php"> REGISTER HERE</a></div>
    </form>
  </body>
</html>
