<?php
require_once './includes/header.php';
//if not logged in return him to login page
LogInCheck();
require_once './includes/admin_nav.php';
//var_dump($_SESSION);
?>
<!--exp1-->

    <div class="col-sm-10 col-sm-offset-1">
    <div class="row">
    <!--place for error message flashing-->
        <?php
        //this will display any kind of error message as
        flash();
        ?>
    </div>
    <div class="row">
        <?php
        if($_SESSION['role']== 'admin')
            {
            echo'<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>';
            }
        ?>
        <a href="./reports/all_items.php" target="_new" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
    </div>
    <div class="" style="height: 10px;">
    </div>
    <div class="row">

    <marquie><h3 class="text-muted text-center">LEDGER</h3></marquie>
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
            <th>#</th>
            <th>QR</th>
            <th>ITEM</th>
            <th>CATEGORY</th>
            <th>QTY</th>
			<th>Cost/Unit</th>
            <th>QLP No</th>
            <th>VENDOR </th>
            <th>CIV No</th>
            <th>IN STOCK</th>
            <th>PUR DATE</th>
            <th>ACTION</th>
            <th>GENERATE</th>
            </tr>
            </thead>
            <tbody>';

			$query = $conn->query($sql);
			$i = 1;
			while($row = $query->fetch_assoc())
            {
			echo"<tr>
                    <td>".$i."</td>
                    <td><a href='lib/qr/userQr/".$row['item_name'].$row['allocate_id'].".png' download='".$row['item_name'].$row['allocate_id'].".png' ><img width='100' height='100' src= 'lib/qr/userQr/".$row['item_name'].$row['allocate_id'].".png' /></a></td>
					<td>".$row['item_name']."</td>
					<td>".$row['item_cat']."</td>
					<td>".$row['qty']."</td>
					<td>".$row['cost_per']."</td>
					<td>".$row['item_detail']."</td>
					<td>".$row['supplier_id']."</td>
					<td>".$row['bill_no']."</td>
					<td>".$row['qty_issue']."</td>
					<td>".$row['supplied_at']."</td>
					<td>".$row['dept_name']."</td>
					
					<td>
					<a href='#qrcode_".$row['allocate_id']."' class='btn btn btn-primary btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> QR Code</a>
					<a href='#return_".$row['allocate_id']."' class='btn btn btn-warning btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Return</a>
					
					</td>
				</tr>";
			    $i++;
			
				include('models/allocate_qr.php') ;
			}
			?>
            </tbody>
       </table>
        <hr>
    <?php
        //add required models
        require_once 'models/add_itemModel.php';
    ?>
</div>
</div>
    <?php
                //end of admin check
            }

    //begin for non admin view


        if($_SESSION['role'] == 'dept') {
            //echo for admin
            echo '<thead>
            <th>SL NO</th>
            <th>QLP No</th>
            <th>LP No</th>
            <th>ITEM</th>
            <th>Qty</th>
			 <th>Cost/Unit</th>
            <th>ISSUE TO</th>
            <th>DATE</th>
          
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
        			on b.allocate_id= c.allocate_id where c.dept_id='$item_current_dept_id' ";
			 
		
            $query1 = $conn->query($q);
            $i = 1;
            while ($row = $query1->fetch_assoc()) {
                echo "<tr>
                    <td>" . $i . "</td>
					<td>" . $row['item_detail'] . "</td>
					<td>" . $row['lp_no'] . "</td>
					<td>" . $row['item_name'] . "</td>
					<td>" . $row['dept_qty_issue'] . "</td>
					<td>" . $row['cost_per'] . "</td>
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
            <hr>
            </div>
            </div>



<?php require_once './includes/footer.php'; ?>