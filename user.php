<?php
session_start();
if($_SESSION['userdata'])
{
	
echo "<h2>&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp
 &nbsp WELCOME &nbsp".$_SESSION['name']." FOR VOTING </h2>";
 
}

else
{
	header('Location:login project.php');
}

 $link=mysqli_connect("localhost","root","","voting");
  {
	$na=$_SESSION['userdata'][3];
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
	     $status='<b style="color:GREEN">VOTED</b>';
         $_SESSION['userdata'][11]=1;
	     $update_status=mysqli_query($link,"UPDATE information  set status=1 where name='$na' ");

		    echo'
	             <script>
	               alert("VOTING SUCCESSFUL!!");
	             </script>'; 
			 
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
           <align="left"><HR><b><u>NAME:</u></b> <?php echo $userdata[3]; ?><br>
           <b><u>REGISTRATION NO.:</u></b> <br><?php echo $userdata[9]; ?><br>
           <b><u>BRANCH:</u></b> <?php echo $userdata[4]; ?><br>
           <b><u>GENDER:</u></b> <?php echo $userdata[5]; ?><br>
           <b><u>DATE OF BIRTH:</u></b> <?php echo $userdata[6]; ?><br>
           <b><u>STATUS:</u></b> <?php echo $status; ?></th></tr>
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
           <th>TOTAL VOTES</th></tr>";

              if($_SESSION['grpdata']){
                for($i=0; $i<count($grpdata); $i++)
				 {?>
                     <tr>
                     <td> <?php echo '<img src="data:image;base64,'.base64_encode($grpdata[$i][8]).'" alt="image" style="width:100px; height:100px;"/>';?></td>
                     <td><br><?php echo $grpdata[$i][3]; ?></td>
                     <td><?php echo $grpdata[$i][9]; ?></td>
                     <td><?php echo $grpdata[$i][4]; ?></td>
                     <td><?php echo $grpdata[$i][5]; ?></td>
                     <td><?php echo $grpdata[$i][6]; ?></td>
                     <td><?php echo $grpdata[$i][10]; ?></td>
                     <td><form action=VOT.PHP method="POST">
                     <input type="hidden" name="gvotes" value="<?php echo $grpdata[$i][10]; ?> ">
                     <input type="hidden" name="gid" value="<?php echo $grpdata[$i][7]; ?>">
                     <?php
                       if($_SESSION['userdata'][11]==0)
					     {	?>
                            <input class="vb" type="submit" name="votebtn" value="vote" ></td></tr>
							<?php
                         }
                       else
                         {   ?>
                            <input class="vb" type="submit" name="sub" value="voted" disabled style="background-color:#9CBA7F"></td>
                            </tr>
                             <?php
                         }
                               ?>
							 
                           </form>
                         <?php
	                      }
	                   }
                       echo "</table>";
					}
                       ?>
</div>
</body>
</html>
