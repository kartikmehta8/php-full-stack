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
     <?php
        if($_SESSION['role']== 'admin')
            {
            //echo'<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>';
            }
        ?>
       <a href="./reports/all_items.php" target="_new" class="btn btn-success pull-left"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <div>
        <br>
        <h3 class="text-muted text-center"><b><u>DETAILS OF MEDICINES</u></b></h3></marquie>
       <table id="myTable" class="table table-hover table-bordered table-striped table-responsive">

<?php
            include_once('db.php');
            //sql according to role

            //percentage Calculator
           //$per= "select * from allocate where allocate_qty='$allocate_qty'";
          // $per1= "select * from allocate where allocate_qty_in_store='allocate_qty_in_store'";
           //$per_cri = ($per1/$per)*100;
           //$queryd = $conn->query($per_cri);
           //if ($per_cri <= 10)
           



            $item_current_dept_id = $_SESSION['dept_id'];
            
            $sqld = "SELECT * FROM department where dept_id = '$item_current_dept_id' ";
            $queryd = $conn->query($sqld);
            while($rowd = $queryd->fetch_assoc())
            {
            $dept_name=$rowd['dept_name'];
            }
            
            
            
            $sql = "SELECT * FROM item where dept_id = '$item_current_dept_id' ";
             if($_SESSION['role'] == 'admin')
            {
            echo 
            '<th align=center>Ser No</th>
            <th align=center>Medicine Name</th>
            <th align=center>Total Qty Issued</th>
            <th align=center>Date of Issue</th>
            <th align=center>Qty In Store</th>
            <th align=center>Date of Exp</th>';

            $temp=0;

             $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='87' ";
            
                  
            
        
            $query1 = $conn->query($q);
            
            echo  '<tr><td colspan=6 align=center>';
            echo "ECHS HISAR";
            echo  '</b></td></tr>';
            $i = 1;
            while ($row = $query1->fetch_assoc()) 
            {
            $temp++;
                echo "<tr>
                    <td>" . $i . "</td>
                     
                    
                    <td>" . $row['item_name'] . "</td>
                    <td>" . $row['allocate_qty'] . "</td>
                    <td>" . $row['allocated_date'] . "</td>
                    
                    <td>" . $row['allocate_qty_in_store'] . "</td>
                   <td>".$row['bill_no']."</td>
                   </tr>";
                $i++;
                }
                }
                


            $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='92' ";
                    
                $query1 = $conn->query($q);

                echo  '<tr><td colspan=6 align=center>';
                echo "ECHS JIND";
                echo  '</b></td></tr>';

            $i = 1;
                while ($row = $query1->fetch_assoc()) 
                {
            $temp++;
                echo "<tr>
                <td>" . $i . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['allocate_qty'] . "</td>
                <td>" . $row['allocated_date'] . "</td>
                <td>" . $row['allocate_qty_in_store'] . "</td>
                <td>".$row['bill_no']."</td>
                </tr>";
                $i++;

                }

                $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='93' ";
                    
                $query1 = $conn->query($q);

                echo  '<tr><td colspan=6 align=center>';
                echo "ECHS MEHAM";
                echo  '</b></td></tr>';

            $i = 1;
                while ($row = $query1->fetch_assoc()) 
                {
            $temp++;
                echo "<tr>
                <td>" . $i . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['allocate_qty'] . "</td>
                <td>" . $row['allocated_date'] . "</td>
                <td>" . $row['allocate_qty_in_store'] . "</td>
                <td>".$row['bill_no']."</td>
                </tr>";
                $i++;

                }

                $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='94' ";
                    
                $query1 = $conn->query($q);

                echo  '<tr><td colspan=6 align=center>';
                echo "ECHS BHIWANI";
                echo  '</b></td></tr>';

            $i = 1;
                while ($row = $query1->fetch_assoc()) 
                {
            $temp++;
                echo "<tr>
                <td>" . $i . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['allocate_qty'] . "</td>
                <td>" . $row['allocated_date'] . "</td>
                <td>" . $row['allocate_qty_in_store'] . "</td>
                <td>".$row['bill_no']."</td>
                </tr>";
                $i++;

                }


                $q = "SELECT * FROM allocate INNER JOIN item ON allocate.item_id=item.item_id where allocate.dept_id='95' ";
                    
                $query1 = $conn->query($q);

                echo  '<tr><td colspan=6 align=center>';
                echo "ECHS ROHTAK";
                echo  '</b></td></tr>';

            $i = 1;
                while ($row = $query1->fetch_assoc()) 
                {
            $temp++;
                echo "<tr>
                <td>" . $i . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['allocate_qty'] . "</td>
                <td>" . $row['allocated_date'] . "</td>
                <td>" . $row['allocate_qty_in_store'] . "</td>
                <td>".$row['bill_no']."</td>
                </tr>";
                $i++;

                }
                
        
               



                 include('models/dept_edit_delete_itemModel.php') ;
                 include('models/dept_allocate_itemModel.php') ;
             

         
         ?>
</table></div>


<?php require_once './includes/footer.php'; ?>
</div>
