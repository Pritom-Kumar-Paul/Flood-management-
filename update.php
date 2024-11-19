<?php
    
    include("connect.php");
    include("functions.php");

    $title = $_SESSION['u_email'];
    $task_id = $_GET['task_id'];

    $result = mysqli_query($con, "SELECT u_id, u_first_name, u_role FROM tbl_user WHERE u_email='$title'");

    while ($row=mysqli_fetch_row($result))
    {
        $id = $row[0];
        $name=$row[1];
        $user_role = $row[2];
    }

    if($title == NULL)
        header("location: login.php");

    $error = "";
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FMS | Update Task</title>
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
                            <?php
                                if($user_role==1){?>                                 
                                    <li class="nav-item"><a class="nav-link" href="add_task.php">Add Task</a></li>
                                <?php }
                            ?>
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
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Task Management</span></h1>
                    </div>
                    <?php
                        $results = mysqli_query($con, "select * from tbl_task where t_id = '$task_id'");
                        $row = mysqli_fetch_row($results);
                    ?>


                    <div id="formDiv">
                        <form method="POST" action="updatetask.php?task_id=<?=$row[0]?>" enctype="multipart/form-data">
                            <label><strong>Task Type:</strong></label><br/>
                            
                            <label>
                                <?php if($row[1]=='1')
                                {?>
                                    <input type="checkbox" name="rescue" checked/> Rescue&nbsp;
                                <?php } else {?>
                                    <input type="checkbox" name="rescue"/> Rescue&nbsp;
                                <?php } ?>
                            </label>
                            <label>
                                <?php if($row[2]=='1')
                                {?>
                                    <input type="checkbox" name="medical" checked/> Medical&nbsp;
                                <?php } else { ?>
                                    <input type="checkbox" name="medical"/> Medical&nbsp;
                                <?php } ?>
                            </label>
                            <label>
                                <?php if($row[3]=='1')
                                {?>
                                    <input type="checkbox" name="food" checked/> Food&nbsp;
                                <?php } else { ?>
                                    <input type="checkbox" name="food"/> Food&nbsp;
                                <?php } ?>
                            </label>
                            <br/><br/>

                            <label><strong>People Need to Be Volunteered:</strong></label>
                            <textarea name="numberofpeople" style="width: 400px;"><?php echo $row[4]?></textarea><br/><br/>
                            
                            <label><strong>Address:</strong></label>
                            <textarea name="address" style="width: 400px;"><?php echo $row[5]?></textarea><br/><br/>

                            <label><strong>Contact Person:</strong></label>
                            <textarea name="contactperson" style="width: 400px;"><?php echo $row[6]?></textarea><br/><br/>


                            <label><strong>Contact Number:</strong></label>
                            <textarea name="contactnumber" style="width: 400px;"><?php echo $row[7]?></textarea><br/><br/>


                            <label><strong>Task Short Description:</strong></label>
                            <textarea name="taskdetails" style="width: 400px;"><?php echo $row[8]?></textarea><br/><br/>

                            <label for="status"><strong>Task Progress Status:</strong></label><br/>
                            <label><?php 
                                    if($row[10] == '1')
                                    { ?>
                                        <input type="radio" id="radio" name="status" value="1" checked> Pending
                                    <?php } else {?>
                                        <input type="radio" id="radio" name="status" value="1"> Pending
                                    <?php }
                            ?></label><br/>
                             <label><?php 
                                    if($row[10] == '2')
                                    { ?>
                                        <input type="radio" id="radio" name="status" value="2" checked> Assigned
                                    <?php } else {?>
                                        <input type="radio" id="radio" name="status" value="2"> Assigned
                                    <?php }
                            ?></label><br/>
                             <label><?php 
                                    if($row[10] == '3')
                                    { ?>
                                        <input type="radio" id="radio" name="status" value="3" checked> Accomplished
                                    <?php } else {?>
                                        <input type="radio" id="radio" name="status" value="3"> Accomplished
                                    <?php }
                            ?></label>
                            <br/><br/>
                            <?php
                            if($user_role==1){?>
                            <label for="assignedperson"><strong>Assigned Person:</strong></label><br/>
                                <select name="assignedperson">
                                    <?php
                                        $person_list = mysqli_query($con,"select * from tbl_user where u_role = '2'");
                                        while($row2 = mysqli_fetch_row($person_list)){?>
                                            <option  name="assignedperson" style="width: 500px;" value="<?php echo $row2[0] ?>">&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row2[1]?></option>
                                        <?php }
                                    ?>
                                </select><br/><br/>
                            <?php } ?>
                            <input type="submit" class="theButtons" name="submit"/>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-white py-1 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Group 3 2024</div></div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
