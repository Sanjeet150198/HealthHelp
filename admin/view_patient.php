<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();

$result=$obj->fetch_data("patient",array("pat_id","pat_name","pat_no","pat_email","pat_addr","gen","age"));
?>
<style>
#result{ padding-top:70px; background-color:#fff;}
</style>

<!--Result-->
<div class="container-fluid">
    <div id="result" style="margin-left:5px;">
        <div class="row">
        <!--result coding-->
        <div class="col-md-11 table-responsive" style="border-radius:3%; box-shadow: 10px 10px 5px grey; #boxshadow {
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
                                    <th>Patient Id</th>
                                    <th>Name</th>
                                    <th>Contact no.</th>
                                    <th>Email Id</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->pat_id?></td>
                                    <td><?=$row->name?></td>
                                    <td><?=$row->phone?></td>
                                    <td><?=$row->email?></td>
                                    <td><?=$row->addr?></td>
                                    <td><?=$row->gender?></td>
                                    <td><?=$row->age?></td>
                                    <td></td>
                                    
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="10">Data not availble !!!</th>
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

