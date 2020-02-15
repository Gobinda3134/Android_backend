<?php include('includes/header.php');?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	$image_baseurl="http://localhost/backend/staff_images";
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT staff_full_name, staff_designation, staff_contact_number, staff_category, staff_image, staff_image_url FROM tbl_staff WHERE staff_id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: viewstaff.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$staffname = $_POST['staff_name'];
		$staffdesignation = $_POST['staff_designation'];
		$staffcontact = $_POST['staff_contact'];
		$staffcategory = $_POST['staff_category'];
		
		$imgFile = $_FILES['staff_image']['name'];
		$tmp_dir = $_FILES['staff_image']['tmp_name'];
		$imgSize = $_FILES['staff_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'staff_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$staffpic = rand(1000,1000000).".".$imgExt;
				$staffimageurl=$image_baseurl."/".$staffpic;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['staff_image']);
					move_uploaded_file($tmp_dir,$upload_dir.$staffpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$staffpic = $edit_row['staff_image']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_staff 
									     SET staff_full_name=:uname, 
										     staff_designation=:udesignation, 
										     staff_contact_number=:ucontact,
											 staff_category=:ucategory,
											 staff_image=:uimage,
											 staff_image_url=:uimageurl
								       WHERE staff_id=:uid');
			$stmt->bindParam(':uname',$staffname);
			$stmt->bindParam(':udesignation',$staffdesignation);
			$stmt->bindParam(':ucontact',$staffcontact);
			$stmt->bindParam(':ucategory',$staffcategory);
			$stmt->bindParam(':uimage',$staffpic);
			$stmt->bindParam(':uimageurl',$staffimageurl);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='viewstaff.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
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


<div class="container">


	<div class="page-header">
    	<h1 class="h2">Update Profile  <a class="btn btn-default" href="staffeditform.php"> All Staffs </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
        <tr>
    	<td><label class="control-label">Full Name</label></td>
        <td><input class="form-control" type="text" name="staff_name" placeholder="Enter Full Name" value="<?php echo $staff_full_name; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Designation</label></td>
        <td><input class="form-control" type="text" name="staff_designation" placeholder="Your Designation" value="<?php echo $staff_designation; ?>" /></td>
    </tr>
	 <tr>
    	<td><label class="control-label">Contact Number</label></td>
        <td><input class="form-control" type="text" name="staff_contact" placeholder="Your Contact Number" value="<?php echo $staff_contact_number; ?>" /></td>
    </tr>
	<tr>
    	<td><label class="control-label">Category</label></td>
        <td><input class="form-control" type="text" name="staff_category" placeholder="Your Category" value="<?php echo $staff_category; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Staff Image</label></td>
        <td>
        	<p><img src="staff_images/<?php echo $staff_image; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="staff_image" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="viewstaff.php"> <span class="glyphicon glyphicon-backward"></span> Cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>


</div>
</body>
</html>