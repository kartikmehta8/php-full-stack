<?php
require_once '../bootstrap.php';
//only POST request is accepted
$item_current_dept_id = $_SESSION['dept_id'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);

    //trim the values
    $allocate_id = $_POST['allocate_id'];
    $dept_qty_issue = $_POST['dept_qty_issue'];
     $dept_issue_to = $_POST['dept_issue_to'];
     $item_id=$_POST['item_id'];

    //connect to db
    require_once '../db.php';
    $sql = "INSERT INTO `dept_issue` (`item_id`, `allocate_id`,`dept_qty_issue`, `dept_issue_to`, `dept_id`, `dept_allocated_date`) VALUES ('" . $item_id . "',' " . $allocate_id . "','" . $dept_qty_issue . "','" . $dept_issue_to . "','" . $item_current_dept_id . "'  , CURDATE())";
    $sql2 = "UPDATE allocate SET allocate_qty_in_store = allocate_qty_in_store -'$dept_qty_issue' WHERE allocate_id ='$allocate_id'"; 
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
    header('location: ../items.php');




}
else
{
    $_SESSION['error'] = 'Something went wrong while allocating item';
    header('location: ../items.php');
}



