<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    max-width: 1160px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-color: floralwhite;
 }   
</style>
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
    <img height="150px;" width="1024px" src="echs.png">
        </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="text-success"><a href="./admin_home.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
    <li><a href="logout.php">Logout</a></li></ul>
    </head>
</div>
     
    <div class="col-sm-10 col-sm-offset-1">
    <div class="row">
    <!--place for error message flashing-->
        <?php
        //this will display any kind of error message as
        //flash();
        ?>
    </div>
    </div>
    <div class="row">
        <?php
        if($_SESSION['role']== 'admin')
            {
            echo'<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>';
            }
        ?>
        
    </div>
    <div class="" style="height: 10px;">
    </div>

    <div class="row">

    <marquie><h3 class="text-muted text-center">DETAILS OF MEDICINES</h3></marquie>
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
            
            
            
            $sql = "SELECT * FROM item where dept_id = '$item_current_dept_id' ";
            
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
            <th>SER NO</th>
           
            <th>MEDICINE NAME</th>
            <th>CAT OF MEDICINE</th>
            <th>QTY</th>
            <th>COST</th>
            <th>PUR DATE</th>
            <th>EXP DATE</th>
            <th>SUPLIER</th>
            <th>ACTION</th>
            
            </tr>
            </thead>
            <tbody>';

            $query = $conn->query($sql);
            $i = a;
            while($row = $query->fetch_assoc())
            {
            echo"<tr>
                    <td>".$i."</td>
                     
                    <td>".$row['item_name']."</td>
                    <td>".$row['item_cat']."</td>
                    <td>".$row['qty']."</td>
                    <td>".$row['cost_per']."</td>
                    <td>".$row['supplied_at']."</td>
                    <td>".$row['bill_no']."</td>
                    <td>".$row['supplier_id']."</td>
                    <td><a href='#edit_".$row['item_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                    
                    <a href='#delete_".$row['item_id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                    </td>
                    
                </tr>";
                $i++;
                include('models/edit_delete_itemModel.php') ;
            }
            ?>
            </tbody>
       </table>
</div>
        <hr>
    <?php
        //add required models
        require_once 'models/add_itemModel.php';
    ?>


    <?php
                //end of admin check
            }

    //begin for non admin view


        if($_SESSION['role'] == 'dept') {
            //echo for admin
            echo '<thead>
            <th>Ser No</th>
            
           
            <th>MEDICINE NAME</th>
            <th>Total Qty</th>
            <th>DATE OF ISSUE</th>
           
            <th>Qty In Store</th>
            <th>Date of Exp</th>
            <th>ACTION</th>
            </thead>
            <tbody>';
            
             
            $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='$item_current_dept_id' ";
            
                  
            
        
            $query1 = $conn->query($q);
            $i = 1;
            while ($row = $query1->fetch_assoc()) {
                echo "<tr>
                    <td>" . $i . "</td>
                     
                    
                    <td>" . $row['item_name'] . "</td>
                    <td>" . $row['allocate_qty'] . "</td>
                    <td>" . $row['allocated_date'] . "</td>
                    
                    <td>" . $row['allocate_qty_in_store'] . "</td>
                   <td>".$row['bill_no']."</td>

                    <td><a href='#edit_".$row['allocate_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                    <a href='#allocate_".$row['allocate_id']."' class='btn btn btn-primary btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span>Issue</a>
                    
                    </tr>";
                $i++;
                include('models/dept_edit_delete_itemModel.php') ;
                include('models/dept_allocate_itemModel.php') ;

            }
        }
            ?>

            
            </tbody>
            </table>
            <hr>
            
            




<?php require_once './includes/footer.php'; ?>
</div>
