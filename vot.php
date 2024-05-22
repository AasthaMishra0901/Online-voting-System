<?php
include('user.php');
if(isset($_POST["votebtn"]))
{
	$votes=$_POST['gvotes'];
    $total_votes=$votes+1;
    $gid=$_POST['gid'];
    $update_votes=mysqli_query($link,"UPDATE information SET votes='$total_votes' WHERE id='$gid'"); 
    echo mysqli_error($link);
      if($update_votes)
        {
           $link=mysqli_connect("localhost","root","","voting");
	       $grpsql="select * from information where privilege='contestant'";
           $gresult=mysqli_query($link,$grpsql);
           $grow=mysqli_fetch_all($gresult,MYSQLI_ASSOC);
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