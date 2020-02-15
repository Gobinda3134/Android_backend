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
    	<h1 class="h2">Add New Notice <a class="btn btn-default" href="viewnotice.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View all </a></h1>
    </div>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Upload Notice</title>
    
        <?php

        $image_baseurl="http://localhost/backend/download";
        //$image_baseurl="http://prembasnet.com.np/download";
			if(!empty($_POST))
			{
				$con = mysqli_connect("localhost","root","");
				if (!$con)
					echo('Could not connect: ' . mysqli_error());
				else
				{
					if (file_exists("notice/" . $_FILES["file"]["name"]))
					{
						echo '<script language="javascript">alert(" Sorry!! Filename Already Exists...")</script>';
					}
					else
					{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"download/" . $_FILES["file"]["name"]) ;
						mysqli_select_db($con,'e_softwarica');
                        $staffimageurl=$image_baseurl."/".$_FILES["file"]["name"];
						$sqli = "INSERT INTO tbl_notice(notice_title,notice_date,notice_description,noticeurl) VALUES ('" . $_POST["title"] ."','" . $_POST["date"] . "','" . $_FILES["file"]["name"] ."','$staffimageurl');";
						if (!mysqli_query($con,$sqli))
							echo('Error : ' . mysqli_error());
						else
							echo '<script language="javascript">alert("Thank You!! File Uploded")</script>';
						}
				}
				mysqli_close($con);
			}
        ?>
    </head>
     <body>
	   <div class="container home">
      <br>
		
        <form id="form3" enctype="multipart/form-data" method="post" action="addnotice.php">
             <table class="table table-bordered">         	
                <tr>
                    <td>	<label for="sub">Notice Title</label>	</td>
                    <td>	<input type="text" name="title" id="title" class="input-medium"  
					         required autofocus placeholder="Notice Title"/>	</td>
                </tr>
                <tr>
                    <td valign="top" align="left">Date</td>
                    <td valign="top" align="left"><input type="text" name="date" cols="50" rows="10" id="date"  
					placeholder="Date"
					class="input-medium" required></textarea></td>
                </tr>
                                <tr>
                    <td><label for="file">File:</label></td>
                    <td><input type="file" name="file" id="file" 
                        title="Click here to select file to upload." required /></td>
                </tr>
                <tr>
                  
				   <td colspan="2" align="center">		    
				   <input type="submit" class="btn btn-primary" name="upload" id="upload" 
				   title="Click here to upload the file." value="Upload File" /> </td>
                </tr>				

            </table>
        </form>
		</div>
    </body>
</html>
