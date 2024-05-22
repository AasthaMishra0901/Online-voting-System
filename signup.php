<?php
$link=mysqli_connect("localhost","root","","voting");
if(isset($_POST["sub1"]))
{
	
	$userid=$_POST["t1"];
	$pass=$_POST["t2"];
	$privilege=$_POST["t3"];
	$name=$_POST["t4"];
	$branch=$_POST["t5"];
	$gender=$_POST["t6"];
	$dob=$_POST["t7"];
	
	 $file=addslashes(file_get_contents($_FILES["t9"]["tmp_name"]));
	 $regno=$_POST["t10"];
	 
	$sql="insert into information(userid,pass,privilege,name,branch,gender,dob,photo,regno)
values('$userid','$pass','$privilege','$name','$branch','$gender','$dob','$file','$regno')";
   
    if(mysqli_query($link,$sql))
      {
           echo '<script>alert("REGISTRATION SUCCESSFUL")</script>';
		    
      }
    else
      {
           echo '<script>alert("error occoured could not submit")</script>';	
           echo mysqli_error($link);
      }
	  
}
?>

<html>
 <head>
   <title>voting system</title>
   <link href="dsg.css" rel="stylesheet">
</head>
<div class="d3"><img src="vote.png"></img></div>
<body>
<style>
#gendler{
	width:700px;
	border:2px solid black;
	border-radius:5px;
	padding:10px;
	
}
#gender input{
	width:10%;
	height:3%;
	border:1px;
	padding:8px 8px 8px 8px;
	border-radius:5px;
	margin:10px 0px 15px 0px;
	box-shadow:1px 1px 2px 1px grey;
	font-size:16;
	font-weight:bold;
	}
</style>
 <div class="heading">
   <u><h1>ONLINE VOTING</h1></u><hr>
   <h4> REGISTRATION FORM</h4>
 </div>
<center>
       <div class="bd"> <form action="#" method="POST" enctype="multipart/form-data">
       <b>NAME:</b><br><input type="text" name="t4" placeholder="Enter Name"><br><br>
       <b>USER ID:</b><br><input type="text" name="t1" placeholder="Enter user id"><br><br>
       <b>PASSWORD:</b><br><input type="password" name="t2" placeholder="Enter Password"><br><br>
       <b>REGISTRATION NUMBER:</b><br><input type="text" name="t10" placeholder="Enter Registration number"><br><br>
       <b>BRANCH:</b><br><input type="text" name="t5" placeholder="Enter Branch "><br><br>
       <b>DATE OF BIRTH:</b><br><input type="date" name="t7"><br>
<center>
<div id="gender">
      <font-size="20"><b>GENDER:&nbsp </b><br></font>
      MALE<input type="radio" name="t6" value="male">&nbsp&nbsp
      FEMALE<input type="radio" name="t6" value="female"></div><br>
     <b>UPLOAD IMAGE:</b><br><input type="file" name="t9" id="t9" accept="image/jpeg"><br><br>
</center>

     <b>PRIVILEGE:</b><br><select class="dropbox" type="select" name="t3"><br><br>
     <option value="voter">VOTER</option><br><br>
     <option value="contestant">CONTESTANT</option></select><br><br><br>
      <input class="lb" type="submit" name="sub1"><br><br>
      ALREADY USER?<a href="login.php">LOGIN HERE</a>
</center>
</div>
</form>
</body>
</html>
