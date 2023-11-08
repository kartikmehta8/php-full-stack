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
$sql_app = "select doe, status from approval where doe = '".$sel_dt_up."'";
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
{
$sql_ts = "select title, status from tech_stand_to_summary where doe = '".$sel_dt_up."'";
$result_ts = $conn->query($sql_ts);

if($result_ts->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=3 align=left><b>';
 echo '1. Tech Stand to Summary';
 echo '<b></td>';   
  echo '</tr>';
while($row_ts = $result_ts->fetch_assoc())
{
  
echo  '<tr>';
echo  '<td align=left width=2%><b>';
echo  "*";

echo  '</b></td>';
echo  '<td align=left width=30%>';
echo  $row_ts["title"];
echo ":";
echo  '</td>';
echo  '<td align=left width=50%>';
echo  $row_ts["status"];
echo  '</td>';
echo  '</tr>';
$i++;
}
echo  '</table>';
}
else
{
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '1. Tech Stand to Summary';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------Call Throughput State--------------------------
$ct_avg_in=0;
$ct_avg_out=0;
$ct_avg_dt=date('Y-m-d', strtotime('-15 days', strtotime($sel_dt_up)));

$sql_ct_avg = "select title,toc,SUM(noc) as avg, COUNT(noc) as total from call_throughput_state where doe >= '".$ct_avg_dt."' and call_state_type = 'Throughput' group by toc, title";
$result_ct_avg = $conn->query($sql_ct_avg);
if($result_ct_avg->num_rows > 0)
{
while($row_ct_avg = $result_ct_avg->fetch_assoc())
{
	if ($row_ct_avg["title"] == "MSS (Nortel)")
	{
	if ($row_ct_avg["toc"] == "In Calls")
	{
		$mss_avg_in = $row_ct_avg["avg"]/$row_ct_avg["total"];
		
	}
	$mss_avg_out = $row_ct_avg["avg"]/$row_ct_avg["total"];
	
	}
	
	if ($row_ct_avg["title"] == "ASCON")
	{
	if ($row_ct_avg["toc"] == "In Calls")
	{
		$asc_avg_in = $row_ct_avg["avg"]/$row_ct_avg["total"];
		
	}
	$asc_avg_out = $row_ct_avg["avg"]/$row_ct_avg["total"];
	
	}
	
	if ($row_ct_avg["title"] == "Help Line in")
	{
		$hl_avg_in = $row_ct_avg["avg"]/$row_ct_avg["total"];
		
	}
	
	if ($row_ct_avg["title"] == "Local Civ Call")
	{
		$lc_avg_out = $row_ct_avg["avg"]/$row_ct_avg["total"];
		
	}
}
}

$i_ct=1;
$dt_y=date("d-m-y", strtotime("-2 days"));
$dt=date("d-m-y",strtotime("-1 days"));

$cur_dt = "select CURDATE() as dt";
$result_cur_dt = $conn->query($cur_dt);
while($row_cur_dt = $result_cur_dt->fetch_assoc())
{
$pdt=$row_cur_dt["dt"];
}
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=9 align=left><b>';
 echo '2. Call Throughput State';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "S No";
echo  '</b></td>';
echo  '<td align=center colspan=3  width=35%><b>';
echo  "In Calls";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Average Through put Data of last 15 days";
echo  '</b></td>';
echo  '<td align=center colspan=3 width=35%><b>';
echo  "Out Calls";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Average Through put Data of last 15 days";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=20%><b>';
echo  "Title";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_dby;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_y;
echo  '</b></td>';
echo  '<td align=center width=20%><b>';
echo  "Title";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_dby;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_y;
echo  '</b></td>';
echo  '</b></tr>';
$ct_dt=date('Y-m-d', strtotime('-2 days', strtotime($sel_dt_up)));
$ct_dt_y=date('Y-m-d', strtotime('-1 days', strtotime($sel_dt_up)));
$sql_ct = "select * from call_throughput_state where doe >= '".$ct_dt."' and call_state_type = 'Throughput' group by title, toc, call_state_type, doe order by id";
$result_ct = $conn->query($sql_ct);

if($result_ct->num_rows > 0)
{

while($row_ct = $result_ct->fetch_assoc())
{
//------------------------------------------MSS-------------------------------------------------- 
if ($row_ct["title"] == "MSS (Nortel)")
{
	if ($row_ct["toc"] == "In Calls" & $row_ct["doe"] == $ct_dt_y)
	{
	$mss_noc_in=$row_ct["noc"];
	}
	elseif ($row_ct["toc"] == "In Calls" & $row_ct["doe"] == $ct_dt)
	{
	$mss_noc_in_y=$row_ct["noc"];
	}
	
	if ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt_y)
	{
	$mss_noc_out=$row_ct["noc"];
	}
	elseif ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt)
	{
	$mss_noc_out_y=$row_ct["noc"];
	}

}
//------------------------------------------MSS-------------------------------------------------- 

//------------------------------------------ASCON-------------------------------------------------- 
if ($row_ct["title"] == "ASCON")
{
	if ($row_ct["toc"] == "In Calls" & $row_ct["doe"] == $ct_dt_y)
	{
	$asc_noc_in=$row_ct["noc"];
	}
	elseif ($row_ct["toc"] == "In Calls" & $row_ct["doe"] == $ct_dt)
	{
	$asc_noc_in_y=$row_ct["noc"];
	}
	
	if ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt_y)
	{
	$asc_noc_out=$row_ct["noc"];
	}
	elseif ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt)
	{
	$asc_noc_out_y=$row_ct["noc"];
	}

}
//------------------------------------------ASCON-------------------------------------------------- 

//------------------------------------------Help Line-------------------------------------------------- 
if ($row_ct["title"] == "Help Line in")
{
	if ($row_ct["doe"] == $ct_dt_y)
	{
	$hl_noc_in=$row_ct["noc"];
	}
	elseif ($row_ct["doe"] == $ct_dt)
	{
	$hl_noc_in_y=$row_ct["noc"];
	}
	
}
//------------------------------------------Help Line-------------------------------------------------- 

//------------------------------------------Help Line-------------------------------------------------- 
if ($row_ct["title"] == "Help Line in")
{
	if ($row_ct["doe"] == $ct_dt_y)
	{
	$hl_noc_in=$row_ct["noc"];
	}
	elseif ($row_ct["doe"] == $ct_dt)
	{
	$hl_noc_in_y=$row_ct["noc"];
	}
	
}
//------------------------------------------Help Line--------------------------------------------------
//------------------------------------------Local Civ-------------------------------------------------- 
if ($row_ct["title"] == "Local Civ Call")
{	
	if ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt_y)
	{
	$lc_noc_out=$row_ct["noc"];
	}
	elseif ($row_ct["toc"] == "Out Calls" & $row_ct["doe"] == $ct_dt)
	{
	$lc_noc_out_y=$row_ct["noc"];
	}

}
//------------------------------------------Local Civ--------------------------------------------------
}

//---------------------------------------Totals-----------------------------
$t_in=$mss_noc_in+$asc_noc_in+$hl_noc_in;
$t_in_y=$mss_noc_in_y+$asc_noc_in_y+$hl_noc_in_y;
$t_out=$mss_noc_out+$asc_noc_out+$lc_noc_out;
$t_out_y=$mss_noc_out_y+$asc_noc_out_y+$lc_noc_out_y;
$t_avg_in=$mss_avg_in+$asc_avg_in+$hl_avg_in;
$t_avg_out=$mss_avg_out+$asc_avg_out+$lc_avg_out;



//-----------------------------------------------------------Output Area------------------------------------------
//------------------------------------------MSS-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "1.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "MSS (Nortel)";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $mss_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $mss_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($mss_avg_in);
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "MSS (Nortel)";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $mss_noc_out_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $mss_noc_out;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($mss_avg_out);
echo  '</td>';
//------------------------------------------MSS-------------------------------------------------- 

//------------------------------------------ASCON-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "2.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "ASCON";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $asc_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $asc_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($asc_avg_in);
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "ASCON";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $asc_noc_out_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $asc_noc_out;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($asc_avg_out);
echo  '</td>';
//------------------------------------------ASCON-------------------------------------------------- 

//------------------------------------------Help Line & Local Civ-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "3.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Help line In";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $hl_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $hl_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($hl_avg_in);
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Local Civ Call";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $lc_noc_out_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $lc_noc_out;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($lc_avg_out);
echo  '</td>';
//------------------------------------------Help Line & Local Civ-------------------------------------------------- 

//------------------------------------------Totals-------------------------------------------------- 
echo  '<tr>';
echo  '<td colspan=2 align=left width=20%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $t_in_y;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $t_in;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  round($t_avg_in);
echo  '</b></td>';
echo  '<td align=left width=20%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $t_out_y;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $t_out;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  round($t_avg_out);
echo  '</b></td>';
//------------------------------------------Totals-------------------------------------------------- 

}
//----------------------------------------------Call Throughput-----------------------------------





//----------------------------------------Call Switch Board State--------------------------
$cs_avg_in=0;
$cs_avg_out=0;


$sql_cs_avg = "select title,toc,SUM(noc) as avg, COUNT(noc) as total from call_throughput_state where doe >= '".$ct_avg_dt."' and call_state_type = 'Switch Board' group by toc, title";
$result_cs_avg = $conn->query($sql_cs_avg);
if($result_cs_avg->num_rows > 0)
{
while($row_cs_avg = $result_cs_avg->fetch_assoc())
{
	if ($row_cs_avg["title"] == "Trunk In Mil")
	{
		$tm_avg_in = $row_cs_avg["avg"]/$row_cs_avg["total"];
	}
	
	if ($row_cs_avg["title"] == "Trunk In Civil")
	{
		$tc_avg_in = $row_cs_avg["avg"]/$row_cs_avg["total"];
	}
	
	if ($row_cs_avg["title"] == "Local Asst")
	{
		$la_avg_in = $row_cs_avg["avg"]/$row_cs_avg["total"];
	}
	if ($row_cs_avg["title"] == "Trunk Out Mil")
	{
		$tm_avg_out = $row_cs_avg["avg"]/$row_cs_avg["total"];
	}
	
	if ($row_cs_avg["title"] == "Trunk Out Civil")
	{
		$tc_avg_out = $row_cs_avg["avg"]/$row_cs_avg["total"];
	}
	
		
}
}

/*$i_cs=1;
$dt_y=date("d-m-y", strtotime("-1 days"));
$dt=date("d-m-y");*/

/*$cur_dt = "select CURDATE() as dt";
$result_cur_dt = $conn->query($cur_dt);
while($row_cur_dt = $result_cur_dt->fetch_assoc())
{
$pdt=$row_cur_dt["dt"];
}*/

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=9 align=left><b>';
 echo '3. Call State: Switch Board';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "S No";
echo  '</b></td>';
echo  '<td align=center colspan=3  width=35%><b>';
echo  "In Calls";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Average Through put Data of last 15 days";
echo  '</b></td>';
echo  '<td align=center colspan=3 width=35%><b>';
echo  "Out Calls";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=10%><b>';
echo  "Average Through put Data of last 15 days";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
echo  '<td align=center width=20%><b>';
echo  "Title";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_dby;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_y;
echo  '</b></td>';
echo  '<td align=center width=20%><b>';
echo  "Title";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_dby;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $show_dt_up_y;
echo  '</b></td>';
echo  '</b></tr>';

$sql_cs = "select * from call_throughput_state where doe >= '".$ct_dt."' and call_state_type = 'Switch Board' group by title, toc, call_state_type, doe order by id";
$result_cs = $conn->query($sql_cs);

if($result_cs->num_rows > 0)
{

while($row_cs = $result_cs->fetch_assoc())
{
//------------------------------------------Trunk In Mil-------------------------------------------------- 
if ($row_cs["title"] == "Trunk In Mil")
{
	if ($row_cs["toc"] == "In Calls" & $row_cs["doe"] == $ct_dt_y)
	{
	$tm_noc_in=$row_cs["noc"];
	}
	elseif ($row_cs["toc"] == "In Calls" & $row_cs["doe"] == $ct_dt)
	{
	$tm_noc_in_y=$row_cs["noc"];
	}
}
//------------------------------------------Trunk In Mil-------------------------------------------------- 

//------------------------------------------Trunk In Civil-------------------------------------------------- 
if ($row_cs["title"] == "Trunk In Civil")
{
	if ($row_cs["toc"] == "In Calls" & $row_cs["doe"] == $ct_dt_y)
	{
	$tc_noc_in=$row_cs["noc"];
	}
	elseif ($row_cs["toc"] == "In Calls" & $row_cs["doe"] == $ct_dt)
	{
	$tc_noc_in_y=$row_cs["noc"];
	}
}
//------------------------------------------Trunk In Civil-------------------------------------------------- 

//------------------------------------------Local Asst-------------------------------------------------- 
if ($row_cs["title"] == "Local Asst")
{
	if ($row_cs["doe"] == $sel_dt_up)
	{
	$la_noc_in=$row_cs["noc"];
	}
	elseif ($row_cs["doe"] == $ct_dt)
	{
	$la_noc_in_y=$row_cs["noc"];
	}
	
}
//------------------------------------------Local Asst-------------------------------------------------- 

//------------------------------------------Trunk Out Mil-------------------------------------------------- 
if ($row_cs["title"] == "Trunk Out Mil")
{
	if ($row_cs["toc"] == "Out Calls" & $row_cs["doe"] == $ct_dt_y)
	{
	$tm_noc_out=$row_cs["noc"];
	}
	elseif ($row_cs["toc"] == "Out Calls" & $row_cs["doe"] == $ct_dt)
	{
	$tm_noc_out_y=$row_cs["noc"];
	}
}
//------------------------------------------Trunk Out Mil-------------------------------------------------- 

//------------------------------------------Trunk Out Civil-------------------------------------------------- 
if ($row_cs["title"] == "Trunk Out Civil")
{
	if ($row_cs["toc"] == "Out Calls" & $row_cs["doe"] == $ct_dt_y)
	{
	$tc_noc_out=$row_cs["noc"];
	}
	elseif ($row_cs["toc"] == "Out Calls" & $row_cs["doe"] == $ct_dt)
	{
	$tc_noc_out_y=$row_cs["noc"];
	}
}
//------------------------------------------Trunk Out Civil-------------------------------------------------- 
}

//---------------------------------------Totals-----------------------------
$tcs_in=$tm_noc_in+$tc_noc_in+$la_noc_in;
$tcs_in_y=$tm_noc_in_y+$tc_noc_in_y+$la_noc_in_y;
$tcs_out=$tm_noc_out+$tc_noc_out;
$tcs_out_y=$tm_noc_out_y+$tc_noc_out_y;
$tcs_avg_in=$tm_avg_in+$tc_avg_in+$la_avg_in;
$tcs_avg_out=$tm_avg_out+$tc_avg_out;



//-----------------------------------------------------------Output Area------------------------------------------
//------------------------------------------Trunk In/Out Mil-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "1.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Trunk In Mil";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tm_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tm_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($tm_avg_in);
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Trunk Out Mil";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tm_noc_out_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tm_noc_out;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($tm_avg_out);
echo  '</td>';
//------------------------------------------Trunk In/Out Mil-------------------------------------------------- 

//------------------------------------------Trunk In/Out Civil-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "2.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Trunk In Civil";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tc_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $tc_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($tc_avg_in);
echo  '</td>';
echo  '<td rowspan=2 align=left width=20%>';
echo  "Trunk Out Civil";
echo  '</td>';
echo  '<td rowspan=2 align=center width=10%>';
echo  $tc_noc_out_y;
echo  '</td>';
echo  '<td rowspan=2 align=center width=10%>';
echo  $tc_noc_out;
echo  '</td>';
echo  '<td rowspan=2 align=center width=10%>';
echo  round($tc_avg_out);
echo  '</td>';
//------------------------------------------Trunk In/Out Civil-------------------------------------------------- 

//------------------------------------------Local Asst-------------------------------------------------- 
echo  '<tr>';
echo  '<td align=left width=2%>';
echo  "3.";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  "Local Asst";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $la_noc_in_y;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $la_noc_in;
echo  '</td>';
echo  '<td align=center width=10%>';
echo  round($la_avg_in);
echo  '</td>';

//------------------------------------------Local Asst-------------------------------------------------- 

//------------------------------------------Totals-------------------------------------------------- 
echo  '<tr>';
echo  '<td colspan=2 align=left width=20%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $tcs_in_y;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $tcs_in;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  round($tcs_avg_in);
echo  '</b></td>';
echo  '<td align=left width=20%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $tcs_out_y;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  $tcs_out;
echo  '</b></td>';
echo  '<td align=center width=10%><b>';
echo  round($tcs_avg_out);
echo  '</b></td>';
//------------------------------------------Totals-------------------------------------------------- 

}
//----------------------------------------------Call Switch Board State-----------------------------------


//----------------------------------------------Comn Demand-----------------------------------
$sql_cd = "select type, discription from comn_demand where doe = '".$sel_dt_up."'";
$result_cd = $conn->query($sql_cd);

if($result_cd->num_rows > 0)
{

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=3 align=left><b>';
 echo '4. Comn Demands';
 echo '<b></td>';   
  echo '</tr>';
while($row_cd = $result_cd->fetch_assoc())
{
  
echo  '<tr>';
echo  '<td align=left width=2%>';
echo "*";
echo  '</td>';
echo  '<td align=left width=30%>';
echo  $row_cd["type"];
echo ":";
echo  '</td>';
echo  '<td align=left width=50%>';
echo  $row_cd["discription"];
echo  '</td>';
echo  '</tr>';

}
echo  '</table>';
}
else
{
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '4. Comn Demands';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  "Nil";
echo  '</td>';
echo  '</tr>';
echo  '</table>';


}

echo '<p></p>';
//----------------------------------------------Comn Demand-----------------------------------


//----------------------------------------------Move/Comn Sr Offr/VIP-----------------------------------
$sql_mc = "select cat, discription from move_comn_vip where doe = '".$sel_dt_up."'";
$result_mc = $conn->query($sql_mc);

if($result_mc->num_rows > 0)
{

	   
  
while($row_mc = $result_mc->fetch_assoc())
{
if($row_mc["cat"]=="Move of Sr Offrs")
	{

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '5. Move of Sr Offrs';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  $row_mc["discription"];
echo  '</td>';
echo  '</tr>';
echo  '</table>';
}


if($row_mc["cat"]=="Comn Arng for Sr Offr")
	{

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '6. Comn Arng for Sr Offr';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  $row_mc["discription"];
echo  '</td>';
echo  '</tr>';
echo  '</table>';
}
if($row_mc["cat"]=="Move of visiting VIP")
	{

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '7. Move of visiting VIP';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  $row_mc["discription"];
echo  '</td>';
echo  '</tr>';
echo  '</table>';
}
if($row_mc["cat"]=="Comn Arng of Visiting VIP")
	{

echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '8. Comn Arng of Visiting VIP';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  $row_mc["discription"];
echo  '</td>';
echo  '</tr>';
echo  '</table>';
}

}

}
else
{
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '5. Move of Sr Offrs';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  "Nil";
echo  '</td>';
echo  '</tr>';
echo  '</table>';
echo '<p></p>';
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '6. Comn Arng for Sr Offr';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  "Nil";
echo  '</td>';
echo  '</tr>';
echo  '</table>';
echo '<p></p>';
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '7. Move of visiting VIP';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  "Nil";
echo  '</td>';
echo  '</tr>';
echo  '</table>';
echo '<p></p>';
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td  align=left width=32%><b>';
 echo '8. Comn Arng of Visiting VIP';
 echo '<b></td>';
  
echo  '<td align=left width=50%>';
echo  "Nil";
echo  '</td>';
echo  '</tr>';
echo  '</table>';


}
echo '<p></p>';

//----------------------------------------------Move/Comn Sr Offr/VIP-----------------------------------

//----------------------------------------------Loc State-----------------------------------
$sql_ls = "select * from loc_state where doe = '".$sel_dt_up."'";
$result_ls = $conn->query($sql_ls);

if($result_ls->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=9 align=left><b>';
 echo '9. Loc State: SrCdrs/ SrOffr';
 echo '<b></td>';   
  echo '</tr>';
while($row_ls = $result_ls->fetch_assoc())
{
  
echo  '<tr>';
echo  '<td align=left width=2%>';
echo "*";
echo  '</td>';
echo  '<td align=left width=30%>';
echo  $row_ls["appt"];

echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_ls["mtime"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ls["mtype"];

echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ls["mloc"];
echo  '</td>';
echo  '<td align=left width=5%>';
echo  $row_ls["etime"];

echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ls["etype"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ls["eloc"];

echo  '</td>';
echo  '</tr>';

}
echo  '</table>';
}
else
{
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td colspan=9 align=left><b>';
 echo '9. Loc State: SrCdrs/ SrOffr';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=9 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Loc State-----------------------------------

//----------------------------------------------Call State – Imp Appts-----------------------------------
$sql_ia = "select * from callstate_impappt where doe = '".$sel_dt_up."'";
$result_ia = $conn->query($sql_ia);

if($result_ia->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "10. Call State: Imp Appts";
 echo '<b></td>';   
  echo '</tr>';
  echo "</table>";
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=30%><b>';
 echo 'Appt';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Out';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'In';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Cancelled';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Pending';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Total';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';          
  echo '</tr>';
  
while($row_ia = $result_ia->fetch_assoc())
{
  $temp=0;
 $temp=$row_ia["cout"]+$row_ia["cin"]+$row_ia["ccancel"]+$row_ia["cpending"];

echo  '<td align=left width=30%>';
echo  $row_ia["appt"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ia["cout"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ia["cin"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ia["ccancel"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ia["cpending"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $temp;
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ia["remarks"];
echo  '</td>';
echo  '</tr>';

}
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '10. Call State: Imp Appts';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Call State – Imp Appts-----------------------------------

//----------------------------------------------Faulty Tele -----------------------------------
$sql_ft = "select * from faulty_tele where doe = '".$sel_dt_up."'";
$result_ft = $conn->query($sql_ft);

if($result_ft->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "11. Faulty Tele";
 echo '<b></td>';   
  echo '</tr>';
  echo "</table>";
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time Out';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time Rectified';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Nature of fault';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'IVRS';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';       
  echo '</tr>';
 $temp=0;  
 $i=1;
while($row_ft = $result_ft->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ft["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["tout"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["trect"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["nof"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_ft["ivrs"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_ft["remarks"];
echo  '</td>';
echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '11. Faulty Tele';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Faulty Tele -----------------------------------

//----------------------------------------------Comn to Units  -----------------------------------
$sql_cu = "select * from comn_to_units where doe = '".$sel_dt_up."' group by media,appt,teleno";
$result_cu = $conn->query($sql_cu);

if($result_cu->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0 >';
echo '<tr >';
echo '<td align=left><b>';
 echo "12. Comn to Units / Sub units outside Rangapahar Mil Stn";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Media';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time of Fault';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time of Restoration';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Status';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Nature of Fault';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_cu = $result_cu->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_cu["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["media"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["tout"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["trect"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["status"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_cu["nof"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '12. Comn to Units / Sub units outside Rangapahar Mil Stn';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Comn to Units -----------------------------------

//----------------------------------------------Shifting of Tele-----------------------------------
$sql_st = "select * from shifting_of_tele where doe = '".$sel_dt_up."'";
$result_st = $conn->query($sql_st);

if($result_st->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "13. Shifting of Tele";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'From';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'To';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Loc';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_st = $result_st->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_st["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["tshift"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["fm"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["to_s"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["dp_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_st["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '13. Shifting of Tele';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Shifting of Tele-----------------------------------

//----------------------------------------------Dis/Con/Temp of Tele-----------------------------------
$sql_c = "select * from c_d_of_tele where doe = '".$sel_dt_up."' and type='Disconnection'";
$result_c = $conn->query($sql_c);

if($result_c->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "14. Disconnection of Tele";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Loc';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_c = $result_c->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_c["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_c["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_c["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_c["tinstall"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_c["dp_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_c["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '14. Disconnection of Tele';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';


$sql_d = "select * from c_d_of_tele where doe = '".$sel_dt_up."' and type='New Connection'";
$result_d = $conn->query($sql_d);

if($result_d->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "15. New Tele Connection";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Loc';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_d = $result_d->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_d["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_d["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_d["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_d["tinstall"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_d["dp_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_d["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '15. New Tele Connection';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';


$sql_tcon = "select * from c_d_of_tele where doe = '".$sel_dt_up."' and type='Temp Connection'";
$result_tcon = $conn->query($sql_tcon);

if($result_tcon->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "16. Temporary Tele Connection/Activation/Deactivation";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Name/Appt';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Loc';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_tcon = $result_tcon->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tcon["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_tcon["appt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tcon["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tcon["tinstall"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tcon["dp_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tcon["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '16. Temporary Tele Connection/Activation/Deactivation';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';


//----------------------------------------------Dis/Con/Temp of Tele-----------------------------------


//----------------------------------------------Temp Trunk-----------------------------------
$sql_tt = "select * from temp_trunk where doe = '".$sel_dt_up."'";
$result_tt = $conn->query($sql_tt);

if($result_tt->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "17. Temporary Trunk Cct/ Activation/Deactivation";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Access Code';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Type Of Cct';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Loc';
 echo '<b></td>';  
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_tt = $result_tt->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tt["access_code"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_tt["toc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tt["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tt["tinstall"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tt["dp_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_tt["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '17. Temporary Trunk Cct/ Activation/Deactivation';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Shifting of Tele-----------------------------------

//----------------------------------------------Damage-----------------------------------
$sql_dam = "select * from damage where doe = '".$sel_dt_up."'";
$result_dam = $conn->query($sql_dam);

if($result_dam->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "18. Damage to JFC by Digging/ construction wk/ Stolen in RMS";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Description';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Info By';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Status of Cable';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_dam = $result_dam->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_dam["loc"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_dam["description"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_dam["info_by"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_dam["status_of_cable"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_dam["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=5 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '18. Damage to JFC by Digging/ construction wk/ Stolen in RMS';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Damage-----------------------------------

//----------------------------------------------Line Maint/ Line Laying-----------------------------------
$sql_lin = "select * from line_maint_laying where doe = '".$sel_dt_up."'";
$result_lin = $conn->query($sql_lin);

if($result_lin->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "19. Line Maint/ Line Laying";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Description';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Line Maint/Line Closing (mtrs)';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'DP Maint';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_lin = $result_lin->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_lin["loc"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_lin["description"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_lin["line_maint_closing"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_lin["dp_maint"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_lin["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '19. Line Maint/ Line Laying';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Line Maint/ Line Laying-----------------------------------

//----------------------------------------------Important Civ Tele Number-----------------------------------
$sql_icn = "select * from imp_civ_teleno where doe = '".$sel_dt_up."'";
$result_icn = $conn->query($sql_icn);

if($result_icn->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "20. Important Civ Tele Number";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Tele No';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Service';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Loc';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Status';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_icn = $result_icn->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_icn["teleno"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_icn["service"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_icn["loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_icn["status"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_icn["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '20. Important Civ Tele Number';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Important Civ Tele Number-----------------------------------


//----------------------------------------------Hotlines Status-----------------------------------
$sql_hs = "select * from hotlines_status where doe = '".$sel_dt_up."'";
$result_hs = $conn->query($sql_hs);

if($result_hs->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0 >';
echo '<tr >';
echo '<td align=left><b>';
 echo "21. Hotlines Status";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'From';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'To';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Status';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Time';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';  
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_hs = $result_hs->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hs["fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hs["to_loc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_hs["status"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_hs["tym"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_hs["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '21. Hotlines Status';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Hotlines Status-----------------------------------

//----------------------------------------------IGAR Status-----------------------------------
$sql_igar = "select * from igar_radio_links where doe = '".$sel_dt_up."'";
$result_igar = $conn->query($sql_igar);

if($result_igar->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "22. IGAR Radio Links";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'From';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Call Sign';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'To';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Call Sign';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Schedule';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>'; 
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_igar = $result_igar->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_igar["fm"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_igar["call_sign"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_igar["to_loc"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_igar["call_sig"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_igar["schedule"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_igar["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '22. IGAR Radio Links';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------IGAR Status-----------------------------------

//----------------------------------------------SRE Status-----------------------------------
$sql_sre = "select * from sre_state where doe = '".$sel_dt_up."'";
$result_sre = $conn->query($sql_sre);

if($result_sre->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "23. SRE State";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Item';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Installed SRE';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Date';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo '1800h';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Date';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo '0500h';
 echo '<b></td>'; 
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';
 echo '</tr>';
 $temp=0;  
 $i=1;
while($row_sre = $result_sre->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["item"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_sre["installed_sre"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["y_dt"];

echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["e_tym"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["m_dt"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["m_tym"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sre["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '23. SRE State';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------SRE Status-----------------------------------

//----------------------------------------------ASIGMA Status-----------------------------------
$sql_asigstat = "select * from state_of_ASIGMA where doe = '".$sel_dt_up."'";
$result_asigstat = $conn->query($sql_asigstat);

if($result_asigstat->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "24. State of ASIGMA in 3 Corps Z.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
/*echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Title';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Installed SRE';
 echo '<b></td>';
 echo '<td  align=center width=10%><b>';
 echo 'Date';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo '1800h';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Date';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo '0500h';
 echo '<b></td>'; 
  echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';
 echo '</tr>';*/
 $temp=0;  
 $i=1;
while($row_asigstat = $result_asigstat->fetch_assoc())
{
 
 $temp++;

echo  '<tr><td align=center width=10%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=60%>';
echo  $row_asigstat["title"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_asigstat["value"];
echo  '</td>';
echo  '</tr>';
$i++;
}

echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '24. State of ASIGMA in 3 Corps Z.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------ASIGMA Status-----------------------------------

//----------------------------------------------SERVERS Status-----------------------------------
$sql_serverstat = "select * from state_of_servers where doe = '".$sel_dt_up."' group by tos,server_name";
$result_serverstat = $conn->query($sql_serverstat);

if($result_serverstat->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "25. State of SERVERS in 3 Corps Z.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td rowspan=2 align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td rowspan=2 align=center width=30%><b>';
 echo 'Server Name';
 echo '<b></td>'; 
 echo '<td rowspan=2 align=center width=10%><b>';
 echo 'Type';
 echo '<b></td>'; 
 echo '<td rowspan=2 align=center width=10%><b>';
 echo 'Service Status';
 echo '<b></td>';
 echo '<td  align=center colspan=2 width=10%><b>';
 echo 'Last fault details';
 echo '<b></td>'; 
 echo '<td rowspan=2 align=center width=30%><b>';
 echo 'Remarks';
 echo '<b></td></tr>'; 
echo '<tr bgcolor=lightgrey><td  align=center width=10%><b>';
 echo 'From';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo 'To';
 echo '<b></td></tr>'; 
 $i=1;  
 
while($row_serverstat = $result_serverstat->fetch_assoc())
{
 

echo  '<tr><td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=30%>';
echo  $row_serverstat["server_name"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_serverstat["tos"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_serverstat["service_status"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_serverstat["fm"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_serverstat["fto"];
echo  '</td>';
echo  '<td align=center width=30%>';
echo  $row_serverstat["remarks"];
echo  '</td>';
echo  '</tr>';

$i++;
}

echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '25. State of SERVERS in 3 Corps Z.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------SERVERS Status-----------------------------------


//----------------------------------------------ASIGMA C/M/D-----------------------------------
$sql_asig_cmd = "select * from asigma_mb_cmd where doe = '".$sel_dt_up."'";
$result_asig_cmd = $conn->query($sql_asig_cmd);

if($result_asig_cmd->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "26. ASIGMA mailbox Creation/ Modification/ Deletion.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td align=center width=30%><b>';
 echo 'Mailbox Name';
 echo '<b></td>'; 
 echo '<td align=center width=10%><b>';
 echo 'Action';
 echo '<b></td>'; 
 echo '<td align=center width=30%><b>';
 echo 'Remarks';
 echo '<b></td></tr>'; 
 $i=1;  
 
while($row_asig_cmd = $result_asig_cmd->fetch_assoc())
{
 

echo  '<tr><td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=30%>';
echo  $row_asig_cmd["mailbox_name"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_asig_cmd["action"];
echo  '</td>';
echo  '<td align=center width=30%>';
echo  $row_asig_cmd["remarks"];
echo  '</td>';
echo  '</tr>';

$i++;
}

echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '26. ASIGMA mailbox Creation/ Modification/ Deletion.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------ASIGMA C/M/D-----------------------------------

//----------------------------------------------Complaints-----------------------------------


echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "27. ASIGMA/LAN/ISOC Complaint.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td  align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td  align=center width=10%><b>';
 echo 'Client';
 echo '<b></td>'; 
 echo '<td  align=center width=5%><b>';
 echo 'TOC';
 echo '<b></td>';
 echo '<td  align=center width=5%><b>';
 echo 'TOR';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Complaints';
 echo '<b></td>'; 
 echo '<td  align=center width=20%><b>';
 echo 'Action Taken';
 echo '<b></td>';  
 echo '<td  align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td>';
 echo '</tr>';
 $temp=0;  
 
 $sql_comp_lan = "select * from asigma_lan_isoc_complaints where doe = '".$sel_dt_up."' and typ_of_complaint='LAN'";
$result_comp_lan = $conn->query($sql_comp_lan);

if($result_comp_lan->num_rows > 0)
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "INTRANET";
echo  '</b></td></tr>';
 $i=1;
while($row_comp_lan = $result_comp_lan->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_lan["client"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_lan["toc"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_lan["tor"];

echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_lan["complaint"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_lan["action_taken"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_lan["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
}
else
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "INTRANET";
echo  '</b></td></tr>';
echo  '<tr>';
echo  '<td colspan=7 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}

$sql_comp_asig = "select * from asigma_lan_isoc_complaints where doe = '".$sel_dt_up."' and typ_of_complaint='ASIGMA'";
$result_comp_asig = $conn->query($sql_comp_asig);

if($result_comp_asig->num_rows > 0)
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "ASIGMA";
echo  '</b></td></tr>';
 $i=1;
while($row_comp_asig = $result_comp_asig->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_asig["client"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_asig["toc"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_asig["tor"];

echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_asig["complaint"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_asig["action_taken"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_asig["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
}
else
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "ASIGMA";
echo  '</b></td></tr>';
echo  '<tr>';
echo  '<td colspan=7 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}


$sql_comp_isoc = "select * from asigma_lan_isoc_complaints where doe = '".$sel_dt_up."' and typ_of_complaint='ISOC'";
$result_comp_isoc = $conn->query($sql_comp_isoc);

if($result_comp_isoc->num_rows > 0)
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "CIVIL NET";
echo  '</b></td></tr>';
 $i=1;
while($row_comp_isoc = $result_comp_isoc->fetch_assoc())
{
 
 $temp++;

echo  '<td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_isoc["client"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_isoc["toc"];
echo  '</td>';
echo  '<td align=center width=5%>';
echo  $row_comp_isoc["tor"];

echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_isoc["complaint"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_comp_isoc["action_taken"];
echo  '</td>';
echo  '<td align=left width=10%>';
echo  $row_comp_isoc["remarks"];
echo  '</td>';

echo  '</tr>';
$i++;
}
}
else
{
echo  '<tr><td colspan=7 align=center width=80%><b>';
echo "CIVIL NET";
echo  '</b></td></tr>';
echo  '<tr>';
echo  '<td colspan=7 align=left><b>';
echo  'Nil';
echo  '<b></td>';

}



echo '<tr>';
echo  '<td colspan=3 align=center width=40%><b>';
echo  "Total";
echo  '</b></td>';
echo  '<td colspan=4 align=center width=40%><b>';
echo  $temp;
echo  '</b></td>';
echo  '</tr>';
echo  '</table>';



echo '<p></p>';
//----------------------------------------------Complaints-----------------------------------

//----------------------------------------------Website Status-----------------------------------
$sql_web = "select * from web_status where doe = '".$sel_dt_up."'";
$result_web = $conn->query($sql_web);

if($result_web->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "28. Website Status.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td align=center width=20%><b>';
 echo 'Fmn';
 echo '<b></td>'; 
 echo '<td align=center width=20%><b>';
 echo 'IP Address';
 echo '<b></td>'; 
 echo '<td align=center width=10%><b>';
 echo 'Status/Update';
 echo '<b></td>'; 
 echo '<td align=center width=10%><b>';
 echo 'Remarks';
 echo '<b></td></tr>';
  
 $i=1;  
 
while($row_web = $result_web->fetch_assoc())
{
 

echo  '<tr><td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_web["fmn"];
echo  '</td>';
echo  '<td align=center width=20%>';
echo  $row_web["ip_address"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_web["status"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_web["remarks"];
echo  '</td></tr>';

$checkby=$row_web["checked_by"];
$i++;
}

echo  "<td align=center valign=top colspan=5 width=10% height=100%>";
echo "Checked By:";
echo '&nbsp;';
echo  $checkby;
echo  '</td></tr>';
echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '28. Website Status.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Website Status-----------------------------------


//----------------------------------------------ISOC Update-----------------------------------
$sql_isoc_up = "select * from update_on_isoc where doe = '".$sel_dt_up."'";
$result_isoc_up = $conn->query($sql_isoc_up);

if($result_isoc_up->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "29. Updates on ISOC.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td align=center width=20%><b>';
 echo 'Types of OS';
 echo '<b></td>'; 
 echo '<td align=center width=10%><b>';
 echo 'No of  PCs';
 echo '<b></td>'; 
 echo '<td align=center width=20%><b>';
 echo 'Remarks';
 echo '<b></td></tr>';
  
 $i=1;  
 
while($row_isoc_up = $result_isoc_up->fetch_assoc())
{
 

echo  '<tr><td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_isoc_up["toos"];
echo  '</td>';
echo  '<td align=center width=20%>';
echo  $row_isoc_up["nopc"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_isoc_up["remarks"];
echo  '</td></tr>';

$i++;
}

echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '29. Updates on ISOC.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------ISOC Update-----------------------------------

//----------------------------------------------Sig Cen Update-----------------------------------
$sql_sigcen_up = "select * from sigcen_cryptocen_tfc where doe = '".$sel_dt_up."'";
$result_sigcen_up = $conn->query($sql_sigcen_up);

if($result_sigcen_up->num_rows > 0)
{
$i=1;
echo '<table width=80% border=0>';
echo '<tr>';
echo '<td align=left><b>';
 echo "30. Sig Cen/ Crypto Center Tfc.";
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';
  
  echo '<table width=80% border=1 bgcolor=white>';
echo '<tr bgcolor=lightgrey>';
echo '<td align=center width=2%><b>';
 echo 'S No';
 echo '<b></td>'; 
 echo '<td align=center width=30%><b>';
 echo 'Ccts';
 echo '<b></td>'; 
 echo '<td align=center width=10%><b>';
 echo 'In';
 echo '<b></td>'; 
  echo '<td align=center width=10%><b>';
 echo 'Out';
 echo '<b></td>'; 
 echo '<td align=center width=20%><b>';
 echo 'Remarks';
 echo '<b></td></tr>';
  
 $i=1;  
 
while($row_sigcen_up = $result_sigcen_up->fetch_assoc())
{
 

echo  '<tr><td align=center width=2%>';
echo  $i;
echo ".";
echo  '</td>';
echo  '<td align=left width=30%>';
echo  $row_sigcen_up["ccts"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sigcen_up["din"];
echo  '</td>';
echo  '<td align=center width=10%>';
echo  $row_sigcen_up["dout"];
echo  '</td>';
echo  '<td align=center width=20%>';
echo  $row_sigcen_up["remarks"];
echo  '</td></tr>';

$i++;
}

echo  '</table>';
}
else
{
echo '<table width=80% border=1>';
echo '<tr>';
echo '<td colspan=2 align=left><b>';
 echo '30. Sig Cen/ Crypto Center Tfc.';
 echo '<b></td>';   
  echo '</tr>';
echo  '<tr>';
echo  '<td colspan=2 align=left><b>';
echo  'Nil';
echo  '<b></td>';
echo  '</table>';
}

echo '<p></p>';
//----------------------------------------------Sig Cen Update-----------------------------------

?>


<?php
mysqli_close($conn);
}

?>
<?php 
/*echo "<form method='post' action='e-Comn State.php'>";
echo "<input type='hidden' name='login' value='12345''>";
echo "<h2 align=center>&nbsp;&nbsp;<input type='submit' value='Change Date' /></h2>";*/
?>
<script>javascript:window.print()</script>

<p></p>
<h2 align="center"><b> Designed and Developed by NSOC, 3 COSR </b></font></h2>
</body>
</html>
