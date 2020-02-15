<?php
error_reporting(0);
include('includes/dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Softwarica</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }
    </style>

</head>

<body>

    <!-- Navigation -->
<?php include('includes/header.php');?>
<?php include('includes/slider.php');?>
   
    <!-- Page Content -->
    <div class="container">

        <h1 class="my-4">Welcome to E-Softwarica</h1>

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header">Global Certification Course</h4>
                   
                        <p class="card-text" style="padding-left:2%">Cisco Systems, USA Softwarica College of IT and E-Commerce is 
						one of the few Authorized Local Academy of Cisco Systems, USA   Cisco Certified Network Associate (CCNA) Networking 
						Academy delivers a comprehensive, 21st century learning experience
						to help students develop the foundation. </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header">Our Academic Programme</h4>
                   
                        <p class="card-text" style="padding-left:2%">Career Aspects Gives you the skills to demonstrate the technical and 
						personal skills necessary for taking part in the design, implementation and management of modern computer systems.
						This degree gives you the ability to meet the challenges and responsibilities of computer practitioners, demanded. </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header">Credit Transfer</h4>
                   
                        <p class="card-text" style="padding-left:2%">Softwarica College offers UK Qualification namely, Diploma and Adv. Diploma
						in Computing(1st and 2nd year of UK bachelors degree) which are readily transferable to Australian Colleges and Universities.
						This transfer arrangement makes Australian education more affordable, contributes to meet academi. </p>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2>Message From Chairman</h2>
          <p> There is a very good scope in Nepal for students who want to pursue their career in IT education. The global demand 
		  for highly qualified IT professionals is ever increasing rapidly which is not limited within Nepal only. For past few years, Nepal
		  has seen growing number of investments from national and multinational companies. Outsourcing has flourished which has increased 
		  employment opportunities for youth of Nepal who want to make decent career in IT industry. Access to internet has been more affordable
		  than ever before. Various sectors are reaping advantage of this and there is a huge potential for Information Technology to grow its market 
		  sector in coming days.</p>
		  
		  <p>– Bigyan Shrestha </br>
				Chairman</p>
				
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="images/blood-donor(1).jpg" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
            <h4>Clubs At Softwarica</h4>
                <p>
Student clubs at Softwarica College have been formed to organize various extracurricular activities for students.
New club executive members are elected on September every year and will have at least one member from each class. The executive member positions are appointed by the College Coordinator and executive members of each club would appoint the Club Coordinator either by mutual understanding or by election.</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block" href="Contact.php">Contact Us</a>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
  <?php include('includes/footer.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
