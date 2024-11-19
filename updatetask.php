<?php
    include "connect.php";
    
    $task_id = $_GET['task_id'];
    if(isset($_POST['submit']))
    {
        $rescue = isset($_POST['rescue']);
        $medical = isset($_POST['medical']);
        $food = isset($_POST['food']);
        $numberofpeople = $_POST['numberofpeople'];
        $address = $_POST['address'];
        $contactperson = $_POST['contactperson'];
        $contactnumber = $_POST['contactnumber'];
        $description = $_POST['taskdetails'];
        $status = $_POST['status'];
        $assignedperson = $_POST['assignedperson'];

        if($rescue == NULL)
            $rescue = 0;

        if($medical == NULL)
            $medical = 0;

        if($food == NULL)
            $food = 0;

        $updateQuery = "update tbl_task set 
                                        t_type_rescue = '$rescue',
                                        t_type_medical = '$medical',
                                        t_type_food = '$food',
                                        t_number_of_people = '$numberofpeople',
                                        t_address = '$address',
                                        t_contact_person = '$contactperson',
                                        t_contact_person_phone_number = '$contactnumber',
                                        t_details = '$description',
                                        t_task_assigned_person = '$assignedperson',
                                        t_task_status = '$status'
                                where
                                    t_id = '$task_id'
                                    ";

        if(mysqli_query($con, $updateQuery))
        {
           header("location: admin_index.php");
        }
        else
            $error = "Something went wrong. Please try again!";
    }
?>