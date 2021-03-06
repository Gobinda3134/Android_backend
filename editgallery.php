<?php include('includes/header.php');?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';

	$image_baseurl="http://localhost/backend/gallery";
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT image_name, image_caption FROM tbl_gallery WHERE image_id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: viewgallery.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$imagecaption = $_POST['image_caption'];
		
		$imgFile = $_FILES['image_name']['name'];
		$tmp_dir = $_FILES['image_name']['tmp_name'];
		$imgSize = $_FILES['image_name']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'gallery/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$imagename = rand(1000,1000000).".".$imgExt;
			$staffimageurl=$image_baseurl."/".$imagename;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['image_name']);
					move_uploaded_file($tmp_dir,$upload_dir.$imagename);
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
			$imagename = $edit_row['image_name']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_gallery 
									     SET image_name=:uname, 
										     image_caption=:ucaption,
										     gallery_url=:uimageurl
								       WHERE image_id=:uid');
			$stmt->bindParam(':uname',$imagename);
			$stmt->bindParam(':ucaption',$imagecaption);
			$stmt->bindParam(':uid',$id);
			$stmt->bindParam(':uimageurl',$staffimageurl);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='viewgallery.php';
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
</head>
<body>



<div class="container">


	<div class="page-header">
    	<h1 class="h2">Update Gallery  <a class="btn btn-default" href="viewgallery.php"> All Gallery </a></h1>
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
    	<td><label class="control-label">Staff Image</label></td>
        <td>
        	<p><img src="gallery/<?php echo $image_name; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="image_name" accept="image/*" />
        </td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Caption</label></td>
        <td><input class="form-control" type="text" name="image_caption" placeholder="Caption" value="<?php echo $image_caption; ?>" /></td>
    </tr>
	 <tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="viewgallery.php"> <span class="glyphicon glyphicon-backward"></span> Cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>


</div>
</body>
</html>