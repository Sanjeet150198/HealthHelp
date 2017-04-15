<?php include_once ("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php
$name_err=$disease_err=$type_err=$med_err="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST"){
		$name=$obj->cleaner($_POST["symptomes"]);
		$dis=$obj->cleaner($_POST["disease"]);
		$type=$obj->cleaner($_POST["type"]);
		$medi=$obj->cleaner($_POST["medicine"]);
			
		if(!preg_match("/^[a-z A-Z]+$/",$name)){
			$name_err= "*only alphabetic letters allowed";
			}
			
		 if(!preg_match("/^[a-z A-Z]+$/",$dis)){
			$disease_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[a-z A-Z]+$/",$type)){
			$type_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[a-z A-Z]+$/",$medi)){
			$med_err= "*only alphabetic letters allowed";
			}
		
		if(empty($name_err) && empty($disease_err) && empty($type_err) && empty($med_err)){
				
				if($obj->disease_existance("disease",$dis)){
				if($obj->bind_insert("disease",array("",$name,$dis,$type,$medi))){
					$success="Successfully Added";
					header("Location:view_disease.php");
				}
				}
			else{
				$dis_err="Disease already exists";
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
	<div class="col-md-7" id="need" style="border-radius:5%; margin-left:10%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
         <form method="post" role="form" id="add-disease" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><i class="fa fa-plus"></i> Add Disease !</h3>
                      
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
                  <input name="symptomes" type="text" class="form-control" required placeholder="Symptomes">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
              </div>
              <!--/Patient Name-->
              
              <!--Gender & Blood group-->
              <div class="row">
                    <!--Gender-->   
                   <div class="form-group col-lg-6">
                         <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-male"></i></i></div>
                   	   <input name="disease" type="text" class="form-control" required placeholder="disease">
                    </div>
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $disease_err?></span>                    
                   </div>
                    <!--type-->        
                   <div class="form-group col-lg-6">
                          <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                   	   <input name="type" type="text" class="form-control" required placeholder="type">
                    </div>
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $type_err?></span>                    
                   </div>
                           
             </div>
              <!--/type-->
              
               <!--Medicine-->         
              <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-medkit"></i></div>
                   <input name="medicine" type="text" class="form-control" required placeholder="Enter Medicine">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $med_err?></span>                     
              </div>
              <!--/Medicine-->              
                        
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-info">
                 <span class="glyphicon glyphicon-plus"></span> Add Disease!
                 </button>
            </div>


            </form>
            
           
    </div>
</div>
<!--/Need Blood Body-->

<?php include ("new_donor_footer.php");?>