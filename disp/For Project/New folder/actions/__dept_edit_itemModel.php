<?php

    require_once '../bootstrap.php';
    //only POST request is accepted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Sanitize POST array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //print_r($_POST);

        //trim the values
        $allocate_id = $_POST['allocate_id'];
        
        $lp_no = trim($_POST['lp_no']);
       
        
        //connect to db
        require_once '../db.php';
        $sql = " UPDATE allocate SET lp_no = '$lp_no' WHERE allocate_id = '$allocate_id'";
        $query = $conn->query($sql);
        //var_dump($query);
        //var_dump($sql);

        if($query == true)
        {
            $_SESSION['success'] = 'item updated successfully';

        }

        else
        {
            $_SESSION['error'] = 'Something went wrong while updating item';
        }

        //redirect to item home
        header('location: ../items.php');




   }
   else
   {
       //$_SESSION['error'] = 'Something went wrong while updating item';
       //header('location: ../items.php');
   }





