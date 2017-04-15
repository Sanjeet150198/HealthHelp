<?php include_once ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>

<?php
$city_err=$code_err=$state_err="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$state=$obj->cleaner($_POST["state"]);
	$city=$obj->cleaner($_POST["city"]);
	$code=$obj->cleaner($_POST["code"]);
	
	if(!preg_match("/^[a-z A-Z]+$/",$state)){
			$state_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[a-z A-Z]+$/",$city)){
			$city_err= "*only alphabetic letters allowed";
			}
			
		if(!preg_match("/^[0-9]+$/",$code) && strlen($code<6)){
			$code_err= "*only digits allowed max. 6 digits";
			}
	if(empty($state_err) && empty($city_err) && empty($code_err)){
	$result=$obj->fetch_data_camp("camp",array("name","phone","addr","date","state","city","code"),$state,$city,$code);
	}
	else
	{echo "<script> alert('Form Should be filled correctly')</script>";
		}
	
}

?>


<?php include ("new_donor_header.php");?>

<style>
#result{ padding-top:50px; background-color:#fff;}
#search{ padding-top:50px; background-color:#fff;}
</style>
<!--Search-->	
<div class="container">
	<div class="row">
    <!--search coding-->
	<div class="col-md-7" id="search" style="border-radius:5%; height:100% !important; margin-left:12%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
	   <form method="post" role="form" id="search-form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><i class="fa fa-search"></i> Search Nearby Camp</h3>
                      
         <div class="pull-right">
             <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
         </div>
                      
         </div>
                  
         <div class="form-body">
         
         	  <div class="alert alert-info" id="message" style="display:none;">
              submitted
              </div>
                          
            <!--State-->           
         	  <div class="form-group">
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                  <input name="state" type="text" class="form-control" required placeholder="Enter State">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $state_err?></span>
              </div>
			<!--/State-->
                          
           <!--City & Pin code--> 
              <div class="row">
                        
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-signs"></i></div>
                        <input name="city" type="text" required class="form-control" placeholder="city">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $city_err?></span>                    
                   </div>
                            
                   <div class="form-group col-lg-6">
                        <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input name="code" type="text" class="form-control" required placeholder="Pin Code">
                        </div>  
                        <span class="help-block" id="error" style="color:#FF0004;"><?= $code_err?></span>                    
                   </div>
                            
             </div>
            <!--/City & Pin Code-->            
                        
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-primary">
                 <span class="glyphicon glyphicon-search"></span> Search
                 </button>
            </div>


            </form>
	</div>

	<!--/Search coding-->
            
    </div>
</div>
<!--/Search-->

<!--Result-->
<div class="container-fluid">
     <div id="result" style="margin-left:5px;">
        <div class="row">
        <!--result coding-->
        <div class="col-md-12 table-responsive" style="border-radius:3%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
            z-index: -1;  <!--hide shadow behind image -->
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3); 
            width: 70%; 
            left: 15%;  <!--one half of the remaining 30% -->
            height: 100px;
            bottom: 0;
        }">
         
            <!-- ... Your content goes here ... -->
                        <table class="table table-striped" border="+1" style="border:thin;" id="example">
                            <thead>
                                <tr class="active">
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Contact no.</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Pin Code</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->name?></td>
                                    <td><?=$row->phone?></td>
                                    <td><?=$row->addr?></td>
                                    <td><?=$row->date?></td>
                                    <td><?=$row->state?></td>
                                    <td><?=$row->city?></td>
                                    <td><?=$row->code?></td>
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="11">Data not availble !!!</th>
                                 </tr>
                                 <?php }?>   
                            </tbody>
                        </table>
            <!--/Content End--> 
        
        </div>
        <!--/result coding-->
        </div>
    </div>
</div>
<!--/Result-->
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );
} );
</script>

<?php include ("new_donor_footer.php");?>