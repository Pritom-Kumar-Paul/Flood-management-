<?php
    
    include("connect.php");
    include("functions.php");

    $title = $_SESSION['u_email'];

    $result = mysqli_query($con, "SELECT u_id, u_first_name FROM tbl_user WHERE u_email='$title'");

    while ($row=mysqli_fetch_row($result))
    {
        $id = $row[0];
        $name=$row[1];
    }

    if($title == NULL)
        header("location: login.php");

    $error = "";

    if(isset($_POST['submit']))
    {
        $rescue = isset($_POST['rescue']);
        $medical = isset($_POST['medical']);
        $food = isset($_POST['food']);
        $numberofpeople = $_POST['numberofpeople'];
        $t_address = $_POST['t_address'];
        $contactperson = $_POST['contactperson'];
        $contactnumber = $_POST['contactnumber'];
        $description = $_POST['description'];
        $status = 1;
        
        if($rescue == NULL)
            $rescue = 0;

        if($medical == NULL)
            $medical = 0;

        if($food == NULL)
            $food = 0;
        
        try {
            $insertQuery = "INSERT INTO tbl_task (
                t_type_rescue,
                t_type_medical,
                t_type_food,
                t_number_of_people,
                t_address,
                t_contact_person,
                t_contact_person_phone_number,
                t_details,
               
                t_task_status
                

            )
            VALUES (
                '$rescue',
                '$medical',
                '$food',
                '$numberofpeople',
                '$t_address',
                '$contactperson',
                '$contactnumber',
                '$description',
                '$status'
                
            )";
            //print_r($insertQuery);
            

try {
    $result = mysqli_query($con, $insertQuery);
} catch (\Throwable $th) {
    echo ($th);
}


if (!$result) {
die('Error: ' . mysqli_error($con));
} else {
echo "Data inserted successfully.";
}

// Close the connection (optional, for good practice)
mysqli_close($con);
                                    
                                

        // if(mysqli_query($con, $insertQuery))
        // {
        //     header("location: admin_index.php");
        // }
        // else
        //     $error = "Something went wrong. Please try again!";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FMS | Add Task</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/customstyle.css">
    </head>
    <body class="d-flex flex-column h-100 bg-light">
        <div id="error" style="<?php if($error !=""){ ?> display: block; <?php } ?> "><?php echo $error ?></div>
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">Flood Management System</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><a class="nav-link" href="add_task.php">Add Task</a></li>
                            <li class="nav-item"><a class="nav-link" href="admin_index.php">Tasks</a></li>
                            <li class="nav-item"><a class="nav-link" href="volunteers.php">Volunteer List</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Projects Section-->
            <section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Add Task</span></h1>
                    </div>
                    
                    <div id="formDiv">
                        <form method="POST" action="add_task.php">

                            <label>Support Type</label><br/>
                            <label><input type="checkbox" name="rescue"/> Rescue&nbsp; </label>
                            <label><input type="checkbox" name="medical"/> Medical&nbsp;</label>
                            <label><input type="checkbox" name="food"/> Food&nbsp;</label><br/><br/>
                
                            <label>Number of people need to be supported*</label><br/>
                            <input type="text" name="numberofpeople" class="inputFieldsTask" style="width: 500px;" required /><br/><br/>
                
                            <label>Address*</label><br/>
                            <input type="text" name="t_address" class="inputFieldsTask" style="width: 500px;" required /><br/><br/>

                            <label>Contact Person*</label><br/>
                            <input type="text" name="contactperson" class="inputFieldsTask" style="width: 500px;" required /><br/><br/>

                            <label>Contact Number*</label><br/>
                            <input type="text" name="contactnumber" class="inputFieldsTask" style="width: 500px;" required /><br/><br/>
                
                            <label>Small Notes about the situation</label><br/>
                            <input type="text" name="description" class="inputFieldsTask" style="width: 500px;"/><br/><br/>

                            <input type="submit" class="theButtons" style="width: 200px" name="submit"/>
                        </form>
                    </div>
    
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-white py-1 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Muntasher Morshed 2024</div></div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
