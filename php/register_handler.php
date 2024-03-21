<?php
session_start();
$error_array = [];
$data = [];

$name = strtolower($_POST['name']);
$em = $_POST['email'];
$p1 = $_POST['password1'];
$p2 = $_POST['password2'];

if (empty($name)) {
    $error_array['name'] = 'Name is required.';
}

if (empty($em)) {
    $error_array['email'] = 'Email is required.';
}

if (empty($p1)) {
    $error_array['password'] = 'Password is required.';
}

if (!empty($p1) && !empty($p2) && $p1 != $p2){
    $error_array[] = 'Your passwords do not match';
}

if (!filter_var($em, FILTER_VALIDATE_EMAIL)){
    $error_array[] = 'Invalid email format';
}

if (empty($error_array)) {
    $conn = new mysqli("localhost", "root", "", "login");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO details (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $em, $p1);

    if ($stmt->execute()) {
        $data['success'] = true;
        $data['message'] = 'Success!';
        setcookie("cookie[one]", "$em");
        header("Location: homepage.php");
        exit();
    } else {
        $error_array[] = "Error: " . $sql . "<br>" . $conn->error;
        $data['success'] = false;
        $data['errors'] = $error_array;
        echo json_encode($data);
    }

    $stmt->close();
    $conn->close();
} else {
    $data['success'] = false;
    $data['errors'] = $error_array;
    echo json_encode($data);
}
?>