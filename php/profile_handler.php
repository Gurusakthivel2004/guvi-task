<?php
session_start();

$email = '';

if (isset($_COOKIE['cookie'])) {
    foreach ($_COOKIE['cookie'] as $name => $value) {
        $name = htmlspecialchars($name);
        $value = htmlspecialchars($value);
        $email = $value;
    }
}

class UserData {
    public $age;
    public $dob;
    public $email;
    public $contact;
}

require "../assets/vendor/autoload.php";

if (isset($_POST['age']) && isset($_POST['dob']) && isset($_POST['contact'])) {
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];


    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

    $collection = $mongoClient->login->details;

    $userData = $collection->findOne(['email' => $email]);

    if (!$userData) {
        $userData = new UserData();
        $userData->age = $age;
        $userData->dob = $dob;
        $userData->email = $email;
        $userData->contact = $contact;

        $insertResult = $collection->insertOne((array)$userData);

        if ($insertResult->getInsertedCount() > 0) {
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error: Failed to insert document";
        }
    } else {
        $updateResult = $collection->updateOne(
            ['email' => $email],
            ['$set' => ['age' => $age, 'dob' => $dob, 'contact' => $contact]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error: Failed to update document";
        }
    }
} else {
    echo "Error: Age, dob, or contact not provided";
}
?>