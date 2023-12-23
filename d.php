<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect('localhost', 'root');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connection successful";

    mysqli_select_db($con, 'data-profil');

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $website = mysqli_real_escape_string($con, $_POST['website']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $query = "INSERT INTO user (name, email, phone, website, message) VALUES ('$name','$email','$phone','$website','$message')";

    if (mysqli_query($con, $query)) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . mysqli_error($con);
    }

    mysqli_close($con);
    header('location:index.php');
    exit();
}
?>
