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
    <!--exp1-->
    <div class="wrapper">


        <?php
require_once './includes/header.php';
//if not logged in return him to login page
LogInCheck();
//require_once './includes/admin_nav.php';
//var_dump($_SESSION);
?>


    
    <head>
        <ul>
    <img height="150px;" width="1024px" src="echs.png">
        </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="text-success"><a href="./admin_home.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
    <li><a href="logout.php">Logout</a></li></ul>
    </head>
    <br>
    <br>
    

    <div class="col-sm-10 col-sm-offset-1">
    <div class="row">
        <!--place for error message flashing-->
        <?php
        //this will display any kind of error message as
       // flash();
		if($_GET["type"]=="allocate"){
        ?>
    </div>
     <div class="" style="height: 10px;">
    </div>
    <div class="row">
    <h3 class="text-muted text-center"><U>ISSUE MEDICINE TO UNIT/SUB-UNITS</U></h3>
    <table id="myTable" class="table table-bordered table-hover table-striped table-responsive">

   <?php
   
   include_once('db.php');
   //sql according to role

   $sql = "SELECT * FROM item WHERE `dept_id` = '1' and qty_issue > '0'" ;
    echo '<thead>
            <tr>
            <th>SER NO</th>
            <th>ITEM</th>
            <th>CATEGORY</th>
            <th>IN STOCK</th>
            <th>DETAIL</th>
            <th>SUPPLIED ON</th>
            <th>ACTION</th>
            </tr>
            </thead>
            <tbody>';

           $result = $conn->query($sql);
           $i = a;
           while($row = $result->fetch_assoc())
           {
           echo"<tr>
                    <td >".$i."</td>
                    
					<td>".$row['item_name']."</td>
					<td>".$row['item_cat']."</td>
					<td>".$row['qty_issue']."</td>
					<td>".$row['item_detail']."</td>
					<td>".$row['supplied_at']."</td>
					<td><a href='#allocate_".$row['item_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span>Allocate</a>
					</td>
				</tr>";
                $i++;
               //require_once 'models/allocate_itemModel.php';
               include('models/allocate_itemModel.php') ;
           }
        //$conn->close();
    ?>
    </tbody>
    </table>

    <hr>
    </div>
    </div>



<?php 
}
else{
       }
require_once './includes/footer.php'; 


?>
</div>
</div>