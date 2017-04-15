<?php include_once ("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php
$city_err=$code_err=$type_err="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$ty=$obj->cleaner($_POST["type"]);

	$result=$obj->fetch_data_doctor("doctor",array("doc_name","doc_email","no","hos_addr","type"),$ty);
		
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
	<div class="col-md-7" id="search" style="border-radius:5%; margin-left:12%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
         	<h3 class="form-title"><i class="fa fa-stethoscope"></i> Search Doctor</h3>
                      
         <div class="pull-right">
             <h3 class="form-title"><span class="glyphicon glyphicon-search"></span></h3>
         </div>
                      
         </div>
                  
         <div class="form-body">
         
         	  <div class="alert alert-info" id="message" style="display:none;">
              submitted
              </div>
           <!--Required Blood Group-->           
         	  <div class="form-group">
              <label for="sym">Select Type:</label>
                    <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-tint"></i></div>
                   	   <select class="form-control" id="sym" name="sym">
                	<?php 
					$result=$obj->fetch_data("disease",array("sym_id","type"));
					if(isset($result)):
					foreach($result as $row){?>
                	<option><?=$row->type?></option>
                    <?php }endif;?>
                </select>
                    </div>
                   <span class="help-block" id="error" style="color:#FF0004;"></span>
              </div>
			<!--/Required Blood Group-->
                        
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
                        <table class="table table-striped" id="example">
                            <thead>
                                <tr class="active">
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Contact no.</th>
                                    <th>Email Id</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->doc_name?></td>
                                    <td><?=$row->no?></td>
                                    <td><?=$row->doc_email?></td>
                                    <td><?=$row->hos_addr?></td>
                                    <td><?=$row->type?></td>
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