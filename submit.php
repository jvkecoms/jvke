<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $message = test_input($_POST["message"]);

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Notify via email
        $to = "jakepmmp@gmail.com";
        $subject = "New Commission Request";
        $body = "Name: $name\n\nMessage: $message";
        $headers = "From: $name\r\n";

        // Use a more secure method like PHPMailer
        require 'PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->setFrom('jakepmmp@gmail.com', 'Art Commission');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            echo "Error sending email: " . $mail->ErrorInfo;
        } else {
            echo "Request submitted successfully. Thank you!";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Error submitting the form.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
