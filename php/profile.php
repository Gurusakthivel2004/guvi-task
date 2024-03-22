<?php

    $email = '';
    $username = '';
    $age = '';
    $dob = '';
    $contact = '';

    require "../assets/vendor/autoload.php";

    $conn = new mysqli("localhost", "root", "", "login");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_COOKIE['cookie'])) {
        foreach ($_COOKIE['cookie'] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            $email = $value;
        }
    }

    $check_database_query = mysqli_query($conn, "SELECT * FROM details WHERE email = '$email'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if ($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];
    }

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

    $db = $mongoClient->login;

    $collection = $db->details;

    $userData = $collection->findOne(['email' => $email]);

    if ($userData) {
        $age = $userData->age;
        $dob = $userData->dob;
        $contact = $userData->contact;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/register_style.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center text-center">
                                <div class="bg-red ml-auto w-full">
                                    <button class="btn-danger text-white p-2"
                                        style="margin-left:-90%;border-radius:15px;"><a
                                            style=" text-decoration:none;color:white;" class="text-none"
                                            href=" ../index.html">Logout</a></button>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 text-center ">

                                    <p class="text-center w-full h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">User Details</p>

                                    <div class="d-flex flex-row text-center align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <p class="form-label" id="user_name" for="form3Example1c">Your Name :
                                                <?php echo($username);?></p>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <p class="form-label" id="user_email" for="form3Example1c">Your Email :
                                                <?php echo($email);?></p>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <p class="form-label" id="user_age" for="form3Example1c">Your Age :
                                                <?php echo($age);?></p>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <p class="form-label" id="user_contact" for="form3Example1c">Your Phone
                                                Number : <?php echo($contact); ?></p>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <p class="form-label" id="user_dob" for="form3Example1c">Your DOB :
                                                <?php echo($dob); ?></p>

                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">

                                        <button class="btn-primary text-white p-2" style="border-radius:15px;">
                                            <a style=" text-decoration:none;color:white;" href="../profile.html">Update
                                                Profile</a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/profile_details.js"></script>

</html>