
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
<style type="text/css">
 .wrapper {
    margin-right: auto;
    margin-left: auto;
    width: 1160px;
    height: 700px;
    padding-top: 10px;
    padding-right: 20px;
    padding-left: 20px;
    padding-bottom: 10px;
    background-color: 91DAF2;
 }   


 .padding-left{

margin-right: auto;
margin-top: 20px;
margin-left: 20px;
width: 800px;
height: 400px;
background-color: 91DAF2;
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
$show_dt_up = date("d-m-Y", strtotime($show_dt));
$show_dt_up_y = date("Y-m-d", strtotime('-1 days', strtotime($show_dt)));
$show_dt_up_dby=date('Y-m-d', strtotime('-2 days', strtotime($show_dt)));
$show_dt_exp=date('Y-m-d', strtotime('-30 days', strtotime($show_dt)));

?>
<?php
$sel_dt= $_GET["dtpic"];
$sel_dt_up = date("Y-m-d", strtotime($sel_dt));
?>
<!--exp1-->
<head>
        <ul>
    <img height="150px;" width="1055px" src="echs.png">

        


           <div >
            <ul class="nav navbar-nav navbar-right">
                </li>
                <li class="text-success" style="font-size:20px; "><a href="./admin_home.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
                <li style="font-size:20px;"><a href="logout.php">Logout</a></li></ul>
               

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
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


        
        
           





         </ul>
        </div>
        <div>
            
    </div>
</nav>
<hr>

   
                            


    