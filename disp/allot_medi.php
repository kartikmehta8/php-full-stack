<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    max-width: 1160px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-color: ghostwhite;
 } 



 .left{

margin-right: 800px;
margin-left: -30px;
background-color: floralwhite;

 }  


 .right{

margin-right: -10px;
margin-left: 30px;
background-color: ghostwhite;
 }
</style>
    <!--exp1-->
    <div class="wrapper">


        


        <?php
require_once './includes/header.php';
//if not logged in return him to login page
LogInCheck();
//require_once './includes/admin_nav.php';
//var_dump($_SESSION);
?>
<!--exp1-->
<head>
        <ul>
    <img height="150px;" width="1024px" src="disp.png">
        </ul>
    
            <ul class="nav navbar-nav navbar-right">
                </li>
                <li class="text-success"><a href="./view_profile.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
                <li><a href="logout.php">Logout</a></li></ul>
               
</head>
                <br>
                <br>
                <br>

            <div class="left">
                <ul>
                <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Medicine Details
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="items.php">Medicine List</a></li>
                        <?php
                        if($_SESSION['role'] == 'admin'){
                            echo '<li><a href="allocate.php?type=allocate">Allocate</a></li>';
                            //echo '<li><a href="allocate.php?type=return">Return</a></li>';
                           }
                        ?>
                    </ul>
                </li>
                <br>
                <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Allotment of medicine
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="view_list.php">All</a></li>
                        
                    </ul>
                </li>
                <br>
            
        
                <?php
                //show oly if admin is logged in to the system
                if($_SESSION['role'] == 'admin')
                {
                   echo '<li class="dropdown" style="font-size: 30px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Units/Sub-Units
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="departments.php">Units/Sub-Units</a></li>
                        </ul>
                        </li>
                        <br>
                
                    <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pharma Coys<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./suppliers.php">Pharmaceutical coy list</a></li>
                    </ul>
                </li>
                ';
                }
                ?>
                <br>
                <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="view_profile.php">View Profile</a></li>
                        <li><a href="change_pass.php">Change Password</a></li>
                        <?php
                        //show only if admin is logged in to the system
                        // $manual = 'user_manual.docx';
                        if($_SESSION['role'] == 'admin')
                        {
                            //file name
                            $manual = 'how_to_install.txt';
                            echo'<li><a href="forgot_pass.php">Reset Department Password</a></li>';
                            echo'<li><a href="backup.php">Create Backup</a></li>';
                            echo'<li><a href="./actions/download.php?download_file='.$manual.'" download>Users Manual</a></li>';
                        }
                        ?>
                        </ul>
                        </li>
                        <br>
                        <br>
                        <br>
                        <br>
</div>
                       
                        
                        
                    
               



                    </ul>
                
            </ul>
        </div>
    </div>
</nav>
<hr>

<div class="right">

    <div class="col-sm-10 col-sm-offset-1">
    <div class="row">
    <!--place for error message flashing-->
        <?php
        //this will display any kind of error message as
        //flash();
        ?>
    </div>
    <div class="row">
        <?php
        if($_SESSION['role']== 'admin')
            {
            //echo'<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>';
            }
        ?>

       <a href="./reports/all_items.php" target="_new" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
    </div>
    </div>
    <div class="row">

    <h3 class="text-muted text-center">ALLOTMENT OF MEDICINES</h3>
        <table id="myTable" class="table table-hover table-bordered table-striped table-responsive">
            
            <?php
			include_once('db.php');
			//sql according to role
            $item_current_dept_id = $_SESSION['dept_id'];
            
            $sqld = "SELECT * FROM department where dept_id = '$item_current_dept_id' ";
            $queryd = $conn->query($sqld);
            while($rowd = $queryd->fetch_assoc())
            {
            $dept_name=$rowd['dept_name'];
            }
            
            
            
            $sql =  "select *
					from
    				item a
        			inner join
    				allocate b
        			on a.item_id = b.item_id
        			inner join
    				department c
    				on b.dept_id = c.dept_id
        			 ";
			 
            
            
            
			//$sql = ($_SESSION['role']=='admin') ? "SELECT * FROM item,department,supplier
            //                                       WHERE item.dept_id = department.dept_id
            //                                       AND item.supplier_id = supplier.supplier_id" :
            //                                       "SELECT * FROM item,department
            //                                       WHERE item.dept_id = department.dept_id
            //                                        AND item.dept_id = '".$item_current_dept_id."'";

            
            
            if($_SESSION['role'] == 'admin')
            {
			//echo for admin
            echo '<thead>
            <tr>
            <th>Ser No</th>
           
            <th>ITEM</th>
            <th>CATEGORY</th>
            <th>TOTAL QTY</th>
			<th>Cost</th>
            
            <th>IN STOCK</th>
            <th>PUR DATE</th>
            <th>EXP DATE</th>
            <th>VENDOR </th>
            <th>STATUS</th>

            
            </tr>
            </thead>
            <tbody>';

			$query = $conn->query($sql);
			$i = 1;
			while($row = $query->fetch_assoc())
            {
			echo"<tr>
                    <td>".$i."</td>
                    
					<td>".$row['item_name']."</td>
					<td>".$row['item_cat']."</td>
					<td>".$row['qty']."</td>
					<td>".$row['cost_per']."</td>
                    
                    <td>".$row['qty_issue']."</td>
					<td>".$row['supplied_at']."</td>
					<td>".$row['bill_no']."</td>
                    <td>".$row['supplier_id']."</td>
					<td><a href='#view_".$row['item_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> status</a>
                   
                    
					
					
				</tr>";
			    $i++;
			
				include('models/show_item_details.php') ;
			}
			?>
            </tbody>
       </table>
   
        <hr>
   
    <?php
        //add required models
        require_once 'models/show_item_details.php';
    ?>

    <?php
                //end of admin check
            }

    //begin for non admin view


        if($_SESSION['role'] == 'dept') {
            //echo for admin
            echo '<thead>
            <th>SL NO</th>
           <th>Medicine Name</th>
            <th>Qty Issued</th>
            <th>Issued To</th>
            <th>Date of issue</th>
          

          
            </thead>
            <tbody>';
			 
			 
			 
			 $q = "select *
					from
    				item a
        			inner join
    				allocate b
        			on a.item_id = b.item_id
        			inner join 
    				dept_issue c
        			on b.allocate_id= c.allocate_id where c.dept_id='$item_current_dept_id'";
			 
		
            $query1 = $conn->query($q);
            $i = 1;
            while ($row = $query1->fetch_assoc()) {
                echo "<tr>
                    <td>" . $i . "</td>					
					<td>" . $row['item_name'] . "</td>
					<td>" . $row['dept_qty_issue'] . "</td>
                    <td>" . $row['dept_issue_to'] . "</td>
                    <td>" . $row['dept_allocated_date'] . "</td>
                    

					</tr>";
                $i++;
                include('models/dept_edit_delete_itemModel.php');
                include('models/dept_allocate_itemModel.php');

            }
        }
            ?>
            </tbody>
            </table>
        </div>
    </div>

            <hr>
            



<?php require_once './includes/footer.php'; ?>

</div>
