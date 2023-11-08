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
        <li class="text-success" style="font-size: 20px;"><a href="./admin_home.php">Welcome </a></li>
    <li class="text-success" style="font-size: 20px;"><a href="logout.php">Logout</a></li></ul>
    </head>

     <?php
        if($_SESSION['role']== 'admin')
            {
            //echo'<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>';
           
           }
        ?>
       <a href="./reports/all_items.php" target="_new" class="btn btn-success pull-left"><span class="glyphicon glyphicon-print"></span> PDF</a>
    </div>

    <div style="height:670px;">
        
        <h3 class="text-muted text-center"><b><u>DETAILS OF MEDICINES UNIT WISE</u></b></h3>
       <table width=100% border=0 id="myTable" class="table table-hover table-bordered table-striped table-responsive">


            <tr><td colspan=6 align=left border=none><a href="view_list1_medi.php">
            Parecetamol
            </b></td></tr>
            <tr>
            <td colspan=6 align=left border=none>
            Vicks
            </b></td></tr>
            <tr>
            <td colspan=6 align=left border=none>
            Marliv DS
            </b></td>
            <tr><td colspan=6 align=left border=none><a href="">
            Dolo
            </b></td></tr>
            <tr>
            <td colspan=6 align=left border=none>
            ORS
            </b></td></tr>
            <tr>
            <td colspan=6 align=left border=none>
            Nasal Spray
            </b></td>


        </tr>
       
            
</div>
