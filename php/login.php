<?php
session_start();

if (isset($_POST['name']) && isset($_POST['password'])) {
    $email = filter_var($_POST['name'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "login");
    if ($conn->connect_error) {
        die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
    }

    $stmt = $conn->prepare("SELECT * FROM details WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $check_login_query = $result->num_rows;

    if ($check_login_query == 1) {
        $row = $result->fetch_assoc();
        $username = $row['user_name'];
        $age = $row['age'];
        $dob = $row['dob'];
        $contact = $row['contact'];

        $_SESSION['username'] = $username;
        $_SESSION['age'] = $age;
        $_SESSION['dob'] = $dob;
        $_SESSION['contact'] = $contact;
        setcookie("cookie[one]", "$email");
        header('Location: homepage.php');
        echo json_encode(array("success" => true, "message" => "Login successful"));
    } else {
        echo json_encode(array("success" => false, "message" => "Invalid login"));
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Email and/or password not provided"));
}
?>