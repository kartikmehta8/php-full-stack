<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-COMN STATE</title>
</head>
<?php 
header('Content-Type: text/html; charset=ISO-8859-1');
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
$show_dt_up_y = date("d-m-Y", strtotime('-1 days', strtotime($show_dt)));
$show_dt_up_dby=date('d-m-Y', strtotime('-2 days', strtotime($show_dt)));
?>
<body bgcolor="#91DAF2">
<!----<h1 align="center"><img src="images/comnstate.png" align="middle" height=152 width="1012"/></h1>----->
<h1 align="center"><b><u>COMN STATE AS ON &nbsp;<?php echo $show_dt_up; ?></u></b></h1>


<?php
$sel_dt= $_GET["dtpic"];
$sel_dt_up = date("Y-m-d", strtotime($sel_dt));

$servername= "localhost";
$username= "root";
$password= "pibtc@1234";
$dbname= "comnstate";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}

//echo "connected successfully";
/*$sql_app = "select doe, status from approval where doe = '".$sel_dt_up."'";
$result_app = $conn->query($sql_app);
if($result_app->num_rows > 0)
{
while($row_app = $result_app->fetch_assoc())
{
$doe=$row_app["doe"];
$status=$row_app["status"];
}
}
if ($doe=="" || $status=="")
{
echo "<script>alert('e-Comn State is not yet prepared please wait.')</script>";
}
else
{*/
//----------------------------------------Cct OFC State--------------------------
//--------------------------Total----------------------------------------
$g_tot_hm=0; 
			  $sql_ofc_dash = "select count(cct_id) as total from ofc_ccts where doe = '".$sel_dt_up."' group by doe";
$result_ofc_dash = $conn->query($sql_ofc_dash);
			  if($result_ofc_dash->num_rows > 0)
{
while($row_ofc_dash = $result_ofc_dash->fetch_assoc())
{
	$g_tot_hm= $row_ofc_dash["total"];
		
}
} 

$g_tot_nfs=0; 
			  $sql_nfs_dash = "select count(cct_id) as total from ofc_ccts where doe = '".$sel_dt_up."' and current_status='NOT OK' group by doe";
$result_nfs_dash = $conn->query($sql_nfs_dash);
			  if($result_nfs_dash->num_rows > 0)
{
while($row_nfs_dash = $result_nfs_dash->fetch_assoc())
{
	$g_tot_nfs= $row_nfs_dash["total"];
		
}
} 

$g_tot_stdby=0; 
			  $sql_stdby_dash = "select count(cct_id) as total from ofc_ccts where doe = '".$sel_dt_up."' and current_status='OK' group by doe";
$result_stdby_dash = $conn->query($sql_stdby_dash);
			  if($result_stdby_dash->num_rows > 0)
{
while($row_stdby_dash = $result_stdby_dash->fetch_assoc())
{
	$g_tot_stdby= $row_stdby_dash["total"];
		
}
} 

$sql_sout_dash = "select * from ofc_ccts where doe = '".$sel_dt_up."' and current_status='NOT OK'";
$result_sout_dash = $conn->query($sql_sout_dash);
			  if($result_sout_dash->num_rows > 0)
{
$c=0;
$md=0;
$id=0;
$mdsr=0;

while($row_sout_dash = $result_sout_dash->fetch_assoc())
{
		
	if($row_sout_dash["fmn"] == "HQ 3 Corps")
	{
	$c++;
	}
	elseif($row_sout_dash["fmn"] == "HQ 2 Mtn Div")
	{
	$md++;
	}	
	elseif($row_sout_dash["fmn"] == "HQ 56 Inf Div")
	{
	$id++;	
	}
	elseif($row_sout_dash["fmn"] == "HQ 57 Mtn Div")
	{
	$mdsr++;
	}
	else
	{
	echo "";
	}	
}
} 

//--------------------------Total----------------------------------------

echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=12 align=center width=100% valign=bottom><b>';
 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUMMARY : OOO CCTS IN LAST 24 HRS';
 echo '<b></td>'; 
 echo '<td colspan=12 align=right width=10%><b>';
 echo '<table border=0>';
  echo '<tr>';
  echo '<td align=left><b>';
 echo 'TOTAL';
 echo '<b></td>';
 echo '<td align=left><b>';
 echo ':&nbsp;'; 
 echo $g_tot_hm;
  echo '<b></td>';
  echo '</tr>';
 //echo '</br>';
 echo '<tr>';
  echo '<td align=left><b>'; 
 echo 'RESTORED';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $g_tot_stdby;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
// echo '</br>';
echo '<td colspan=2 align=left><b><u>'; 
 echo 'OUT';
 echo '</u></b></td>';
 /*echo '<td align=left><b>'; 
 echo ':&nbsp;';
 echo $g_tot_nfs;
 echo '<b></td>';*/
 
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '3 CESR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $c;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '2 MDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $md;
  echo '<b></td>';
  echo '</tr>';
  
  echo '<b></td>';   
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '56 IDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $id;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '57 MDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $mdsr;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo 'STILL OUT';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $g_tot_nfs;
  echo '<b></td>';
  echo '</tr>';
  echo '</table>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Ser No";
echo  '</b></td>';
echo  '<td align=center rowspan=2  width=5%><b>';
echo  "Cct ID";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=20%><b>';
echo  "Station";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=5%><b>';
echo  "Media";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=7%><b>';
echo  "Cct Utilization";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=12%><b>';
echo  "OOO Details";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=15%><b>';
echo  "Reason";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=15%><b>';
echo  "Alternate Comn";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=4%><b>';
echo  "Current Status";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Last 3 OOO";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Total Out Hrs within 3 Months";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=10%><b>';
echo  "From";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  "To";
echo  '</b></td>';
echo  '<td align=center width=3%><b>';
echo  "Speech";
echo  '</b></td>';
echo  '<td align=center width=4%><b>';
echo  "&nbsp;&nbsp;&nbsp;Data&nbsp;&nbsp;&nbsp;";
echo  '</b></td>';
echo  '</b></tr>';
echo '<tr>';
echo '<td colspan=13 align=left bgcolor=white><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq3_ofc_cct = "select cct_id, stn_fm, stn_to, media, speech, data, break_details, reason, alter_comn, current_status, fmn, doe from ofc_ccts where doe = '".$sel_dt_up."' and fmn='HQ 3 CORPS'";
$result_hq3_ofc_cct = $conn->query($sql_hq3_ofc_cct);

if($result_hq3_ofc_cct->num_rows > 0)
{
$i=1;
while($row_hq3_ofc_cct = $result_hq3_ofc_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_ofc_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_ofc_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_ofc_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_ofc_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_ofc_cct["speech"];
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq3_ofc_cct["data"];
echo  '</td>';
echo  '<td align=left width=12%>';
echo  $row_hq3_ofc_cct["break_details"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq3_ofc_cct["reason"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq3_ofc_cct["alter_comn"];
echo  '</td>';
if($row_hq3_ofc_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=4%>';
echo  $row_hq3_ofc_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=4%>';
echo  $row_hq3_ofc_cct["current_status"];
echo  '</td>';
}

$sql_hq3_ofc_cct_l3 = "select break_details as l3 from ofc_ccts where cct_id = '".$row_hq3_ofc_cct["cct_id"]."' and fmn='HQ 3 CORPS' and doe < '".$sel_dt_up."' order by id desc limit 3";
$result_hq3_ofc_cct_l3 = $conn->query($sql_hq3_ofc_cct_l3);
$ct_dt=date('Y-m-d', strtotime('-90 days', strtotime($sel_dt_up)));
if($result_hq3_ofc_cct_l3->num_rows > 0)
{
echo  '<td align=left width=5%>';
while($row_hq3_ofc_cct_l3 = $result_hq3_ofc_cct_l3->fetch_assoc())
{

echo '<b>';
echo "*&nbsp;";
echo '</b>';
echo  $row_hq3_ofc_cct_l3["l3"];
echo "</br>";
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}

$sql_hrs = "select CONCAT( FLOOR( HOUR( SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm)))))/24), ' Days ', HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))) MOD 24, ' Hrs ', MINUTE(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))), ' Mins ') as tym from ofc_ccts where cct_id = '".$row_hq3_ofc_cct["cct_id"]."' and fmn='HQ 3 CORPS' and doe >= '".$ct_dt."'" ;
$result_hrs = $conn->query($sql_hrs);

if($result_hrs->num_rows > 0)
{
echo  '<td align=center width=10%>';
while($row_hrs = $result_hrs->fetch_assoc())
{
if($row_hrs["tym"]=="")
{
echo "-";
}
else
{
echo  $row_hrs["tym"];
}
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 2 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=13 align=left bgcolor=white><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq2_ofc_cct = "select cct_id, stn_fm, stn_to, media, speech, data, break_details, reason, alter_comn, current_status, fmn, doe from ofc_ccts where doe = '".$sel_dt_up."' and fmn='HQ 2 MTN DIV'";
$result_hq2_ofc_cct = $conn->query($sql_hq2_ofc_cct);

if($result_hq2_ofc_cct->num_rows > 0)
{
$i=1;
while($row_hq2_ofc_cct = $result_hq2_ofc_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_ofc_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_ofc_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_ofc_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_ofc_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_ofc_cct["speech"];
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq2_ofc_cct["data"];
echo  '</td>';
echo  '<td align=left width=12%>';
echo  $row_hq2_ofc_cct["break_details"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq2_ofc_cct["reason"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq2_ofc_cct["alter_comn"];
echo  '</td>';
if($row_hq2_ofc_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=4%>';
echo  $row_hq2_ofc_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=4%>';
echo  $row_hq2_ofc_cct["current_status"];
echo  '</td>';
}

$sql_hq2_ofc_cct_l3 = "select break_details as l3 from ofc_ccts where cct_id = '".$row_hq2_ofc_cct["cct_id"]."' and fmn='HQ 2 MTN DIV' and doe < '".$sel_dt_up."' order by id desc limit 3";
$result_hq2_ofc_cct_l3 = $conn->query($sql_hq2_ofc_cct_l3);

if($result_hq2_ofc_cct_l3->num_rows > 0)
{echo  '<td align=left width=5%>';
while($row_hq2_ofc_cct_l3 = $result_hq2_ofc_cct_l3->fetch_assoc())
{

echo '<b>';
echo "*&nbsp;";
echo '</b>';
echo  $row_hq2_ofc_cct_l3["l3"];
echo "</br>";
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
$sql_hrs = "select CONCAT( FLOOR( HOUR( SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm)))))/24), ' Days ', HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))) MOD 24, ' Hrs ', MINUTE(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))), ' Mins ') as tym from ofc_ccts where cct_id = '".$row_hq3_ofc_cct["cct_id"]."' and fmn='HQ 2 MTN DIV' and doe >= '".$ct_dt."'";
$result_hrs = $conn->query($sql_hrs);

if($result_hrs->num_rows > 0)
{
echo  '<td align=center width=10%>';
while($row_hrs = $result_hrs->fetch_assoc())
{
if($row_hrs["tym"]=="")
{
echo "-";
}
else
{
echo  $row_hrs["tym"];
}
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';

//------------------------------------------HQ 56 Inf Div-----------------------
echo '<tr>';
echo '<td colspan=13 align=left bgcolor=white><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_ofc_cct = "select cct_id, stn_fm, stn_to, media, speech, data, break_details, reason, alter_comn, current_status, fmn, doe from ofc_ccts where doe = '".$sel_dt_up."' and fmn='HQ 56 INF DIV'";
$result_hq56_ofc_cct = $conn->query($sql_hq56_ofc_cct);

if($result_hq56_ofc_cct->num_rows > 0)
{
$i=1;
while($row_hq56_ofc_cct = $result_hq56_ofc_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_ofc_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_ofc_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_ofc_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_ofc_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_ofc_cct["speech"];
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq56_ofc_cct["data"];
echo  '</td>';
echo  '<td align=left width=12%>';
echo  $row_hq56_ofc_cct["break_details"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq56_ofc_cct["reason"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq56_ofc_cct["alter_comn"];
echo  '</td>';
if($row_hq56_ofc_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=4%>';
echo  $row_hq56_ofc_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=4%>';
echo  $row_hq56_ofc_cct["current_status"];
echo  '</td>';
}

$sql_hq56_ofc_cct_l3 = "select distinct(break_details) as l3 from ofc_ccts where cct_id = '".$row_hq56_ofc_cct["cct_id"]."' and fmn='HQ 56 INF DIV' and doe < '".$sel_dt_up."' order by id desc limit 3";
$result_hq56_ofc_cct_l3 = $conn->query($sql_hq56_ofc_cct_l3);

if($result_hq56_ofc_cct_l3->num_rows > 0)
{
echo  '<td align=left width=5%>';
while($row_hq56_ofc_cct_l3 = $result_hq56_ofc_cct_l3->fetch_assoc())
{

echo '<b>';
echo "*&nbsp;";
echo '</b>';
echo  $row_hq56_ofc_cct_l3["l3"];
echo "</br>";
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
$sql_hrs = "select CONCAT( FLOOR( HOUR( SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm)))))/24), ' Days ', HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))) MOD 24, ' Hrs ', MINUTE(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))), ' Mins ') as tym from ofc_ccts where cct_id = '".$row_hq56_ofc_cct["cct_id"]."' and fmn='HQ 56 INF DIV' and doe >= '".$ct_dt."'";
$result_hrs = $conn->query($sql_hrs);

if($result_hrs->num_rows > 0)
{
echo  '<td align=center width=10%>';
while($row_hrs = $result_hrs->fetch_assoc())
{
if($row_hrs["tym"]=="")
{
echo "-";
}
else
{
echo  $row_hrs["tym"];
}
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left ><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 57 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=13 align=left bgcolor=white><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq57_ofc_cct = "select cct_id, stn_fm, stn_to, media, speech, data, break_details, reason, alter_comn, current_status, fmn, doe from ofc_ccts where doe = '".$sel_dt_up."' and fmn='HQ 57 MTN DIV'";
$result_hq57_ofc_cct = $conn->query($sql_hq57_ofc_cct);

if($result_hq57_ofc_cct->num_rows > 0)
{
$i=1;
while($row_hq57_ofc_cct = $result_hq57_ofc_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq57_ofc_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_ofc_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_ofc_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq57_ofc_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57_ofc_cct["speech"];
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq57_ofc_cct["data"];
echo  '</td>';
echo  '<td align=left width=12%>';
echo  $row_hq57_ofc_cct["break_details"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq57_ofc_cct["reason"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_hq57_ofc_cct["alter_comn"];
echo  '</td>';
if($row_hq57_ofc_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=4%>';
echo  $row_hq57_ofc_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=4%>';
echo  $row_hq57_ofc_cct["current_status"];
echo  '</td>';
}

$sql_hq57_ofc_cct_l3 = "select break_details as l3 from ofc_ccts where cct_id = '".$row_hq57_ofc_cct["cct_id"]."' and fmn='HQ 57 MTN DIV' and doe < '".$sel_dt_up."' order by id desc limit 3";
$result_hq57_ofc_cct_l3 = $conn->query($sql_hq57_ofc_cct_l3);

if($result_hq57_ofc_cct_l3->num_rows > 0)
{echo  '<td align=left width=5%>';
while($row_hq57_ofc_cct_l3 = $result_hq57_ofc_cct_l3->fetch_assoc())
{

echo '<b>';
echo "*&nbsp;";
echo '</b>';
echo  $row_hq57_ofc_cct_l3["l3"];
echo "</br>";
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
$sql_hrs_hq57 = "select CONCAT( FLOOR( HOUR( SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm)))))/24), ' Days ', HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))) MOD 24, ' Hrs ', MINUTE(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_to, break_fm))))), ' Mins ') as tym from ofc_ccts where cct_id = '".$row_hq57_ofc_cct["cct_id"]."' and fmn='HQ 57 MTN DIV' and doe >= '".$ct_dt."'";
$result_hrs_hq57 = $conn->query($sql_hrs_hq57);

if($result_hrs_hq57->num_rows > 0)
{
echo  '<td align=center width=10%>';
while($row_hrs_hq57 = $result_hrs_hq57->fetch_assoc())
{
if($row_hrs_hq57["tym"]=="")
{
echo "-";
}
else
{
echo  $row_hrs_hq57["tym"];
}
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
echo  '</tr>';
$i++;
}
echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</tr>';
}
echo  '</table>';
echo '<p></p>';



//------------------------------------------Others-----------------------
/*echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'Others';
 echo '<b></td>';   
  echo '</tr>';
$sql_other_ofc_cct = "select cct_id, stn_fm, stn_to, media, speech, data, break_details, reason, alter_comn, current_status, fmn, doe from ofc_ccts where doe = '".$sel_dt_up."' and (fmn!='HQ 57 MTN DIV' or fmn!='HQ 56 INF DIV' or fmn!='HQ 2 MTN DIV')";
$result_other_ofc_cct = $conn->query($sql_other_ofc_cct);

if($result_other_ofc_cct->num_rows > 0)
{
$i=1;
while($row_other_ofc_cct = $result_other_ofc_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_other_ofc_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_other_ofc_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_other_ofc_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_other_ofc_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_other_ofc_cct["speech"];
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_other_ofc_cct["data"];
echo  '</td>';
echo  '<td align=left width=12%>';
echo  $row_other_ofc_cct["break_details"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_other_ofc_cct["reason"];
echo  '</td>';
echo  '<td align=left width=15%>';
echo  $row_other_ofc_cct["alter_comn"];
echo  '</td>';
if($row_other_ofc_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=5%>';
echo  $row_other_ofc_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=5%>';
echo  $row_other_ofc_cct["current_status"];
echo  '</td>';
}

$sql_other_ofc_cct_l3 = "select break_details as l3 from ofc_ccts where cct_id = '".$row_other_ofc_cct["cct_id"]."' and fmn='HQ 57 MTN DIV' and doe > '".$sel_dt_up."' order by id desc limit 3";
$result_other_ofc_cct_l3 = $conn->query($sql_other_ofc_cct_l3);

if($result_other_ofc_cct_l3->num_rows > 0)
{echo  '<td align=left width=5%>';
while($row_other_ofc_cct_l3 = $result_other_ofc_cct_l3->fetch_assoc())
{

echo '<b>';
echo "*&nbsp;";
echo '</b>';
echo  $row_other_ofc_cct_l3["l3"];
echo "</br>";
}
echo  '</td>';
}
else
{
echo  '<td align=left width=5%>';
echo  "Nil";
echo  '</td>';
}
echo  '</tr>';
$i++;
}
echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}*/

echo '<p></p>';
//----------------------------------------Cct OFC State--------------------------
echo "<p style='page-break-after:always'></p>";
//----------------------------------------Cct NFS State--------------------------
//--------------------------Total----------------------------------------
$g_tot_hm_ns=0; 
			  $sql_ofc_dash = "select count(cct_id) as total from nfs where doe = '".$sel_dt_up."' group by doe";
$result_ofc_dash = $conn->query($sql_ofc_dash);
			  if($result_ofc_dash->num_rows > 0)
{
while($row_ofc_dash = $result_ofc_dash->fetch_assoc())
{
	$g_tot_hm_ns= $row_ofc_dash["total"];
		
}
} 

$g_tot_nfs_ns=0; 
			  $sql_nfs_dash = "select count(cct_id) as total from nfs where doe = '".$sel_dt_up."' and current_status='NOT OK' group by doe";
$result_nfs_dash = $conn->query($sql_nfs_dash);
			  if($result_nfs_dash->num_rows > 0)
{
while($row_nfs_dash = $result_nfs_dash->fetch_assoc())
{
	$g_tot_nfs_ns= $row_nfs_dash["total"];
		
}
} 

$g_tot_stdby_ns=0; 
			  $sql_stdby_dash = "select count(cct_id) as total from nfs where doe = '".$sel_dt_up."' and current_status='RESTORED' group by doe";
$result_stdby_dash = $conn->query($sql_stdby_dash);
			  if($result_stdby_dash->num_rows > 0)
{
while($row_stdby_dash = $result_stdby_dash->fetch_assoc())
{
	$g_tot_stdby_ns= $row_stdby_dash["total"];
		
}
} 

$sql_nsout_dash = "select * from nfs where doe = '".$sel_dt_up."' and current_status='NOT OK'";
$result_nsout_dash = $conn->query($sql_nsout_dash);
			  if($result_nsout_dash->num_rows > 0)
{
$c_ns=0;
$md_ns=0;
$id_ns=0;
$mdsr_ns=0;

while($row_nsout_dash = $result_nsout_dash->fetch_assoc())
{
		
	if($row_nsout_dash["fmn"] == "HQ 3 CORPS")
	{
	$c_ns++;
	}
	elseif($row_nsout_dash["fmn"] == "HQ 2 MTN DIV")
	{
	$md_ns++;
	}	
	elseif($row_nsout_dash["fmn"] == "HQ 56 INF DIV")
	{
	$id_ns++;	
	}
	elseif($row_nsout_dash["fmn"] == "HQ 57 MTN DIV")
	{
	$mdsr_ns++;
	}
	else
	{
	echo "";
	}	
}
} 

//--------------------------Total----------------------------------------
  
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=12 align=center width=100% valign=bottom><b>';
 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUMMARY : OOO NFS CCTS IN LAST 24 HRS';
 echo '<b></td>'; 
 echo '<td colspan=12 align=right width=10%><b>';
 echo '<table border=0>';
  echo '<tr>';
  echo '<td align=left><b>';
 echo 'TOTAL';
 echo '<b></td>';
 echo '<td align=left><b>';
 echo ':&nbsp;'; 
 echo $g_tot_hm_ns;
  echo '<b></td>';
  echo '</tr>';
 //echo '</br>';
 echo '<tr>';
  echo '<td align=left><b>'; 
 echo 'RESTORED';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $g_tot_stdby_ns;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
// echo '</br>';
echo '<td colspan=2 align=left><b><u>'; 
 echo 'OUT';
 echo '</u></b></td>';
 /*echo '<td align=left><b>'; 
 echo ':&nbsp;';
 echo $g_tot_nfs;
 echo '<b></td>';*/
 
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '3 CESR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $c_ns;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '2 MDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $md_ns;
  echo '<b></td>';
  echo '</tr>';
  
  echo '<b></td>';   
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '56 IDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $id_ns;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo '57 MDSR';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $mdsr_ns;
  echo '<b></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align=left><b>'; 
 echo 'STILL OUT';
  echo '<b></td>';
  echo '<td align=left><b>'; 
  echo ':&nbsp;';
 echo $g_tot_nfs_ns;
  echo '<b></td>';
  echo '</tr>';
  echo '</table>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Ser No";
echo  '</b></td>';
echo  '<td align=center rowspan=2  width=5%><b>';
echo  "Cct ID";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=20%><b>';
echo  "Station";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Time of Outage";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Loc of Outage";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Reason for Outage";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=3%><b>';
echo  "Current Status";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=10%><b>';
echo  "From";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  "To";
echo  '</b></td>';

echo  '</b></tr>';
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq3_mw_cct = "select * from nfs where doe = '".$sel_dt_up."' and fmn='HQ 3 CORPS'";
$result_hq3_mw_cct = $conn->query($sql_hq3_mw_cct);

if($result_hq3_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq3_mw_cct = $result_hq3_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["tob"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["loc_of_outage"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["reason_for_outage"];
echo  '</td>';
if($row_hq3_mw_cct["current_status"]=="RESTORED")
{
echo  '<td align=center bgcolor=orange width=3%>';
echo  $row_hq3_mw_cct["current_status"];
echo  '</td>';
}
elseif($row_hq3_mw_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=3%>';
echo  $row_hq3_mw_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=3%>';
echo  $row_hq3_mw_cct["current_status"];
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=8 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

//------------------------------------HQ 2 MTN DIV----------------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq2_mw_cct = "select * from nfs where doe = '".$sel_dt_up."' and fmn='HQ 2 MTN DIV'";
$result_hq2_mw_cct = $conn->query($sql_hq2_mw_cct);

if($result_hq2_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq2_mw_cct = $result_hq2_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["tob"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["loc_of_outage"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["reason_for_outage"];
echo  '</td>';
if($row_hq2_mw_cct["current_status"]=="RESTORED")
{
echo  '<td align=center bgcolor=orange width=3%>';
echo  $row_hq2_mw_cct["current_status"];
echo  '</td>';
}
elseif($row_hq2_mw_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=3%>';
echo  $row_hq2_mw_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=3%>';
echo  $row_hq2_mw_cct["current_status"];
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=8 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

//---------------------------------HQ 56 INF DIV------------------------------------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_mw_cct = "select * from nfs where doe = '".$sel_dt_up."' and fmn='HQ 56 INF DIV'";
$result_hq56_mw_cct = $conn->query($sql_hq56_mw_cct);

if($result_hq56_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq56_mw_cct = $result_hq56_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["tob"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["loc_of_outage"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["reason_for_outage"];
echo  '</td>';
if($row_hq56_mw_cct["current_status"]=="RESTORED")
{
echo  '<td align=center bgcolor=orange width=3%>';
echo  $row_hq56_mw_cct["current_status"];
echo  '</td>';
}
elseif($row_hq56_mw_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=3%>';
echo  $row_hq56_mw_cct["current_status"];
echo  '</td>';
}
else
{
echo  '<td align=center bgcolor=red width=3%>';
echo  $row_hq56_mw_cct["current_status"];
echo  '</td>';
}
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=8 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

//----------------------------------------HQ 57 MTN DIV----------------------------------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq57_mw_cct = "select * from nfs where doe = '".$sel_dt_up."' and fmn='HQ 57 MTN DIV'";
$result_hq57_mw_cct = $conn->query($sql_hq57_mw_cct);

if($result_hq57_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq57_mw_cct = $result_hq57_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=left width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq57_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_mw_cct["tob"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_mw_cct["loc_of_outage"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq57_mw_cct["reason_for_outage"];
echo  '</td>';
if($row_hq57_mw_cct["current_status"]=="RESTORED")
{
echo  '<td align=center bgcolor=orange width=3%>';
echo  $row_hq57_mw_cct["current_status"];
echo  '</td>';
}
elseif($row_hq57_mw_cct["current_status"]=="OK")
{
echo  '<td align=center bgcolor=green width=3%>';
echo  $row_hq57_mw_cct["current_status"];
echo  '</td>';
}

else
{
echo  '<td align=center bgcolor=red width=3%>';
echo  $row_hq57_mw_cct["current_status"];
echo  '</td>';
}
echo  '</tr>';
$i++;
}
echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=8 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';

//----------------------------------------Cct NFS State--------------------------

echo "<p style='page-break-after:always'></p>";
//----------------------------------------Cct RR State--------------------------
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=12 align=center><b>';
 echo 'SUMMARY : OOO RR CCTS IN LAST 24 HRS';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Ser No";
echo  '</b></td>';
echo  '<td align=center rowspan=2  width=5%><b>';
echo  "Cct ID";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=20%><b>';
echo  "Station";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=3%><b>';
echo  "Media";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=6%><b>';
echo  "Cct Utilization";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Link Details";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=5%><b>';
echo  "Cct Servicability";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Outage Reason";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Remarks";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=10%><b>';
echo  "From";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  "To";
echo  '</b></td>';
echo  '<td align=center width=3%><b>';
echo  "Speech";
echo  '</b></td>';
echo  '<td align=center width=3%><b>';
echo  "&nbsp;&nbsp;&nbsp;Data&nbsp;&nbsp;&nbsp;";
echo  '</b></td>';
echo  '</b></tr>';
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq3_rrmw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, outage_reason, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 3 CORPS' and media='RR'";
$result_hq3_rrmw_cct = $conn->query($sql_hq3_rrmw_cct);

if($result_hq3_rrmw_cct->num_rows > 0)
{
$i=1;
while($row_hq3_rrmw_cct = $result_hq3_rrmw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_rrmw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_rrmw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_rrmw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_rrmw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_rrmw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_rrmw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_rrmw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_rrmw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_rrmw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_rrmw_cct["remarks"];
echo  '</td>';
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 2 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq2_rrmw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 2 MTN DIV' and media='RR'";
$result_hq2_rrmw_cct = $conn->query($sql_hq2_rrmw_cct);

if($result_hq2_rrmw_cct->num_rows > 0)
{
$i=1;
while($row_hq2_rrmw_cct = $result_hq2_rrmw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_rrmw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_rrmw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_rrmw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_rrmw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_rrmw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_rrmw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_rrmw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_rrmw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_rrmw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_rrmw_cct["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';

//------------------------------------------HQ 56 Inf Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_rrmw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 56 INF DIV' and media='RR'";
$result_hq56_rrmw_cct = $conn->query($sql_hq56_rrmw_cct);

if($result_hq56_rrmw_cct->num_rows > 0)
{
$i=1;
while($row_hq56_rrmw_cct = $result_hq56_rrmw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_rrmw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_rrmw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_rrmw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_rrmw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["reason"];
echo  '</td>';

echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left ><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 57 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_rrmw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 57 MTN DIV' and media='RR'";
$result_hq56_rrmw_cct = $conn->query($sql_hq56_rrmw_cct);

if($result_hq56_rrmw_cct->num_rows > 0)
{
$i=1;
while($row_hq56_rrmw_cct = $result_hq56_rrmw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_rrmw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_rrmw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_rrmw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_rrmw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_rrmw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_rrmw_cct["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------Cct RR State--------------------------
echo "<p style='page-break-after:always'></p>";
//----------------------------------------Cct MW State--------------------------
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=12 align=center><b>';
 echo 'SUMMARY : OOO MW CCTS IN LAST 24 HRS';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Ser No";
echo  '</b></td>';
echo  '<td align=center rowspan=2  width=5%><b>';
echo  "Cct ID";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=20%><b>';
echo  "Station";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=3%><b>';
echo  "Media";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=6%><b>';
echo  "Cct Utilization";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Link Details";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Cct Servicability";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=20%><b>';
echo  "Outage Reason";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=5%><b>';
echo  "Remarks";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=10%><b>';
echo  "From";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  "To";
echo  '</b></td>';
echo  '<td align=center width=3%><b>';
echo  "Speech";
echo  '</b></td>';
echo  '<td align=center width=3%><b>';
echo  "&nbsp;&nbsp;&nbsp;Data&nbsp;&nbsp;&nbsp;";
echo  '</b></td>';
echo  '</b></tr>';
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq3_mw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, outage_reason, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 3 CORPS' and media='MW'";
$result_hq3_mw_cct = $conn->query($sql_hq3_mw_cct);

if($result_hq3_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq3_mw_cct = $result_hq3_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq3_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq3_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_mw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_mw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_mw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_mw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_mw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_mw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_mw_cct["remarks"];
echo  '</td>';
echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 2 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq2_mw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 2 MTN DIV' and media='MW'";
$result_hq2_mw_cct = $conn->query($sql_hq2_mw_cct);

if($result_hq2_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq2_mw_cct = $result_hq2_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq2_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq2_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_mw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_mw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2_mw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_mw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_mw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_mw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2_mw_cct["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 2 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';

//------------------------------------------HQ 56 Inf Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_mw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 56 INF DIV' and media='MW'";
$result_hq56_mw_cct = $conn->query($sql_hq56_mw_cct);

if($result_hq56_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq56_mw_cct = $result_hq56_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["reason"];
echo  '</td>';

echo  '</tr>';
$i++;
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left ><b>';
 echo 'HQ 56 INF DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

echo '<p></p>';
//------------------------------------------HQ 57 Mtn Div-----------------------
echo '<tr>';
echo '<td colspan=12 align=left bgcolor=white><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';
$sql_hq56_mw_cct = "select cct_id, stn_fm, stn_to, media, speech, data, link_details, cct_servicability, remarks, fmn, doe from rr_mw_ccts where doe = '".$sel_dt_up."' and fmn='HQ 57 MTN DIV' and media='MW'";
$result_hq56_mw_cct = $conn->query($sql_hq56_mw_cct);

if($result_hq56_mw_cct->num_rows > 0)
{
$i=1;
while($row_hq56_mw_cct = $result_hq56_mw_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';
echo  '<td align=center width=2%><b>';
echo  $i;

echo  '</b></td>';
echo  '<td align=left width=5%>';
echo  $row_hq56_mw_cct["cct_id"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hq56_mw_cct["stn_to"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["media"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["speech"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56_mw_cct["data"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["link_details"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["cct_servicability"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["outage_reason"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56_mw_cct["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 57 MTN DIV';
 echo '<b></td>';   
  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------Cct MW State--------------------------
//----------------------------------------Cct MW State--------------------------
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=12 align=center><b>';
 echo 'DCN STATUS IN LAST 24 HRS';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center width=50%><b>';
echo  "Last 24 hrs Connectivity Status Update";
echo  '</b></td>';
echo  '<td align=center width=50%><b>';
echo  "Pending Tasks/Faults & Updates";
echo  '</b></td>';

echo  '</tr>';


$sql_hq3_dcn_cct = "select conn_status_update, pend_task_fault, doe from dcn where doe = '".$sel_dt_up."'";
$result_hq3_dcn_cct = $conn->query($sql_hq3_dcn_cct);

if($result_hq3_dcn_cct->num_rows > 0)
{
$i=1;
while($row_hq3_dcn_cct = $result_hq3_dcn_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';

echo  '<td align=left width=50% valign=top>';
echo  $row_hq3_dcn_cct["conn_status_update"];
echo  '</td>';
echo  '<td align=left width=50% valign=top>';
echo  $row_hq3_dcn_cct["pend_task_fault"];
echo  '</td>';
echo  '</tr>';
}
//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '<tr>';
echo  '<td colspan=13 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}
echo  '</table>';
echo '<p></p>';

//----------------------------------------Cct MW State--------------------------
?>


<?php
mysqli_close($conn);
//}

?>
<p></p>
<br/>
<br/>
<br/>
<br/>
<?php 
/*echo "<form method='post' action='e-Comn State.php'>";
echo "<input type='hidden' name='login' value='12345''>";
echo "<h2 align=center>&nbsp;&nbsp;<input type='submit' value='Change Date' /></h2>";*/
echo '<table width=100% border=0>';
echo '<tr>';
echo '<td align=center><b>';
 echo '_________________________';
 echo '<b></td>'; 
 echo '<td align=center><b>';
 echo '_________________________';
 echo '<b></td>';   
  echo '</tr>';
  echo '<tr>';
echo '<td align=center><b>';
 echo '(JCO I/C SYS)';
 echo '<b></td>'; 
 echo '<td align=center><b>';
 echo '(OC 1 Coy)';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';


?>
<script>javascript:window.print()</script>


</body>
</html>
