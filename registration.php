<?php
    
    include("connect.php");
    include("functions.php");

    if(logged_in())
    {
        header("location: homepage.php");
        exit();
    }

    $error = "";

    if(isset($_POST['submit']))
    {
        $u_first_name = $_POST['fname'];
        $u_last_name = $_POST['lname'];
        $u_email = $_POST['email'];
        $u_phone = $_POST['phone'];
        $u_occupation = $_POST['occupation'];
        $u_blood_group = $_POST['bloodgroup'];
        $u_know_swimming = isset($_POST['swimming']);
        $u_present_area = $_POST['area'];
        $u_password = $_POST['password'];
        $u_passwordConfirm = $_POST['passwordConfirm'];
        $u_role = '2';
        
        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];

        $conditions = isset($_POST['conditions']);
        

        //  PLEASE READ AND UNDERSTAND THE CONDITIONS VERY CAREFULLY.
        if(strlen($u_first_name)<3)
        {
            $error = "First name is too short!";
        }
        else if(strlen($u_last_name)<3)
        {
            $error = "Last name is too short!";
        }
        else if(!filter_var($u_email, FILTER_VALIDATE_EMAIL))
        {
            $error = "Please enter valid email address!";
        }
        else if (email_exists($u_email, $con)) 
        {
             $error = "Someone is already registered with this email";
        }
        else if(strlen($u_password)<8)
        {
            $error = "Password must be greater than 8 characters!";
        }
        else if($u_password !== $u_passwordConfirm)
        {
            $error = "Password does not match!";
        }
        else if($image == "")
        {
            $error = "Please upload your image!";
        }
        else if($imageSize > 1048576)
        {
            $error = "Image size must be less than 1MB!";
        }
        else if(!$conditions)
        {
            $error = "You must agree with the terms and conditions";
        }
        else
        {
            $password = md5($u_password);
            $imageExt = explode(".", $image);
            $imageExtension = $imageExt[1];
            
            if($imageExtension=='PNG' || $imageExtension=='png' || $imageExtension=='JPG' || $imageExtension=='jpg')
            {
                $image = rand(0, 100000).rand(0, 100000).rand(0, 100000).time().".".$imageExtension;
                if($u_know_swimming == NULL)
                    $u_know_swimming = 0;
                $insertQuery = "insert into tbl_user(
                                    u_first_name,
                                    u_last_name,
                                    u_email,
                                    u_phone,
                                    u_occupation,
                                    u_blood_group,
                                    u_know_swimming,
                                    u_present_area,
                                    u_password,
                                    u_image,
                                    u_role
                                ) values (
                                    '$u_first_name',
                                    '$u_last_name',
                                    '$u_email',
                                    '$u_phone',
                                    '$u_occupation',
                                    '$u_blood_group',
                                    '$u_know_swimming',
                                    '$u_present_area',
                                    '$password',
                                    '$image',
                                    '$u_role'
                                )";


                if(mysqli_query($con, $insertQuery))
                {
                    if(move_uploaded_file($tmp_image, "images/$image"))
                    {
                        echo "You are successfully registered!";
                    }
                    else
                    {
                        echo "Image is not uploaded";
                    }
                }
            }
            else
            {
                echo "File must be an image!";
            }
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
        <title>FMS | Registration Page</title>
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
                            <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Projects Section-->
            <section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Registration Form</span></h1>
                    </div>
                    
                    <div id="formDiv">
                        <form method="POST" action="registration.php" enctype="multipart/form-data">

                            <label>First Name</label><br/>
                            <input type="text" name="fname" class="inputFields" required /><br/><br/>
                
                            <label>Last Name</label><br/>
                            <input type="text" name="lname" class="inputFields" required /><br/><br/>
                
                            <label>Email</label><br/>
                            <input type="text" name="email" class="inputFields" required /><br/><br/>

                            <label>Phone</label><br/>
                            <input type="text" name="phone" class="inputFields" required /><br/><br/>

                            <label>Occupation</label><br/>
                            <input type="text" name="occupation" class="inputFields" required /><br/><br/>
                
                            <label>Blood Group</label><br/>
                            <input type="text" name="bloodgroup" class="inputFields" required /><br/><br/>
                            
                            <label><input type="checkbox" name="swimming"/> Know Swimming?</label><br/><br/>

                            <label>Present Area</label><br/>
                            <input type="text" name="area" class="inputFields" required /><br/><br/>

                            <label>Password</label><br/>
                            <input type="password" name="password" class="inputFields" required /><br/><br/>
                
                            <label>Re-enter Password</label><br/>
                            <input type="password" name="passwordConfirm" class="inputFields" required /><br/><br/>
                
                            <label>Image:</label><br/>
                            <input type="file" name="image" id="imageupload" ><br/><br/>
                
                            <label><input type="checkbox" name="conditions" required/> I agree with terms and conditions.</label><br/><br/>
                
                            <input type="submit" class="theButtons" name="submit"/>
                        </form>
                    </div>

                </div>
            </section>
            <!-- Call to action section-->
            <section class="py-5 bg-gradient-primary-to-secondary text-white">
                <div class="container px-5 my-1">
                    <div class="text-center">
                        <h2 class="display-3 fw-bolder mb-4">Let's build a strong community!</h2>
                        <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.php">Contact Us</a>
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
