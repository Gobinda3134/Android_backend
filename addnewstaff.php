<?php include('includes/header.php');?>

<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'dbconfig.php';

	$image_baseurl="http://localhost/backend/staff_images";
	//$image_baseurl="http://prembasnet.com.np/staff_images";
	
	if(isset($_POST['btnsave']))
	{
		$staffname = $_POST['staff_name'];
		$staffdesignation = $_POST['staff_designation'];
		$staffcontact = $_POST['staff_contact'];
		$staffcategory = $_POST['staff_category'];
		
		$imgFile = $_FILES['staff_image']['name'];
		$tmp_dir = $_FILES['staff_image']['tmp_name'];
		$imgSize = $_FILES['staff_image']['size'];
		
		
		if(empty($staffname)){
			$errMSG = "Please Enter Username.";
		}
		else if(empty($staffdesignation)){
			$errMSG = "Please Enter Your Job Work.";
		}
		else if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'staff_images/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg','pdf', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$staffpic = rand(1000,1000000).".".$imgExt;
			$staffimageurl=$image_baseurl."/".$staffpic;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$staffpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO tbl_staff(staff_full_name,staff_designation,staff_contact_number,staff_category,staff_image,staff_image_url) VALUES(:uname, :udesignation, :ucontact, :ucategory, :uimage, :uimageurl)');
			$stmt->bindParam(':uname',$staffname);
			$stmt->bindParam(':udesignation',$staffdesignation);
			$stmt->bindParam(':ucontact',$staffcontact);
			$stmt->bindParam(':ucategory',$staffcategory);
			$stmt->bindParam(':uimage',$staffpic);
			$stmt->bindParam(':uimageurl',$staffimageurl);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("viewstaff.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
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

</head>
<body>


<div class="container">


	<div class="page-header">
    	<h1 class="h2">Add New Staff <a class="btn btn-default" href="viewstaff.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View all </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Full Name</label></td>
        <td><input class="form-control" type="text" name="staff_name" placeholder="Enter Full Name" value="<?php echo $staffname; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Designation</label></td>
        <td><input class="form-control" type="text" name="staff_designation" placeholder="Your Designation" value="<?php echo $staffdesignation; ?>" /></td>
    </tr>
	 <tr>
    	<td><label class="control-label">Contact Number</label></td>
        <td><input class="form-control" type="text" name="staff_contact" placeholder="Your Contact Number" value="<?php echo $staffcontact; ?>" /></td>
    </tr>
	<tr>
    	<td><label class="control-label">Category</label></td>
        <td><input class="form-control" type="text" name="staff_category" placeholder="Your Category" value="<?php echo $staffcategory; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Staff Image</label></td>
        <td><input class="input-group" type="file" name="staff_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; SAVE
        </button>
        </td>
    </tr>
    
    </table>
    
</form>


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
