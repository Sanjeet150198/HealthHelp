<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>
<?php 
$err_email=$err_pwd="";
if($_SERVER['REQUEST_METHOD']=="POST"){
		$email=$obj->cleaner($_POST["email"]);
		$pwd=$obj->cleaner($_POST["pwd"]);
		
		
			
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$err_email="Enter correct User Id";
			}
			
		if(strlen($pwd)<6 || strlen($pwd)>15){
			$err_pwd="Passowrd should be of 6 to 15 characters";
			}	
			
		if(empty($err_email) && empty($err_pwd)){
				$result=$obj->login($email,$pwd,"doctor");
				if($result!==false){
					$obj->token_genrate($result);
					}
				}
		else{
				 ?>  <div class="alert alert-danger">
                   		<strong>Warning!</strong> Something Error.
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                   </div>
				  <?php 
			}	
				
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>

<body>
	<div class="container">
        <div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            <div class="well">
            <h3>Login Account</h3>
	            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                	<div class="form-group has-success">
                    	<input type="email" class="form-control" name="email" placeholder="Enter Username/Email_ID">
                        <span class="err" style="color:#FF0004; font-size:15px; font-weight:400;"><?= $err_email?></span>
                    </div>
                    <div class="form-group has-success">
                    	<input type="password" class="form-control" name="pwd" placeholder="Enter Password">
                        <span class="err" style="color:#FF0004; font-size:15px; font-weight:400;"><?= $err_pwd?></span>
                    </div>
                    <div class="form-group has-success">
                    	<input type="submit" value="Login" class="btn btn-primary">
                         <?php 
if($obj->admin_row_count()==0){?>
                        <button type="submit" class="btn btn-primary"><a href="registration.php" style="color:#fff; display:block;">Register</a></button><?php }
?>          
                    </div>
                </form>
                </div>
            </div>
        </div>    
    </div>
</body>
</html>
