<?php 

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta name="description" content="">

<meta name="keywords" content="">

<meta name="author" content=" ">

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
input[type=submit]{
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: center;
    text-decoration: none;

}

input[type=submit]:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
     /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
#qrSucc
{
  width: 90%;
  margin:  auto;
  text-align: center;
}
#qrSucc a
{
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: center;
    text-decoration: none;
}
</style>
</head>
<body>
    <?php 
	if (!empty($_POST['item_id'])){
    $item_id=$_POST['item_id'];
    $cont =  $_POST['item_name'];
    $item_cat=$_POST['item_cat'];
	$cost_per=$_POST['cost_per'];
    $bill_no=$_POST['bill_id'];
    $item_detail=$_POST['item_detail'];
    $date_purchase=$_POST['date_purchase'];
    $vendor=$_POST['vendor'];
    $issue_to=$_POST['issue_to'];
    }
	else{
	$item_id="";
    $cont= "";
    $item_cat="";
	$cost_per="";
    $bill_no="";
    $item_detail="";
    $date_purchase="";
    $vendor="";
    $issue_to="";
	}
    

$data = 'ITEM ID : ' . $item_id. PHP_EOL
	.'ITEM NAME : ' . $cont. PHP_EOL
    . 'ITEM CATEGORY :' . $item_cat. PHP_EOL
	. 'Cost/Unit :' . $cost_per. PHP_EOL
    . 'QLP No :' . $item_detail. PHP_EOL
    . 'CIV No :' . $bill_no. PHP_EOL
    . 'PURCHASE DATE :' . $date_purchase. PHP_EOL
     . 'VENDOR :' . $vendor. PHP_EOL
      . 'ITEM IN :' . $issue_to ;




    
    
  include "meRaviQr/qrlib.php";
  include "config.php";
  if(isset($_POST['create']))
  {
    $qc =  $_POST['qrContent'];
    $qrUname = $_POST['qrUname'];
   
    if($qc=="" && $qrUname=="")
    {
      echo "<script>alert('DATA NOT AVAILABLE ');</script>";
    }
    elseif($qc=="")
    {
      echo "<script>alert('DATA NOT AVAILABLE');</script>";
    }
    elseif($qrUname=="")
    {
      echo "<script>alert('DATA NOT AVAILABLE');</script>";
    }
    else
    {
    $dev = "";
    $final = $qc;
    $qrs = QRcode::png($final,"userQr/$qrUname.png","H","3","3");
    $qrimage = $qrUname.".png";
    $workDir = $_SERVER['HTTP_HOST'];
    $qrlink = $workDir."/stock/lib/qr/userQr/".$qrUname.".png";
    $insQr = $meravi->insertQr($qrUname,$final,$qrimage,$qrlink);
    if($insQr==true)
    {
      echo "<script>alert(' Success Create Your QR Code'); window.location='index.php?success=$qrimage';</script>";

    }
    else
    {
      echo "<script>alert('cant create QR Code');</script>";
    }
  }
 }
  ?>
  <?php 
  if(isset($_GET['success']))
  {
  ?>
  <div id="qrSucc">
  <div class="modal-content animate container">
    <?php 
    ?>
 
    <img src="userQr/<?php echo $_GET['success']; ?>" alt="">
    <?php 
$workDir = $_SERVER['HTTP_HOST'];
    $qrlink = $workDir."/stock/lib/qr/userQr/".$_GET['success'];
    
    ?>
     
    <input type="text" value="<?php echo $qrlink; ?>" readonly>
    <br><br>
<a href="download.php?download=<?php echo $_GET['success']; ?>">Save Image</a>
<br>
 <br><br>
    <a href="http://localhost/stock/items.php">Go Back </a>
   
    
     </div></div>
  <?php
}
else
{
  ?>
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post" enctype="multipart/form-data">
    <div class="container">
      <h2 align="center"></h2>
      <label for="uname"><b>Item ID</b></label>
      <input type="text" name="qrUname" value="<?php echo $cont.$item_id?>">

      <label for="psw"><b> Item Details</b></label>
      <textarea rows="10" name="qrContent" value=""><?php echo $data; ?></textarea>
        
      <input type="submit" value="Generate" name="create">
    
    </div>
  </form>
    <?php 
}
   ?>
</div>

</body>
</html>
