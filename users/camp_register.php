<?php include_once("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>

<?php
$image_err=$name_err=$pwd_err=$cpwd_err=$no_err=$email_err=$gen_err=$grp_err=$addr_err=$state_err=$city_err=$code_err="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	
		$type=$_FILES["data"]['type'];
		$position=strpos($type,"/")+1;
		$tot_len=strlen($type);
		$rem_len=$tot_len-($position);
		$clean_type=substr($type,$position,$rem_len);
		
		$error=$_FILES["data"]['error'];
		$size=$_FILES["data"]['size'];
		$tmp=$_FILES["data"]['tmp_name'];
		
		$fl=$_FILES["data"]["name"];
		
		if($error>0){
		die("something error");
		}
	else{
		$path="../uploads/".$fl;
		if(file_exists($path)){
			$image_err="image already exists"; 
			}
			else{
				if($clean_type=="png" || $clean_type=="jpg" || $clean_type=="jpeg"){
					//if($size<(1024*500)){
		if(move_uploaded_file($tmp,$path)){
			echo "file uploaded scuccessfully";
			}
				//}
				/*else{
					$image_err="file size Should be below 100KB";
					return false;
					}*/
				}
				else
				{$image_err="file type error occurred";
				return false;}
			}
	}
	
	
		$name=$obj->cleaner($_POST["name"]);
		$email=$obj->cleaner($_POST["email"]);
		$pwd=$obj->cleaner($_POST["pwd"]);
		$cpwd=$obj->cleaner($_POST["cpwd"]);
		$phone=$obj->cleaner($_POST["no"]);
		$gender=$obj->cleaner($_POST["gen"]);
		$blood=$obj->cleaner($_POST["grp"]);
		$addr=$obj->cleaner($_POST["addr"]);
		$state=$obj->cleaner($_POST["state"]);
		$city=$obj->cleaner($_POST["city"]);
		$code=$obj->cleaner($_POST["code"]);
		
		$role="2";//donor=2;
		$status="1";//active=1;
		 
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$email_err="Enter correct Email Id";
			}
			
		if(strlen($pwd)<8 || strlen($pwd)>15){
			$pwd_err="Passowrd should be of 8 to 15 characters";
			}
			
		if($pwd!=$cpwd){
			$cpwd_err="password doesn't match"; }
		else{
			$pwd=sha1(Controller::SALT.$cpwd); }
			
		if(!preg_match("/^[a-z A-Z]+$/",$name)){
			$name_err= "*only alphabetic letters allowed";
			}
 
 
		if(!preg_match("/^[0-9]+$/",$phone))
		{
		$no_err= "Invalid phone number";
		}
		
		if(!preg_match("/^[a-z A-Z]+$/",$state)){
			$state_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[a-z A-Z]+$/",$city)){
			$city_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[0-9]+$/",$code) && strlen($code<6)){
			$code_err= "*only digits allowed max. 6 digits";
			}
			
		
		
		if(empty($name_err) && empty($image_err) && empty($email_err) && empty($pwd_err) && empty($cpwd_err) && empty($no_err) && empty($gender_err) && empty($grp_err) && empty($addr_err) && empty($state_err) && empty($city_err) && empty($code_err)){
			if($obj->user_existance("users",$email)){
				if($obj->bind_insert("users",array("",$fl,$name,$phone,$email,$pwd,$addr,$gender,$state,$city,$code,$blood,$role,$status))){
					$success="Successfully Registered";
				}
				}
			else{
				$email_err="User already exists";
				}	
			}
		
	}
?>
<style>
#camp{padding-top:50px; background-color:#fff;}

</style>
<!--menu header coding-->
<?php include ("new_donor_header.php");?>
<!--Donor Body coding-->
<div class="container">
	<div class="col-md-8" id="camp" style="border-radius:5%; margin-left:15%; box-shadow: 10px 10px 5px grey; #boxshadow {
    position: relative;
    box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
    padding: 10px;
    background: white;
}

#boxshadow img {
    width: 100%;
    border: 1px solid #8a4419;
    border-style: inset;
}

#boxshadow::after {
    content: '';
    position: absolute;
    z-index: -1; /* hide shadow behind image */
    box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3); 
    width: 70%; 
    left: 15%; /* one half of the remaining 30% */
    height: 100px;
    bottom: 0;
}">
	       
         <!-- form start -->
         <form method="post" role="form" id="register-form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><i class="fa fa-tint"></i> Camp Registration</h3>
                      
         <div class="pull-right">
             <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
         </div>
                      
         </div>
                  
         <div class="form-body">
         
         	  <div class="alert alert-info" id="message" style="display:none;">
              submitted
              </div>
              <!--Name-->      
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="name" type="text" class="form-control" required placeholder="Camp Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
              </div>
              <!--/Name-->
                           
              <!--Phone no.-->
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
                   <input name="no" type="tel" maxlength="10" required class="form-control" placeholder="phone no.">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $no_err?></span>                     
              </div>
              <!--/Phone no.-->
              
              <!--Address-->     
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
                   <input name="addr" type="text" class="form-control" required placeholder="Enter camp address">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $addr_err?></span>                     
              </div>
              <!--/Address-->
              
              <!--Date-->     
              <div class="form-group">
              <label for="start_date" style="color:#764F50; font-family:lobster; font-size:16px;">Starting Date:</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                   <input name="start_date" type="date" class="form-control" required placeholder="Enter date">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><!--<?= $date_err?>--></span>                     
              </div>
              <!--/Date-->
              
              <!--State-->
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                   <input name="state" type="text" class="form-control" required placeholder="Enter State">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $state_err?></span>                     
              </div>
              <!--/State-->
              
              <!--city & pin code-->
              <div class="row">
                        
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-signs"></i></div>
                        <input name="city" type="text" required class="form-control" placeholder="Enter city">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $city_err?></span>                    
                   </div>
                            
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input name="code" type="text" maxlength="6" class="form-control" required placeholder="Enter pin code">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $code_err?></span>                    
                   </div>
                            
             </div>
              <!--/city & pin code-->
                        
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-info">
                 <span class="glyphicon glyphicon-log-in"></span> Register !
                 </button>
                 <button type="button" class="btn btn-group-lg btn-primary"><a target="_self" href="index.php" style="color:#FFFFFF;"> Search camp </a></button>  
             
            </div>


            </form>
            
           
    </div>
</div>
<!--/Donor Body-->
<?php include ("new_donor_footer.php");?>
