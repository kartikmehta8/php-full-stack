<?php
require_once '../bootstrap.php';
//only POST request is accepted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);

    //trim the values
    $item_id = $_POST['item_id'];
    $dept_id = $_POST['dept_id'];
     $qty_issue = $_POST['qty_issue'];

    //connect to db
    require_once '../db.php';
   // $sql = " UPDATE `item` SET `item`.`dept_id` = '" . $dept_id . "', `item`.`qty_issue` = '" . $qty_issue . "' WHERE `item`.`item_id` = '" .$item_id. "'";
    $sql = "INSERT INTO `allocate` (`item_id`, `dept_id`, `allocate_qty`, `allocate_qty_in_store`, `allocated_date`) VALUES ('" . $item_id . "',' " . $dept_id . "','" . $qty_issue . "','" . $qty_issue . "' , CURDATE())";
    $sql2 = "UPDATE item SET qty_issue = qty_issue -'$qty_issue' WHERE item_id ='$item_id'"; 
    $query = $conn->query($sql);
    $query2 = $conn->query($sql2);
    //var_dump($query);
    //var_dump($sql);

    if($query == true && $query2 == true )
    {
        $_SESSION['success'] = 'item allocated successfully';

    }

    else
    {
        $_SESSION['error'] = 'Something went wrong while allocating item';
    }

    //redirect to item home
    header('location: ../allocate.php');




}
else
{
    $_SESSION['error'] = 'Something went wrong while allocating item';
    header('location: ../allocate.php');
}



