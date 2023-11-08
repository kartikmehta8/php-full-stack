<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    max-width: 1160px;
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
        <h3 class="text-muted text-center"><b><u>DETAILS OF ISSUE MEDICINE DAYWISE</u></b></h3></marquie>
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
             if($_SESSION['role'] == 'admin')
            {
            echo 
            '<th align=center>Ser No</th>
            <th align=center>Date of Issue</th>
            <th align=center>Qty Issued</th>
            ';

            $temp=0;

             $q = "SELECT * FROM allocate INNER JOIN dept_issue ON allocate.dept_id=dept_issue.dept_id where dept_issue.item_id='51' group by doi ";
            
                  
            
        
            $query1 = $conn->query($q);

            echo  '<tr><td colspan=3 align=center>';
            echo "Paracetamol";
            echo  '</b></td></tr>';
            $i = 1;
            while ($row = $query1->fetch_assoc()) 
            {
            $temp++;
                echo "<tr>
                    <td>" . $i . "</td>
                    <td>" . $row['doi'] . "</td>
                    <td>" . $row['dept_qty_issue'] . "</td>
                    </tr>";
                $i++;
                }
                }
                


                    ?>
</table></div>


<?php require_once './includes/footer.php'; ?>
</div>
