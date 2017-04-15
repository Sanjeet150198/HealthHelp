<?php include_once ("../classes/Controller.php");
$obj=new Controller;
//$obj->stop_access_login();
//$obj->login_check();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Blood Bank Management System</title>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/footer-distributed.css">
<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome.min.css">

<script src="../jquery-3.0.0.min.js"></script>
<script src="../assets/js/jquery-1.12.3.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>

<!--Starting scrollspy coding-->
<script>

$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});

</script>
<!--end of scrollspy coding-->

<style>
  body {
      position: relative; 
  }
  .affix {
      top:0;
      width: 100%;
      z-index: 9999 !important;
  }
  .navbar {
      margin-bottom: 0px;
  }

  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }
  #section1 {padding-top:50px;height:650px; width:100%; color: #000; background-color: #fff;}
  #section6{padding-top:50px; height:300px; max-height:auto !important; width:100%; float:left;}
 	
  </style>
  
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
<!-- start upper header -->
<div class="container-fluid" style="background-color:#EDEDED; padding:8px;">
  <div class="container">
     <div class="row">
         <div class="col-md-4">
         <p class="topp_header_1"> Designed and Managed By Sanjeet </p>
         </div>
         
         <div class="col-md-6">
         
         <div class="row">
         
         <p class="topp_header_2"> 023 1640 1515 </p>
         
         </div>
         </div>
         
         <div class="col-md-2">
         <div class="row">
         <p class="topp_header_3">Admin</p>
         </div>
         </div>
     </div>
  </div>
</div>
<!-- end upper header -->
<!-- header coding-->
<div class="container-fluid" style="background-color:#fff;height:350px; width:auto;">
    <img src="../assets/image/bloodbanksoftware.jpg" alt="Blood Bank System" class="img-responsive">
</div>
<!--end of header coding-->

<!--starting nav bar coding-->

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="360">
  <div class="container-fluid">
    <div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Blood Bank System</a>
      
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="dashboard.php"> <span class="glyphicon glyphicon-envelope" > </span> Inbox </a></li>
         <li><a><span class="glyphicon glyphicon-tint" > </span> Donor </a>
          <ul class="dropdown-menu">
              <li><a href="active.php">active donors</a></li>
              <li><a href="deactive.php">deactive donors</a></li>
            </ul>
          </li>
         <li><a href="view_patient.php"> <i class="fa fa-hospital-o"></i> Need Blood</a>
         </li>
          <li><a href="#"> <i class="fa fa-hotel"></i> camp </a></li>
          <li><a target="_self" href="logout.php"> <span class="glyphicon glyphicon-log-out" > </span> Log Out </a>
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>    

<!--end of nav bar coding-->
<!--starting section coding-->

<!--Starting home coding-->

<div id="section1">

<!--Your content goes here-->



