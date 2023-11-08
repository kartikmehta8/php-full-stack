<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    width: 1160px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-color: antiquewhite;
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
<?php 
//error_reporting(E_ALL);
//ini_set( 'display_errors', 1 );
//ini_set('display_startup_errors', 1);
if ($_GET["dtpic"]=="")
{
$show_dt= date("d-m-Y");
}
else
{
$show_dt= $_GET["dtpic"];
}
$show_dt_up = date("M Y", strtotime($show_dt));
$show_dt_up_y = date("Y-m-d", strtotime('-1 days', strtotime($show_dt)));
$show_dt_up_dby=date('Y-m-d', strtotime('-2 days', strtotime($show_dt)));
$show_dt_exp=date('Y-m-d', strtotime('-30 days', strtotime($show_dt)));

?>
<?php
$sel_dt= $_GET["dtpic"];
$sel_dt_up = date("Y-m-d", strtotime($sel_dt));
$currentmonth = date("m" , strtotime($mydate));

?>



    <head>
        <ul>
    <img height="150px;" width="1024px" src="echs.png">
        </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="text-success" style="font-size: 20px;"><a href="./admin_home.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
    <li class="text-success" style="font-size: 20px;"><a href="logout.php">Logout</a></li></ul>
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
        <h3 class="text-muted text-center"><b><u>Issue of medicine month of &nbsp;<?php echo $show_dt_up; ?></u></b></h3></marquie>
       <table id="myTable" class="table table-hover table-bordered table-striped table-responsive">

<?php
            include_once('db.php');
            //sql according to role
            //$currentmonth = date('m');
            //$sql_month = "select * from dept_issue where doi='$currentmonth'";
            $month= " select * from dept_issue where month (doi)=month(now())" ; 
           


            $item_current_dept_id = $_SESSION['dept_id'];
            $sqld = "SELECT * FROM department where dept_id = '$item_current_dept_id' ";
            $queryd = $conn->query($sqld);
            $query2 = $conn->query($month);
            //$query2 = $conn->query($month);
            
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
            <th align=center>Qty Issued</th>
            <th align=center>Issued To</th>
            <th align=center>Date of issue</th>
            <th align=center>Bal qty</th>';

           

           $month="select * from dept_issue where month (doi)=month(current_date())";
          
            $q = "select *
                    from
                    item a
                    inner join
                    allocate b
                    on a.item_id = b.item_id 
                    inner join 
                    dept_issue c
                    on b.allocate_id= c.allocate_id where c.dept_id='87' group by doi desc";

            
           
                
            
        
            $query1 = $conn->query($q );
            
          
            
            
                      
            echo  '<tr bgcolor="#91DAF2"><td bgcolor="#91DAF2" colspan=6 align=center>';
            echo "ECHS HISAR";
            echo  '</b></td></tr>';
            $i = 1;
            while ($row = $query1->fetch_assoc() )
             
            
            {
            
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['dept_qty_issue'] . "</td>
            <td>" . $row['dept_issue_to'] . "</td>
            <td>" . $row['doi'] . "</td>
            <td>" . $row['allocate_qty_in_store'] . "</td>
            </tr>";
            $i++;
            }
            }
            

                


            $q = "select *
                    from
                    item a
                    inner join
                    allocate b
                    on a.item_id = b.item_id
                    inner join 
                    dept_issue c
                    on b.allocate_id= c.allocate_id where c.dept_id='92'";

                 
                    
                $query1 = $conn->query($q);


                echo  '<tr bgcolor="#91DAF2"><td  bgcolor="#91DAF2" colspan=6 align=center>';
                echo "ECHS JIND";
                echo  '</b></td></tr>';
                $i = 1;
                while ($row = $query1->fetch_assoc()) 
                {
                
                echo "<tr>
                <td>" . $i . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['dept_qty_issue'] . "</td>
                <td>" . $row['dept_issue_to'] . "</td>
                <td>" . $row['doi'] . "</td>
                <td>" . $row['allocate_qty_in_store'] . "</td>
                </tr>";
                $i++;
                }
                
                 $q = "select *
                    from
                    item a
                    inner join
                    allocate b
                    on a.item_id = b.item_id
                    inner join 
                    dept_issue c
                    on b.allocate_id= c.allocate_id where c.dept_id='93'";
                    
                $query1 = $conn->query($q);
                echo  '<tr bgcolor="#91DAF2"><td bgcolor="#91DAF2" colspan=6 align=center>';
                echo "ECHS MEHAM";
                echo  '</b></td></tr>';

            $i = 1;
            while ($row = $query1->fetch_assoc()) 
            {
            
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['dept_qty_issue'] . "</td>
            <td>" . $row['dept_issue_to'] . "</td>
            <td>" . $row['doi'] . "</td>
            <td>" . $row['allocate_qty_in_store'] . "</td>
            </tr>";
            $i++;
            }

            $q = "select *
                    from
                    item a
                    inner join
                    allocate b
                    on a.item_id = b.item_id
                    inner join 
                    dept_issue c
                    on b.allocate_id= c.allocate_id where c.dept_id='94'";
                    
            $query1 = $conn->query($q);
            echo '<tr bgcolor="#91DAF2"><td bgcolor="#91DAF2" colspan=6 align=center>';
            echo "ECHS BHIWANI";
            echo  '</b></td></tr>';
            $i = 1;
            while ($row = $query1->fetch_assoc()) 
            {
            
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['dept_qty_issue'] . "</td>
            <td>" . $row['dept_issue_to'] . "</td>
            <td>" . $row['doi'] . "</td>
            <td>" . $row['allocate_qty_in_store'] . "</td>
            </tr>";
            $i++;
            }


            $q = "select *
                    from
                    item a
                    inner join
                    allocate b
                    on a.item_id = b.item_id
                    inner join 
                    dept_issue c
                    on b.allocate_id= c.allocate_id where c.dept_id='95'";
                    
            $query1 = $conn->query($q);
            echo  '<tr bgcolor="#91DAF2"><td bgcolor="#91DAF2" colspan=6 align=center>';
            echo "ECHS ROHTAK";
            echo  '</b></td></tr>';
            $i = 1;
            while ($row = $query1->fetch_assoc()) 
            {
            
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['dept_qty_issue'] . "</td>
            <td>" . $row['dept_issue_to'] . "</td>
            <td>" . $row['doi'] . "</td>
            <td>" . $row['allocate_qty_in_store'] . "</td>
            </tr>";
            $i++;
            }
             
        
               



                 include('models/dept_edit_delete_itemModel.php') ;
                 include('models/dept_allocate_itemModel.php') ;
             

         
         ?>
</table></div>


<?php require_once './includes/footer.php'; ?>
</div>   
</div>