<?php include('includes/header.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blood Bank & Donor Management System</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
    <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>

<div class="container">


    <div class="page-header">
        <h1 class="h2">All Batch Routine <a class="btn btn-default" href="addroutine.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Add Routine </a></h1>
    </div>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Upload Routine</title>
</head>
<body  align="center">

<br>
<div class="container home">
<font face="comic sans ms">

</font>

 <table class="table table-bordered">
  <thead>
   <tr>
    <th style="text-align: center;"><font face="comic sans ms">Batch</font></th>
    <th style="text-align: center;"><font face="comic sans ms">File</font></th>


  </tr>
   </thead>
    <tbody>
                        <?php

	$link=mysqli_connect("localhost","root","");
	mysqli_select_db($link,'e_softwarica');
	$q="select count(*) \"total\"  from tbl_routine";
	$ros=mysqli_query($link,$q);
	$row=(mysqli_fetch_array($ros));
	$total=$row['total'];
	$dis=3;
	$total_page=ceil($total/$dis);
	$page_cur=(isset($_GET['page']))?$_GET['page']:1;
	$k=($page_cur-1)*$dis;
	$q="SELECT * FROM tbl_routine ORDER BY college_batch ASC limit $k,$dis";
	$ros=mysqli_query($link,$q);
	while($row=mysqli_fetch_array($ros))
	{

		echo '<tr>';
		echo '<td align=center>' .$row['college_batch'];
		
		echo "<td align=center><a title='Click here to download in file.' 
		     href='download.php?id={$row['file_name']}'>{$row['file_name']} </a>"; 
		echo '</tr>';

		
	}
	echo '</table>';
    
	echo  '</tbody>';
	echo '<br/>';
	if($page_cur>1)
	{
	 echo '<a href="display.php?page='.($page_cur-1).'" style="cursor:pointer;color:DeepSkyBlue ;" ><input style="cursor:pointer;background-color:DeepSkyBlue;border:1px black solid;border-radius:5px;width:120px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Previous "></a> ';
     }
	else
	{
	  
	  echo '<input style="background-color:DeepSkyBlue;border:1px black solid;border-radius:5px;width:120px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value=" Previous "> ';
	  
	}
	for($i=1;$i<$total_page;$i++)
	{
		if($page_cur==$i)
		{
		    
			echo '<input style="background-color:DeepSkyBlue ;border:2px black solid;border-radius:5px;width:30px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="'.$i.'"> ';
	
		}
		else
		{
		echo '<a href="display.php?page='.$i.'"> <input style="cursor:pointer;background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:30px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value="'.$i.'"> </a> ';
		
		}
	}
	if($page_cur<$total_page)
	{
		
		echo '<a href="display.php?page='.($page_cur+1).'"><input style="cursor:pointer;background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:90px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Next "></a>';
  	  
	}
	else
	{

	 echo '<input style="background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:90px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="   Next "> ';
     }
   
?>

</div>
</body>
</html>								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
                        
						
  

