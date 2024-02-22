<?php
// Database connection parameters
$host = "your_mysql_host";
$user = "your_mysql_user";
$password = "your_mysql_password";
$database = "your_mysql_database";


// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize and retrieve form data
$name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
$phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone']));
$website = mysqli_real_escape_string($conn, htmlspecialchars($_POST['website']));
$message = mysqli_real_escape_string($conn, htmlspecialchars($_POST['message']));

// Check if email and message are not empty
if (!empty($email) && !empty($message)) {
    // Validate the email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Insert data into the "user_data" table
        $query = "INSERT INTO user_data (name, email, phone, website, message) 
                  VALUES ('$name', '$email', '$phone', '$website', '$message')";

        if (mysqli_query($conn, $query)) {
            echo "Your message has been sent and saved to the database";
        } else {
            echo "Sorry, failed to send your message or save to the database!";
        }
    } else {
        echo "Enter a valid email address!";
    }
} else {
    echo "Email and message fields are required!";
}

// Close connection
mysqli_close($conn);

?>
