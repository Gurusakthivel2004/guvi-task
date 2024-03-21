<?php
    $email;
        if (isset($_COOKIE['cookie'])) {
        foreach ($_COOKIE['cookie'] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            $email = $value;
        }
}
        $age = $_POST['age'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $conn = new mysqli("localhost", "root", "", "login");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql = mysqli_query($conn,"UPDATE details SET age = '$age', dob = '$dob',contact = '$contact' WHERE email = '$email'");
        header("Location: homepage.php");
        exit();
?>