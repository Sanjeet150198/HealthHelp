<?php include_once ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>

<?php
$patname_err=$gen_err=$grp_err=$unit_err=$hosp_err=$hoscity_err=$hoscode_err=$docname_err=$date_err=$conname_err=$conemail_err=$conaddr_err=$conno_err=$reason_err="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST"){
		$patname=$obj->cleaner($_POST["patname"]);
		$docname=$obj->cleaner($_POST["docname"]);
		$conname=$obj->cleaner($_POST["conname"]);
		$email=$obj->cleaner($_POST["conemail"]);
		$phone=$obj->cleaner($_POST["conno"]);
		$gender=$obj->cleaner($_POST["gen"]);
		$blood=$obj->cleaner($_POST["grp"]);
		$unit=$obj->cleaner($_POST["unit"]);
		$hosp=$obj->cleaner($_POST["hosp"]);
		$city=$obj->cleaner($_POST["hoscity"]);
		$code=$obj->cleaner($_POST["hoscode"]);
		$date=$obj->cleaner($_POST["date"]);
		$addr=$obj->cleaner($_POST["addr"]);
		$reason=$obj->cleaner($_POST["reason"]);
		$status="1";
		 
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$conemail_err="Enter correct Email Id";
			}
			
		if(!preg_match("/^[a-z A-Z]+$/",$name)){
			$name_err= "*only alphabetic letters allowed";
			}
 
 
		if(!preg_match("/^[0-9]+$/",$phone))
		{
		$no_err= "Invalid phone number";
		}
		
		if(empty($name_err) && empty($pwd_err) && empty($email_err) && empty($no_err)){
			if($obj->user_existance("users",$email)){
				if($obj->bind_insert("users",array("",$name,$phone,$email,$pwd,$addr,$gender,$state,$city,$code,$blood,$status))){
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

<style>
#need{padding-top:50px; background-color:#fff;}
</style>
<?php include ("new_donor_header.php");?>

<!--Need Blood Body coding-->
<div class="container">
	<div class="col-md-8" id="need" style="border-radius:5%; margin-left:15%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
         	<h3 class="form-title"><i class="fa fa-tint"></i> Need Blood To Save Life !</h3>
                      
         <div class="pull-right">
             <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
         </div>
                      
         </div>
                  
         <div class="form-body">
         
         	  <div class="alert alert-info" id="message" style="display:none;">
              submitted
              </div>
                <!--Patient Name-->      
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="patname" type="text" class="form-control" required placeholder="Patient Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $patname_err?></span>
              </div>
              <!--/Patient Name-->
              
              <!--Gender & Blood group-->
              <div class="row">
                    <!--Gender-->   
                   <div class="form-group col-lg-6">
                         <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-male"></i> / <i class="fa fa-female"></i></div>
                   	   <select name="gen" class="form-control">
                         <option value="Male">Male</option>   
					     <option value="Female">Female</option>
                       </select>
                    </div>
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $gen_err?></span>                    
                   </div>
                    <!--Blood Group-->        
                   <div class="form-group col-lg-6">
                          <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-tint"></i></div>
                   	   <select name="grp" class="form-control">
                         <option value="A+">A+</option>   
					     <option value="A-">A-</option>
                         <option value="B+">B+</option>
                         <option value="B-">B-</option>
                         <option value="AB+">AB+</option>
                         <option value="AB-">AB-</option>
                         <option value="O+">O+</option>
                         <option value="O-">O-</option>
                       </select>
                    </div>
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $grp_err?></span>                    
                   </div>
                           
             </div>
              <!--/Gender & Blood group-->
              
              <!--No of Units-->
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-folder"></i></div>
                   <input name="unit" type="number" class="form-control" required placeholder="Need Unit Of Blood">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $unit_err?></span>                     
              </div>
              <!--/No of Units-->
              
               <!--Hospital Name And Address-->         
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-hospital-o"></i></div>
                   <input name="hosp" type="text" class="form-control" required placeholder="Hospital Name And Address">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $hosp_err?></span>                     
              </div>
              <!--/Hospital name and address-->
              
               <!--city & pin code-->
              <div class="row">
                        
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                        <input name="hoscity" id="city" type="text" required class="form-control" placeholder="Enter city">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $hoscity_err?></span>                    
                   </div>
                            
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                        <input name="hoscode" type="text" class="form-control" required placeholder="Enter your pin code">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $hoscode_err?></span>                    
                   </div>
                            
             </div>
              <!--/city & pin code-->
              
              <!--Doctor Name-->      
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="docname" type="text" class="form-control" required placeholder="Doctor Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $docname_err?></span>
              </div>
              <!--/Doctor Name-->
              
              <!--When Required-->     
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                  <input name="date" type="date" class="form-control" required placeholder="When Required">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $date_err?></span>
              </div>
              <!--/When Required-->
              
              <!--Contact Name-->      
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="conname" type="text" class="form-control" required placeholder="Contact Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $conname_err?></span>
              </div>
              <!--/Contact Name--> 
              
              <!--Contact Email Id-->
               <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                  <input name="conemail" type="email" class="form-control" required placeholder="Contact Email Id">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $conemail_err?></span>
              </div>
              <!--/Contact Email Id-->
              
              <!--Contact Address-->     
               <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
                   <input name="conaddr" type="text" class="form-control" required placeholder="Enter Contact address">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $conaddr_err?></span>                     
              </div>
              <!--/Contact Address-->
                                         
              <!--Contact Phone no.-->
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
                   <input name="conno" type="tel" maxlength="10" required class="form-control" placeholder="Contact phone no.">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $conno_err?></span>                     
              </div>
              <!--/contact phone no.-->
                 
              <!--Reason For Blood-->
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></div>
                   <input name="reason" type="text" class="form-control" required placeholder="Reason For Blood">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $reason_err?></span>                     
              </div>
              <!--/Reason For Blood-->              
                        
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-info">
                 <span class="glyphicon glyphicon-send"></span> Request Now !
                 </button>
            </div>


            </form>
            
           
    </div>
</div>
<!--/Need Blood Body-->

<?php include ("new_donor_footer.php");?>