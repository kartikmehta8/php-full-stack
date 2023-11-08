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
        <h3 class="text-muted text-center"><b><u>DETAILS OF MEDICINES UNIT WISE</u></b></h3></marquie>

<?php
$sql_ts="select * from items where item_name";
$result_ts = $conn->query($sql_ts);
if($result_ts->num_rows > 0)
{
$i=a;
  
echo '<table width=96% align=right border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td align=center width=10%><b>';
echo 'S No';
echo '<b></td>'; 
echo '<td align=center width=70%><b>';
echo 'item name';
echo '</tr>';
  
$i=a;



while($row_ts = $result_ts->fetch_assoc())
{
 echo  '<tr><td align=center width=10%>';
 echo "(";
echo  $i;
echo ")";
echo  '</td>';
echo  '<td align=left width=70%>';
echo  $row_ts["item_name"];
echo  '</td>';

$i++;

}
echo  '</table>';
}
else
{
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td width=4% align=left>';
echo '1.';
echo '</td>';
echo '<td width=30% align=left><u><b>';
echo 'Tech Stand to Summary';

}

?>
<!---<table width=100% border=0 id="myTable" class="table table-hover table-bordered table-striped table-responsive">


            <tr><td colspan=6 align=left border=none><a href="items.php">
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
            

        </tr>--->
       
           
</div>
