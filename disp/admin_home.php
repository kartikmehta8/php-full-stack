<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    max-width: 1160px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-image: url(2.jpg);
    }   
</style>


<div class="wrapper">

<?php
    require_once './includes/header.php';
    LogInCheck();
    require_once './includes/admin_nav.php';
    //var_dump($_SESSION);
    //flash();
?>

    
    
    
    

    <!-- <div class="row">
        
           
        </div>
    </div> -->


<?php
//code for taking backup
//$bak = backDb(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    //if($bak==1){
       // echo '<script>alert("back up taken");</script>';
    //}
//?>

<?php require_once './includes/footer.php'; ?>
</div>