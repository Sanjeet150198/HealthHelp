<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>

<?php
$name_err=$pwd_err=$cpwd_err=$no_err=$email_err="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST"){
		$name=$obj->cleaner($_POST["name"]);
		$email=$obj->cleaner($_POST["email"]);
		$pwd=$obj->cleaner($_POST["pwd"]);
		$cpwd=$obj->cleaner($_POST["cpwd"]);
		$phno=$obj->cleaner($_POST["no"]);
		 
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$email_err="Enter correct Email Id";
			}
			
		if(strlen($pwd)<6 || strlen($pwd)>15){
			$pwd_err="Passowrd should be of 6 to 15 characters";
			}
			
		if($pwd!=$cpwd){
			$cpwd_err="password doesn't match"; }
		else{
			$pwd=sha1(Controller::SALT.$cpwd); }
			
		if(!preg_match("/^[a-z A-Z]+$/",$name)){
			$name_err= "*only alphabetic letters allowed";
			}
 
 
		if(!preg_match("/^[0-9]+$/",$phno))
		{
		$no_err= "Invalid phone number";
		}
		
		if(empty($name_err) && empty($pwd_err) && empty($email_err) && empty($no_err)){
			if($obj->user_existance("admin",$email)){
				if($obj->bind_insert("admin",array("",$name,$email,$pwd,$phno))){
					$success="Successfully Registered";
					header("Location:index.php");
				}
				}
			else{
				$email_err="User already exists";
				}	
			}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Blood Bank Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/signup-form.css">

</head>

<body>

	<div class="container">

    <div class="signup-form-container">
    
         <!-- form start -->
         <form method="post" role="form" id="register-form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><i class="fa fa-user"></i> Sign Up</h3>
                      
         <div class="pull-right">
             <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
         </div>
                      
         </div>
                  
         <div class="form-body">
         
         	  <div class="alert alert-info" id="message" style="display:none;">
              submitted
              </div>
                      
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="name" type="text" class="form-control" required placeholder="Username">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
              </div>
                        
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                   <input name="email" type="email" class="form-control" required placeholder="Email">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $email_err?></span>                     
              </div>
              
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
                   <input name="no" type="tel" maxlength="10" required class="form-control" placeholder="phone no.">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $no_err?></span>                     
              </div>
                        
              <div class="row">
                        
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input name="pwd" id="pwd" type="password" required class="form-control" placeholder="Password">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $pwd_err?></span>                    
                   </div>
                            
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input name="cpwd" type="password" class="form-control" required placeholder="Retype Password">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $cpwd_err?></span>                    
                   </div>
                            
             </div>
                        
                        
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-info">
                 <span class="glyphicon glyphicon-log-in"></span> Sign Me Up !
                 </button>
            </div>


            </form>
            
           </div>

	</div>
    
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-1.12.3.min.js"></script>
   
</body>
</html>
