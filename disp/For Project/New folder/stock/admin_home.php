<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    max-width: 1160px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-color: lightpink;
 }   
</style>


<div class="wrapper">

<?php
    require_once './includes/header.php';
    LogInCheck();
    require_once './includes/admin_nav.php';
    //var_dump($_SESSION);
    flash();
?>
<!--begin caurosol-->
<div style="background-image: url('back.jpg');height:700px;"> 
<div class="container">
    <div class="row">
        <?php if($_SESSION['role'] == 'admin'){?>
        <div class="col-md-4">
            <?php
            require_once 'db.php';
            $sql = "SELECT COUNT(`dept_id`) AS dept_available FROM `department` WHERE `dept_id` <> '1'";
            $result0 = $conn->query($sql);
            $row=$result0->fetch_assoc();
            $alert_dept = ($row>0)? "<div class=''><h3 CLASS='alert alert-success text-center'> Total Stores - ".$row['dept_available']."</h3></div>":"<div class=''><h3 CLASS='alert alert-danger'> NO DEPARTMENTS AVAILABLE </h3></div>";
            echo $alert_dept;
            ?>
        </div>
        <div class="col-md-4">
            <?php
            require_once 'db.php';
            $sql = "SELECT   COUNT(`supplier_id`) AS supplier_available FROM `supplier` WHERE 1";
            $result1 = $conn->query($sql);
            $row=$result1->fetch_assoc();
            $alert_supplier = ($row>0)? "<div class=''><h3 class='alert alert-success text-center'> Available Vendors - ".$row['supplier_available']."</h3></div>":"<div class=''><h3 CLASS='alert alert-danger text-center'> NO SUPPLIER AVAILABLE </h3></div>";
            echo $alert_supplier;
            ?>
        </div>
        <div class="col-md-4" >
            <?php
            require_once 'db.php';
            $sql = "SELECT COUNT(`item_id`) AS item_available FROM `item` WHERE `dept_id` = 1";
            $result0 = $conn->query($sql);
            $row=$result0->fetch_assoc();
            $alert_item = ($row>0)? "<div class=''><h3 CLASS='alert alert-success text-center'> Items In Stock - ".$row['item_available']."</h3></div>":"<div class=''><h3 CLASS='alert alert-danger'> NO ITEMS AVAILABLE </h3></div>";
            echo $alert_item;
            ?>
        </div>
        <div class="row" ><img alt="SMS" src="./assets/images/logo.png" style="width:200px; margin-top: 10px; margin-left: 10px;"> 
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div> 
        <div class="col-md-3">
        </div> 
        <div class="col-md-3">
        </div>
        </div>
        <?php       
    }
    
    else { ?>
    <div class="row">
     <div class="row" ><img alt="SMS" src="./assets/images/logo.png" style="width:200px; margin-top: 60px; margin-left: 20px;"> 
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div> 
        <div class="col-md-3">
        </div> 
        <div class="col-md-3">
        </div>
        </div>
    
    <?php
    
    }
    
    
    ?>
    
    
    
    </div>
</div>

    <!-- <div class="row">
        
           
        </div>
    </div> -->
</div>
<!---->
</div>

<?php
//code for taking backup
//$bak = backDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($bak==1){
        echo '<script>alert("back up taken");</script>';
    }
?>

<?php require_once './includes/footer.php'; ?>