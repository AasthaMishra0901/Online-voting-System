<?php
include('user.php');
if(isset($_POST["votebtn"]))
{
$link=mysqli_connect("localhost","root","","voting");
$votes=$_POST["gvotes"];
$total_votes=$votes+1;
$gid=$_POST['gid'];
$uid=$_POST['uid'];
$update_votes=mysqli_query($link,"UPDATE information SET votes='$total_votes' WHERE id='$gid'");
$update_status=mysqli_query($link,"UPDATE information  set status=1 where id='$uid' "); 
//$update_votes="update information set votes='$total_votes' where id='$gid' ";
//$update_status="update information set status=1 where id='$uid' ";
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
else
		{
	      echo'
	           <script>
	             alert("some error occoured!!");
	           </script>';
        }
}
?>
</body>
</html>
