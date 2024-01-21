<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    // Notify via email or other preferred method
    $to = "jakepmmp@gmail.com";
    $subject = "New Commission Request";
    $body = "Name: $name\n\nMessage: $message";
    $headers = "From: $name";

    mail($to, $subject, $body, $headers);

    echo "Request submitted successfully. Thank you!";
} else {
    echo "Error submitting the form.";
}
?>
