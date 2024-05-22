<?php
session_start();
if($_SESSION['userdata'])
{
	
echo "<h2> &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp WELCOME &nbsp".$_SESSION['name']." FOR VOTING </h2>";
}

else
{
	header('Location:login.php');
}

$link=mysqli_connect("localhost","root","","voting");
{
	$grpsql="select * from information where privilege='contestant'";
    $gresult=mysqli_query($link,$grpsql);
    $grow=mysqli_fetch_all($gresult);
    $_SESSION['grpdata']=$grow;

$userdata=$_SESSION['userdata'];
$grpdata=$_SESSION['grpdata'];
if($_SESSION['userdata'][11]==0)
{
	$status='<b style="color:red">NOT VOTED</b>';
}
else
{
	$status='<b style="color:green">VOTED</b>';
	$_SESSION['userdata'][11]=1;
}


?>
<html>
<head>
<title>voting system</title>
<link href="dsg.css" rel="stylesheet">
</head>
<div class="d3"><img src="myvote.png"></img></div>
<body>
<ALIGN="RIGHT"><a href="logout.php"><input class="lb" type="submit" name="sub1" VALUE="LOGOUT"></a></ALIGN>
<div class="heading">
<u><h1>ONLINE VOTING</h1></u><hr>
</div>
<div class="bln"><br>
</div>
<div class="vot" >
<?php

{
	?>
<table   border=2 border-collapse=collapse cellpadding="5" >	
<tr><th>
<?php echo '<img src="data:image;base64,'.base64_encode($userdata[8]).'" alt="image" style="width:110px; height:110px;"/>';?>
<align="left"><HR><b>NAME:</b> <?php echo $userdata[3]; ?><br>
<b>REGISTRATION NO.:</b> <br><?php echo $userdata[9]; ?><br>
<b>BRANCH:</b> <?php echo $userdata[4]; ?><br>
<b>GENDER:</b> <?php echo $userdata[5]; ?><br>
<b>DATE OF BIRTH:</b> <?php echo $userdata[6]; ?><br>
<b>STATUS:</b> <?php echo $status; ?>
</th>
</align>
</tr>
<?php

}
?>
</table>
</div>
<div class="blnk"><br>
</div>
<div class="contestant"> 
<form action="#" method="POST" enctype="multipart/form-data">
<table width:50% border=1 border-collapse=collapse cellpadding="5" text-align="center" cellspacing="5">
 <?php
echo "<tr>
<th>PHOTO</th>
<th>NAME</th>
<th>REGISTRATION NUMBER</TH>
<th>BRANCH</th>
<th>GENDER</th>
<th>DATE OF BIRTH</th>
<th>TOTAL VOTES</th>
</tr>";

if($_SESSION['grpdata']){
	
 for($i=0; $i<count($grpdata); $i++)
	 
	{
	?>
<tr>
<td> <?php echo '<img src="data:image;base64,'.base64_encode($grpdata[$i][8]).'" alt="image" style="width:100px; height:100px;"/>';?></td>
<td><br><?php echo $grpdata[$i][3]; ?></td>
<td><?php echo $grpdata[$i][9]; ?></td>
<td><?php echo $grpdata[$i][4]; ?></td>
<td><?php echo $grpdata[$i][5]; ?></td>
<td><?php echo $grpdata[$i][6]; ?></td>
<td><?php echo $grpdata[$i][10]; ?></td>
<form action="#" method="POST">
<?php
if($_SESSION['userdata'][11]==0){
	{	?>
<td>
<input class="vb" type="submit" name="sub" value="vote" >
    <input type="hidden" name="gvotes" value="<?php echo $grpdata[$i][10]; ?> ">
    <input type="hidden" name="gid" value="<?php echo $grpdata[$i][7]; ?>">
</td>
</tr>

<?php
	}
}
else
{
	?>
<td>
<input class="vb" type="submit" name="sub" value="vote" disabled style="background-color:#9CBA7F"></td>
<input type="hidden" name="gvotes" value="<?php echo $grpdata[$i][10]; ?>" disabled>
    <input type="hidden" name="gid" value="<?php echo $grpdata[$i][7]; ?>"disabled>


</tr>
<?php

}
?>
	<input type="hidden" name="uid" value="<?php echo $userdata[7]; ?>">
<?php
	}
	
}
echo "</table>";
}
?>
</div>
<?php
if(isset($_POST["sub"]))
{
$link=mysqli_connect("localhost","root","","voting");
$votes=$_POST["gvotes"];
$total_votes=$votes+1;
$gid=$_POST['gid'];
$uid=$_POST['uid'];
$update_votes=mysqli_query($link,"UPDATE information SET votes='$total_votes' WHERE id='$gid'");
$update_status=mysqli_query($link,"UPDATE information  set status=1 where id='$uid' "); 
echo mysqli_error($link);

if($update_votes and $update_status)
{
	$grpsql="select * from information where privilege='contestant'";
    $gresult=mysqli_query($link,$grpsql);
    $grow=mysqli_fetch_all($gresult);
	$_SESSION['grpdata']=$grow;
    $_SESSION['grpdata']=$grpdata;
    $_SESSION['userdata'][11]=1;

	
}

}
?>
</body>
</html>
