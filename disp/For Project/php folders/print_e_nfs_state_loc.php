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
<h3 align="center"><b><u>PROGRESS OF NFS ACCESS/NLD LINKS : 3 CORPS ZONE AS ON &nbsp;<?php echo $show_dt_up; ?></u></b></h3>


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
//----------------------------------------progress of NFS link--------------------------
/*echo '<table width=100% border=0>';
echo '<tr>';
echo '<td colspan=24 align=center><b>';
 echo 'PROGRESS OF NFS ACCESS/NLD LINKS : 3 CORPS ZONE';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';*/

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey valign=top>';
echo  '<td align=center rowspan=3 width=2%><b>';
echo  "Ser No";
echo  '</b></td>';
echo  '<td align=center rowspan=3  width=3%><b>';
echo  "Type of Link";
echo  '</b></td>';
echo  '<td align=center rowspan=3 width=3%><b>';
echo  "Link ID";
echo  '</b></td>';
echo  '<td align=center rowspan=3 width=3%><b>';
echo  "From";
echo  '</b></td>';
echo  '<td align=center rowspan=3 width=3%><b>';
echo  "To";
echo  '</b></td>';
echo  '<td align=center rowspan=3 width=3%><b>';
echo  "Survey Lenght";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=4%><b>';
echo  "Work Done";
echo  '</b></td>';
echo  '<td align=center colspan=2 width=4%><b>';
echo  "AT (km)";
echo  '</b></td>';
echo  '<td align=center colspan=6 width=20%><b>';
echo  "Works Completed in last 24 hrs";
echo  '</b></td>';
echo  '<td align=center colspan=6 width=24%><b>';
echo  "OH";
echo  '</b></td>';
echo  '<td align=center rowspan=3 width=20%><b>';
echo  "Remarks";
echo  '</b></td>';
echo  '</tr>';

 echo  '<tr bgcolor=lightgrey>';
 echo  '<td align=center rowspan=2 width=2%><b>';
echo  "T & D";
echo  '</b></td>';

echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Blowing";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Depth";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Optical";
echo  '</b></td>';


echo  '<td align=center colspan=2 width=4%><b>';
echo  "Trencing (mtr)";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Total T & D Laying";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "OFC Blowing";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Muff/Poles installed";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "OH Stringing";
echo  '</b></td>';


echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Sanctioned (KM)";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Total muff/Poles Installed";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Total Distance Covered";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Total OH Stringing";
echo  '</b></td>';
echo  '<td align=center rowspan=2 width=2%><b>';
echo  "Stringing Bal";
echo  '</b></td>';
echo  '<td align=center colspan=1 width=2%><b>';
echo  "AT";
echo  '</b></td>';
echo  '</tr>';

 echo '<tr bgcolor=lightgrey>';
 
echo  '<td align=center width=2%><b>';
echo  "OT (mtr)";
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  "HDD (mtr)";
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  "Optical";
echo  '</b></td>';
echo  '</tr>';


//-----------------------------------------3 CESR-------------------------------------------------------
echo  '<tr bgcolor=white>';
echo  '<td align=left width=100% colspan=23><b><u>'; 
echo '3 CESR';
echo '</u></b></td></tr>';

$sl_a=0;
$td_a=0;
$blow_a=0;
$at_dep_a=0;
$at_optical_a=0;
$trenching_ot_a=0;
$trenching_hdd_a=0;
$ttd_laying_a=0;
$ofc_blow_a=0;
$m_p_inst_a=0;
$oh_string_a=0;
$sanctioned_a=0;
$t_m_p_inst_a=0;
$t_dist_cover_a=0;
$t_oh_string_a=0;
$string_bal_a=0;
$oh_at_optical_a=0;

$sql_hq3_nfs_link = "select * from nfs_link where fmn='3 CESR' and type_of_link='Access' and doe = '".$sel_dt_up."'";
$result_hq3_nfs_link = $conn->query($sql_hq3_nfs_link);

if($result_hq3_nfs_link->num_rows > 0)
{
$i=1;

while($row_hq3_nfs_link = $result_hq3_nfs_link->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq3_nfs_link["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_nfs_link["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_a=$sl_a+$row_hq3_nfs_link["survey_length"];
$td_a=$td_a+$row_hq3_nfs_link["wk_done_td"];
$blow_a=$blow_a+$row_hq3_nfs_link["wk_done_blowing"];
$at_dep_a=$at_dep_a+$row_hq3_nfs_link["at_depth"];
$at_optical_a=$at_optical_a+$row_hq3_nfs_link["at_optical"];
$trenching_ot_a=$trenching_ot_a+$row_hq3_nfs_link["trench_ot"];
$trenching_hdd_a=$trenching_hdd_a+$row_hq3_nfs_link["trench_hdd"];
$ttd_laying_a=$ttd_laying_a+$row_hq3_nfs_link["total_td_laying"];
$ofc_blow_a=$ofc_blow_a+$row_hq3_nfs_link["ofc_blowing"];
$m_p_inst_a=$m_p_inst_a+$row_hq3_nfs_link["muff_pole_installed"];
$oh_string_a=$oh_string_a+$row_hq3_nfs_link["oh_string"];
$sanctioned_a=$sanctioned_a+$row_hq3_nfs_link["sanctioned"];
$t_m_p_inst_a=$t_m_p_inst_a+$row_hq3_nfs_link["total_muff_pole_install"];
$t_dist_cover_a=$t_dist_cover_a+$row_hq3_nfs_link["total_distance_cover"];
$t_oh_string_a=$t_oh_string_a+$row_hq3_nfs_link["total_oh_string"];
$string_bal_a=$string_bal_a+$row_hq3_nfs_link["string_bal"];
$oh_at_optical_a=$oh_at_optical_a+$row_hq3_nfs_link["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center colspan=5><b>';
echo  "Access Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%p><b>';
echo  $sl_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_a;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_a;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '';
//echo  '<td colspan=13 align=left><b>';
//echo  'Nil';
//echo  '<b></td></tr>';
//echo  '</table>';
}



$sl_nld=0;
$td_nld=0;
$blow_nld=0;
$at_dep_nld=0;
$at_optical_nld=0;
$trenching_ot_nld=0;
$trenching_hdd_nld=0;
$ttd_laying_nld=0;
$ofc_blow_nld=0;
$m_p_inst_nld=0;
$oh_string_nld=0;
$sanctioned_nld=0;
$t_m_p_inst_nld=0;
$t_dist_cover_nld=0;
$t_oh_string_nld=0;
$string_bal_nld=0;
$oh_at_optical_nld=0;

$sql_hq3_nfs_link_nld = "select * from nfs_link where fmn='3 CESR' and type_of_link = 'NLD' and doe = '".$sel_dt_up."'";
$result_hq3_nfs_link_nld = $conn->query($sql_hq3_nfs_link_nld);

if($result_hq3_nfs_link_nld->num_rows > 0)
{
$i=1;

while($row_hq3_nfs_link_nld = $result_hq3_nfs_link_nld->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq3_nfs_link_nld["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq3_nfs_link_nld["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link_nld["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link_nld["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq3_nfs_link_nld["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq3_nfs_link_nld["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq3_nfs_link_nld["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_nld=$sl_nld+$row_hq3_nfs_link_nld["survey_length"];
$td_nld=$td_nld+$row_hq3_nfs_link_nld["wk_done_td"];
$blow_nld=$blow_nld+$row_hq3_nfs_link_nld["wk_done_blowing"];
$at_dep_nld=$at_dep_nld+$row_hq3_nfs_link_nld["at_depth"];
$at_optical_nld=$at_optical_nld+$row_hq3_nfs_link_nld["at_optical"];
$trenching_ot_nld=$trenching_ot_nld+$row_hq3_nfs_link_nld["trench_ot"];
$trenching_hdd_nld=$trenching_hdd_nld+$row_hq3_nfs_link_nld["trench_hdd"];
$ttd_laying_nld=$ttd_laying_nld+$row_hq3_nfs_link_nld["total_td_laying"];
$ofc_blow_nld=$ofc_blow_nld+$row_hq3_nfs_link_nld["ofc_blowing"];
$m_p_inst_nld=$m_p_inst_nld+$row_hq3_nfs_link_nld["muff_pole_installed"];
$oh_string_nld=$oh_string_nld+$row_hq3_nfs_link_nld["oh_string"];
$sanctioned_nld=$sanctioned_nld+$row_hq3_nfs_link_nld["sanctioned"];
$t_m_p_inst_nld=$t_m_p_inst_nld+$row_hq3_nfs_link_nld["total_muff_pole_install"];
$t_dist_cover_nld=$t_dist_cover_nld+$row_hq3_nfs_link_nld["total_distance_cover"];
$t_oh_string_nld=$t_oh_string_nld+$row_hq3_nfs_link_nld["total_oh_string"];
$string_bal_nld=$string_bal_nld+$row_hq3_nfs_link_nld["string_bal"];
$oh_at_optical_nld=$oh_at_optical_nld+$row_hq3_nfs_link_nld["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center valign=middle colspan=5><b>';
echo  "NLD Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%><b>';
echo  $sl_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_nld;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_nld;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

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
echo  '<td colspan=23 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}
//-----------------------------------------3 CESR-------------------------------------------------------

//-----------------------------------------2 MDSR-------------------------------------------------------
echo  '<tr bgcolor=white>';
echo  '<td align=left width=100% colspan=23><b><u>'; 
echo '2 MDSR';
echo '</u></b></td></tr>';

$sl_a_2d=0;
$td_a_2d=0;
$blow_a_2d=0;
$at_dep_a_2d=0;
$at_optical_a_2d=0;
$trenching_ot_a_2d=0;
$trenching_hdd_a_2d=0;
$ttd_laying_a_2d=0;
$ofc_blow_a_2d=0;
$m_p_inst_a_2d=0;
$oh_string_a_2d=0;
$sanctioned_a_2d=0;
$t_m_p_inst_a_2d=0;
$t_dist_cover_a_2d=0;
$t_oh_string_a_2d=0;
$string_bal_a_2d=0;
$oh_at_optical_a_2d=0;

$sql_hq2nfs_link = "select * from nfs_link where fmn='2 MDSR' and type_of_link='Access' and doe = '".$sel_dt_up."'";
$result_hq2nfs_link = $conn->query($sql_hq2nfs_link);

if($result_hq2nfs_link->num_rows > 0)
{
$i=1;

while($row_hq2nfs_link = $result_hq2nfs_link->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq2nfs_link["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2nfs_link["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_a_2d=$sl_a_2d+$row_hq2nfs_link["survey_length"];
$td_a_2d=$td_a_2d+$row_hq2nfs_link["wk_done_td"];
$blow_a_2d=$blow_a_2d+$row_hq2nfs_link["wk_done_blowing"];
$at_dep_a_2d=$at_dep_a_2d+$row_hq2nfs_link["at_depth"];
$at_optical_a_2d=$at_optical_a_2d+$row_hq2nfs_link["at_optical"];
$trenching_ot_a_2d=$trenching_ot_a_2d+$row_hq2nfs_link["trench_ot"];
$trenching_hdd_a_2d=$trenching_hdd_a_2d+$row_hq2nfs_link["trench_hdd"];
$ttd_laying_a_2d=$ttd_laying_a_2d+$row_hq2nfs_link["total_td_laying"];
$ofc_blow_a_2d=$ofc_blow_a_2d+$row_hq2nfs_link["ofc_blowing"];
$m_p_inst_a_2d=$m_p_inst_a_2d+$row_hq2nfs_link["muff_pole_installed"];
$oh_string_a_2d=$oh_string_a_2d+$row_hq2nfs_link["oh_string"];
$sanctioned_a_2d=$sanctioned_a_2d+$row_hq2nfs_link["sanctioned"];
$t_m_p_inst_a_2d=$t_m_p_inst_a_2d+$row_hq2nfs_link["total_muff_pole_install"];
$t_dist_cover_a_2d=$t_dist_cover_a_2d+$row_hq2nfs_link["total_distance_cover"];
$t_oh_string_a_2d=$t_oh_string_a_2d+$row_hq2nfs_link["total_oh_string"];
$string_bal_a_2d=$string_bal_a_2d+$row_hq2nfs_link["string_bal"];
$oh_at_optical_a_2d=$oh_at_optical_a_2d+$row_hq2nfs_link["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center colspan=5><b>';
echo  "Access Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%p><b>';
echo  $sl_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_a_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_a_2d;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '';
//echo  '<td colspan=13 align=left><b>';
//echo  'Nil';
//echo  '<b></td></tr>';
//echo  '</table>';
}



$sl_nld_2d=0;
$td_nld_2d=0;
$blow_nld_2d=0;
$at_dep_nld_2d=0;
$at_optical_nld_2d=0;
$trenching_ot_nld_2d=0;
$trenching_hdd_nld_2d=0;
$ttd_laying_nld_2d=0;
$ofc_blow_nld_2d=0;
$m_p_inst_nld_2d=0;
$oh_string_nld_2d=0;
$sanctioned_nld_2d=0;
$t_m_p_inst_nld_2d=0;
$t_dist_cover_nld_2d=0;
$t_oh_string_nld_2d=0;
$string_bal_nld_2d=0;
$oh_at_optical_nld_2d=0;

$sql_hq2nfs_link_nld_2d = "select * from nfs_link where fmn='2 MDSR' and type_of_link = 'NLD' and doe = '".$sel_dt_up."'";
$result_hq2nfs_link_nld_2d = $conn->query($sql_hq2nfs_link_nld_2d);

if($result_hq2nfs_link_nld_2d->num_rows > 0)
{
$i=1;

while($row_hq2nfs_link_nld_2d = $result_hq2nfs_link_nld_2d->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq2nfs_link_nld_2d["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq2nfs_link_nld_2d["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link_nld_2d["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link_nld_2d["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq2nfs_link_nld_2d["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq2nfs_link_nld_2d["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq2nfs_link_nld_2d["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_nld_2d=$sl_nld_2d+$row_hq2nfs_link_nld_2d["survey_length"];
$td_nld_2d=$td_nld_2d+$row_hq2nfs_link_nld_2d["wk_done_td"];
$blow_nld_2d=$blow_nld_2d+$row_hq2nfs_link_nld_2d["wk_done_blowing"];
$at_dep_nld_2d=$at_dep_nld_2d+$row_hq2nfs_link_nld_2d["at_depth"];
$at_optical_nld_2d=$at_optical_nld_2d+$row_hq2nfs_link_nld_2d["at_optical"];
$trenching_ot_nld_2d=$trenching_ot_nld_2d+$row_hq2nfs_link_nld_2d["trench_ot"];
$trenching_hdd_nld_2d=$trenching_hdd_nld_2d+$row_hq2nfs_link_nld_2d["trench_hdd"];
$ttd_laying_nld_2d=$ttd_laying_nld_2d+$row_hq2nfs_link_nld_2d["total_td_laying"];
$ofc_blow_nld_2d=$ofc_blow_nld_2d+$row_hq2nfs_link_nld_2d["ofc_blowing"];
$m_p_inst_nld_2d=$m_p_inst_nld_2d+$row_hq2nfs_link_nld_2d["muff_pole_installed"];
$oh_string_nld_2d=$oh_string_nld_2d+$row_hq2nfs_link_nld_2d["oh_string"];
$sanctioned_nld_2d=$sanctioned_nld_2d+$row_hq2nfs_link_nld_2d["sanctioned"];
$t_m_p_inst_nld_2d=$t_m_p_inst_nld_2d+$row_hq2nfs_link_nld_2d["total_muff_pole_install"];
$t_dist_cover_nld_2d=$t_dist_cover_nld_2d+$row_hq2nfs_link_nld_2d["total_distance_cover"];
$t_oh_string_nld_2d=$t_oh_string_nld_2d+$row_hq2nfs_link_nld_2d["total_oh_string"];
$string_bal_nld_2d=$string_bal_nld_2d+$row_hq2nfs_link_nld_2d["string_bal"];
$oh_at_optical_nld_2d=$oh_at_optical_nld_2d+$row_hq2nfs_link_nld_2d["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center valign=middle colspan=5><b>';
echo  "NLD Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%><b>';
echo  $sl_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_nld_2d;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

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
echo  '<td colspan=23 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}
//-----------------------------------------2 MDSR-------------------------------------------------------

//-----------------------------------------56 IDSR-------------------------------------------------------
echo  '<tr bgcolor=white>';
echo  '<td align=left width=100% colspan=23><b><u>'; 
echo '56 IDSR';
echo '</u></b></td></tr>';

$sl_a_56i=0;
$td_a_56i=0;
$blow_a_56i=0;
$at_dep_a_56i=0;
$at_optical_a_56i=0;
$trenching_ot_a_56i=0;
$trenching_hdd_a_56i=0;
$ttd_laying_a_56i=0;
$ofc_blow_a_56i=0;
$m_p_inst_a_56i=0;
$oh_string_a_56i=0;
$sanctioned_a_56i=0;
$t_m_p_inst_a_56i=0;
$t_dist_cover_a_56i=0;
$t_oh_string_a_56i=0;
$string_bal_a_56i=0;
$oh_at_optical_a_56i=0;

$sql_hq56nfs_link = "select * from nfs_link where fmn='56 IDSR' and type_of_link='Access' and doe = '".$sel_dt_up."'";
$result_hq56nfs_link = $conn->query($sql_hq56nfs_link);

if($result_hq56nfs_link->num_rows > 0)
{
$i=1;

while($row_hq56nfs_link = $result_hq56nfs_link->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq56nfs_link["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56nfs_link["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_a_56i=$sl_a_56i+$row_hq56nfs_link["survey_length"];
$td_a_56i=$td_a_56i+$row_hq56nfs_link["wk_done_td"];
$blow_a_56i=$blow_a_56i+$row_hq56nfs_link["wk_done_blowing"];
$at_dep_a_56i=$at_dep_a_56i+$row_hq56nfs_link["at_depth"];
$at_optical_a_56i=$at_optical_a_56i+$row_hq56nfs_link["at_optical"];
$trenching_ot_a_56i=$trenching_ot_a_56i+$row_hq56nfs_link["trench_ot"];
$trenching_hdd_a_56i=$trenching_hdd_a_56i+$row_hq56nfs_link["trench_hdd"];
$ttd_laying_a_56i=$ttd_laying_a_56i+$row_hq56nfs_link["total_td_laying"];
$ofc_blow_a_56i=$ofc_blow_a_56i+$row_hq56nfs_link["ofc_blowing"];
$m_p_inst_a_56i=$m_p_inst_a_56i+$row_hq56nfs_link["muff_pole_installed"];
$oh_string_a_56i=$oh_string_a_56i+$row_hq56nfs_link["oh_string"];
$sanctioned_a_56i=$sanctioned_a_56i+$row_hq56nfs_link["sanctioned"];
$t_m_p_inst_a_56i=$t_m_p_inst_a_56i+$row_hq56nfs_link["total_muff_pole_install"];
$t_dist_cover_a_56i=$t_dist_cover_a_56i+$row_hq56nfs_link["total_distance_cover"];
$t_oh_string_a_56i=$t_oh_string_a_56i+$row_hq56nfs_link["total_oh_string"];
$string_bal_a_56i=$string_bal_a_56i+$row_hq56nfs_link["string_bal"];
$oh_at_optical_a_56i=$oh_at_optical_a_56i+$row_hq56nfs_link["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center colspan=5><b>';
echo  "Access Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%p><b>';
echo  $sl_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_a_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_a_56i;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '';
//echo  '<td colspan=13 align=left><b>';
//echo  'Nil';
//echo  '<b></td></tr>';
//echo  '</table>';
}



$sl_nld_56i=0;
$td_nld_56i=0;
$blow_nld_56i=0;
$at_dep_nld_56i=0;
$at_optical_nld_56i=0;
$trenching_ot_nld_56i=0;
$trenching_hdd_nld_56i=0;
$ttd_laying_nld_56i=0;
$ofc_blow_nld_56i=0;
$m_p_inst_nld_56i=0;
$oh_string_nld_56i=0;
$sanctioned_nld_56i=0;
$t_m_p_inst_nld_56i=0;
$t_dist_cover_nld_56i=0;
$t_oh_string_nld_56i=0;
$string_bal_nld_56i=0;
$oh_at_optical_nld_56i=0;

$sql_hq56nfs_link_nld_56i = "select * from nfs_link where fmn='56 IDSR' and type_of_link = 'NLD' and doe = '".$sel_dt_up."'";
$result_hq56nfs_link_nld_56i = $conn->query($sql_hq56nfs_link_nld_56i);

if($result_hq56nfs_link_nld_56i->num_rows > 0)
{
$i=1;

while($row_hq56nfs_link_nld_56i = $result_hq56nfs_link_nld_56i->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq56nfs_link_nld_56i["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq56nfs_link_nld_56i["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link_nld_56i["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link_nld_56i["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq56nfs_link_nld_56i["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq56nfs_link_nld_56i["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq56nfs_link_nld_56i["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_nld_56i=$sl_nld_56i+$row_hq56nfs_link_nld_56i["survey_length"];
$td_nld_56i=$td_nld_56i+$row_hq56nfs_link_nld_56i["wk_done_td"];
$blow_nld_56i=$blow_nld_56i+$row_hq56nfs_link_nld_56i["wk_done_blowing"];
$at_dep_nld_56i=$at_dep_nld_56i+$row_hq56nfs_link_nld_56i["at_depth"];
$at_optical_nld_56i=$at_optical_nld_56i+$row_hq56nfs_link_nld_56i["at_optical"];
$trenching_ot_nld_56i=$trenching_ot_nld_56i+$row_hq56nfs_link_nld_56i["trench_ot"];
$trenching_hdd_nld_56i=$trenching_hdd_nld_56i+$row_hq56nfs_link_nld_56i["trench_hdd"];
$ttd_laying_nld_56i=$ttd_laying_nld_56i+$row_hq56nfs_link_nld_56i["total_td_laying"];
$ofc_blow_nld_56i=$ofc_blow_nld_56i+$row_hq56nfs_link_nld_56i["ofc_blowing"];
$m_p_inst_nld_56i=$m_p_inst_nld_56i+$row_hq56nfs_link_nld_56i["muff_pole_installed"];
$oh_string_nld_56i=$oh_string_nld_56i+$row_hq56nfs_link_nld_56i["oh_string"];
$sanctioned_nld_56i=$sanctioned_nld_56i+$row_hq56nfs_link_nld_56i["sanctioned"];
$t_m_p_inst_nld_56i=$t_m_p_inst_nld_56i+$row_hq56nfs_link_nld_56i["total_muff_pole_install"];
$t_dist_cover_nld_56i=$t_dist_cover_nld_56i+$row_hq56nfs_link_nld_56i["total_distance_cover"];
$t_oh_string_nld_56i=$t_oh_string_nld_56i+$row_hq56nfs_link_nld_56i["total_oh_string"];
$string_bal_nld_56i=$string_bal_nld_56i+$row_hq56nfs_link_nld_56i["string_bal"];
$oh_at_optical_nld_56i=$oh_at_optical_nld_56i+$row_hq56nfs_link_nld_56i["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center valign=middle colspan=5><b>';
echo  "NLD Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%><b>';
echo  $sl_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_nld_56i;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

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
echo  '<td colspan=23 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}
//-----------------------------------------56 IDSR-------------------------------------------------------

//-----------------------------------------57 MDSR-------------------------------------------------------
echo  '<tr bgcolor=white>';
echo  '<td align=left width=100% colspan=23><b><u>'; 
echo '57 MDSR';
echo '</u></b></td></tr>';

$sl_a_57D=0;
$td_a_57D=0;
$blow_a_57D=0;
$at_dep_a_57D=0;
$at_optical_a_57D=0;
$trenching_ot_a_57D=0;
$trenching_hdd_a_57D=0;
$ttd_laying_a_57D=0;
$ofc_blow_a_57D=0;
$m_p_inst_a_57D=0;
$oh_string_a_57D=0;
$sanctioned_a_57D=0;
$t_m_p_inst_a_57D=0;
$t_dist_cover_a_57D=0;
$t_oh_string_a_57D=0;
$string_bal_a_57D=0;
$oh_at_optical_a_57D=0;

$sql_hq57nfs_link = "select * from nfs_link where fmn='57 MDSR' and type_of_link='Access' and doe = '".$sel_dt_up."'";
$result_hq57nfs_link = $conn->query($sql_hq57nfs_link);

if($result_hq57nfs_link->num_rows > 0)
{
$i=1;

while($row_hq57nfs_link = $result_hq57nfs_link->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq57nfs_link["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq57nfs_link["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_a_57D=$sl_a_57D+$row_hq57nfs_link["survey_length"];
$td_a_57D=$td_a_57D+$row_hq57nfs_link["wk_done_td"];
$blow_a_57D=$blow_a_57D+$row_hq57nfs_link["wk_done_blowing"];
$at_dep_a_57D=$at_dep_a_57D+$row_hq57nfs_link["at_depth"];
$at_optical_a_57D=$at_optical_a_57D+$row_hq57nfs_link["at_optical"];
$trenching_ot_a_57D=$trenching_ot_a_57D+$row_hq57nfs_link["trench_ot"];
$trenching_hdd_a_57D=$trenching_hdd_a_57D+$row_hq57nfs_link["trench_hdd"];
$ttd_laying_a_57D=$ttd_laying_a_57D+$row_hq57nfs_link["total_td_laying"];
$ofc_blow_a_57D=$ofc_blow_a_57D+$row_hq57nfs_link["ofc_blowing"];
$m_p_inst_a_57D=$m_p_inst_a_57D+$row_hq57nfs_link["muff_pole_installed"];
$oh_string_a_57D=$oh_string_a_57D+$row_hq57nfs_link["oh_string"];
$sanctioned_a_57D=$sanctioned_a_57D+$row_hq57nfs_link["sanctioned"];
$t_m_p_inst_a_57D=$t_m_p_inst_a_57D+$row_hq57nfs_link["total_muff_pole_install"];
$t_dist_cover_a_57D=$t_dist_cover_a_57D+$row_hq57nfs_link["total_distance_cover"];
$t_oh_string_a_57D=$t_oh_string_a_57D+$row_hq57nfs_link["total_oh_string"];
$string_bal_a_57D=$string_bal_a_57D+$row_hq57nfs_link["string_bal"];
$oh_at_optical_a_57D=$oh_at_optical_a_57D+$row_hq57nfs_link["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center colspan=5><b>';
echo  "Access Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%p><b>';
echo  $sl_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_a_57D;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_a_57D;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

//echo  '</table>';
}

else
{

/*echo '<tr>';
echo '<td colspan=13 align=left><b>';
 echo 'HQ 3 CORPS';
 echo '<b></td>';   

  echo '</tr>';*/
echo  '';
//echo  '<td colspan=13 align=left><b>';
//echo  'Nil';
//echo  '<b></td></tr>';
//echo  '</table>';
}



$sl_nld_57d=0;
$td_nld_57d=0;
$blow_nld_57d=0;
$at_dep_nld_57d=0;
$at_optical_nld_57d=0;
$trenching_ot_nld_57d=0;
$trenching_hdd_nld_57d=0;
$ttd_laying_nld_57d=0;
$ofc_blow_nld_57d=0;
$m_p_inst_nld_57d=0;
$oh_string_nld_57d=0;
$sanctioned_nld_57d=0;
$t_m_p_inst_nld_57d=0;
$t_dist_cover_nld_57d=0;
$t_oh_string_nld_57d=0;
$string_bal_nld_57d=0;
$oh_at_optical_nld_57d=0;

$sql_hq57nfs_link_nld_57d = "select * from nfs_link where fmn='57 MDSR' and type_of_link = 'NLD' and doe = '".$sel_dt_up."'";
$result_hq57nfs_link_nld_57d = $conn->query($sql_hq57nfs_link_nld_57d);

if($result_hq57nfs_link_nld_57d->num_rows > 0)
{
$i=1;

while($row_hq57nfs_link_nld_57d = $result_hq57nfs_link_nld_57d->fetch_assoc())
{
  
echo  "<tr bgcolor='".$row_hq57nfs_link_nld_57d["up_info"]."'>";
echo  '<td align=center width=2%>';
echo  $i;
echo  '</td>';
echo  '<td align=left width=4%>';
echo  $row_hq57nfs_link_nld_57d["type_of_link"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link_nld_57d["link_id"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link_nld_57d["link_fm"];
echo  '</td>';
echo  '<td align=left width=3%>';
echo  $row_hq57nfs_link_nld_57d["link_to"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["survey_length"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["wk_done_td"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["wk_done_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["at_depth"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["at_optical"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["trench_ot"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["trench_hdd"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["total_td_laying"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["ofc_blowing"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["muff_pole_installed"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["sanctioned"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["total_muff_pole_install"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["total_distance_cover"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["total_oh_string"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["string_bal"];
echo  '</td>';
echo  '<td align=center width=2%>';
echo  $row_hq57nfs_link_nld_57d["oh_at_optical"];
echo  '</td>';
echo  '<td align=left width=20%>';
echo  $row_hq57nfs_link_nld_57d["remarks"];
echo  '</td>';
echo  '</tr>';
$sl_nld_57d=$sl_nld_57d+$row_hq57nfs_link_nld_57d["survey_length"];
$td_nld_57d=$td_nld_57d+$row_hq57nfs_link_nld_57d["wk_done_td"];
$blow_nld_57d=$blow_nld_57d+$row_hq57nfs_link_nld_57d["wk_done_blowing"];
$at_dep_nld_57d=$at_dep_nld_57d+$row_hq57nfs_link_nld_57d["at_depth"];
$at_optical_nld_57d=$at_optical_nld_57d+$row_hq57nfs_link_nld_57d["at_optical"];
$trenching_ot_nld_57d=$trenching_ot_nld_57d+$row_hq57nfs_link_nld_57d["trench_ot"];
$trenching_hdd_nld_57d=$trenching_hdd_nld_57d+$row_hq57nfs_link_nld_57d["trench_hdd"];
$ttd_laying_nld_57d=$ttd_laying_nld_57d+$row_hq57nfs_link_nld_57d["total_td_laying"];
$ofc_blow_nld_57d=$ofc_blow_nld_57d+$row_hq57nfs_link_nld_57d["ofc_blowing"];
$m_p_inst_nld_57d=$m_p_inst_nld_57d+$row_hq57nfs_link_nld_57d["muff_pole_installed"];
$oh_string_nld_57d=$oh_string_nld_57d+$row_hq57nfs_link_nld_57d["oh_string"];
$sanctioned_nld_57d=$sanctioned_nld_57d+$row_hq57nfs_link_nld_57d["sanctioned"];
$t_m_p_inst_nld_57d=$t_m_p_inst_nld_57d+$row_hq57nfs_link_nld_57d["total_muff_pole_install"];
$t_dist_cover_nld_57d=$t_dist_cover_nld_57d+$row_hq57nfs_link_nld_57d["total_distance_cover"];
$t_oh_string_nld_57d=$t_oh_string_nld_57d+$row_hq57nfs_link_nld_57d["total_oh_string"];
$string_bal_nld_57d=$string_bal_nld_57d+$row_hq57nfs_link_nld_57d["string_bal"];
$oh_at_optical_nld_57d=$oh_at_optical_nld_57d+$row_hq57nfs_link_nld_57d["oh_at_optical"];
$i++;
}
echo  '<tr bgcolor=white>';
echo  '<td align=center valign=middle colspan=5><b>';
echo  "NLD Total";
echo  '</b></b></td>';
echo  '<td align=center width=2%><b>';
echo  $sl_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $td_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $blow_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_dep_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $at_optical_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_ot_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $trenching_hdd_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ttd_laying_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $ofc_blow_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $m_p_inst_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_string_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $sanctioned_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_m_p_inst_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_dist_cover_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $t_oh_string_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $string_bal_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=2%><b>';
echo  $oh_at_optical_nld_57d;
echo  '</b></td>';
echo  '<td align=center width=20%>';
echo  "";
echo  '</b></td>';
echo  '</tr>';

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
echo  '<td colspan=23 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}
//-----------------------------------------57 MDSR-------------------------------------------------------
//----------------------------------------NFS Nodes of 3 CESR--------------------------

echo '<tr>';
echo '<td colspan=23 align=center><b>';
 echo 'NFS Nodes';
 echo '<b></td>';   
  echo '</tr>';
  echo '</table>';

echo '<table width=100% border=1>';
echo '<tr bgcolor=lightgrey>';
echo  '<td align=center width=50%><b>';
echo  "Type of Node";
echo  '</b></td>';
echo  '<td align=center width=50%><b>';
echo  "Description";
echo  '</b></td>';

echo  '</tr>';


$sql_hq3_dcn_cct = "select * from nfs_nodes where doe = '".$sel_dt_up."'";
$result_hq3_dcn_cct = $conn->query($sql_hq3_dcn_cct);

if($result_hq3_dcn_cct->num_rows > 0)
{
$i=1;
while($row_hq3_dcn_cct = $result_hq3_dcn_cct->fetch_assoc())
{
  
echo  '<tr bgcolor=white>';

echo  '<td align=left width=50% valign=top>';
echo  $row_hq3_dcn_cct["ton"];
echo  '</td>';
echo  '<td align=left width=50% valign=top>';
echo  $row_hq3_dcn_cct["disc"];
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
echo  '<td colspan=23 align=left><b>';
echo  'Nil';
echo  '<b></td></tr>';
//echo  '</table>';
}


//----------------------------------------NFS Nodes of 3 CESR--------------------------

echo  '</table>';
echo '<p></p>';


?>


<?php
mysqli_close($conn);


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
  echo '</tr>';
  echo '<tr>';
echo '<td align=center><b>';
 echo '(Sign of OIC NFS)';
 echo '<b></td>'; 
   echo '</tr>';
  echo '</table>';


?>

<script>javascript:window.print()</script>



</body>
</html>
