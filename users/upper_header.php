<?php require_once ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();

$nm=$obj->get_username("admin","1");
?>

<!-- start upper header #33381e-->
<div class="container-fluid" style="background-color:#EDEDED; padding:8px;">
  <div class="container">
     <div class="row">
         <div class="col-md-4">
         <p class="topp_header_1"> Designed and Managed By </p><span class="topp_header_1">(<?= $nm?>)</span>
         </div>
         
         <div class="col-md-6">
         
         <div class="row">
         
         <p class="topp_header_2"> 023 1640 1515 </p>
         
         </div>
         </div>
         
         <div class="col-md-2">
         <div class="row">
         
           <button data-target="#login" data-toggle="modal" class="btn btn-primary btn-sm" data-backdrop="static"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Login</button>
         
         </div>
         </div>
     </div>
  </div>
</div>
<!-- end upper header -->