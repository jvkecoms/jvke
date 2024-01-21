<?php
require 'vendor/autoload.php';

use Discord\Webhook\Embed;
use Discord\Webhook\Content;

$webhookUrl = "https://discord.com/api/webhooks/1198641837792034857/iFzOdRiXnBIvY0hTVMJDvsT41CKo0vWdDGAxkUOJYUFgRTAupW4f5CZ0MfEDXKNWe4Gj";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $message = test_input($_POST["message"]);

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Create Discord message
        $content = new Content();
        $content->setUsername($name);
        $content->setMessage($message);
        $content->addFile($target_file);

        // Send message to Discord
        $webhook = new Webhook($webhookUrl);
        $webhook->send($content);
        echo "Request submitted successfully. Thank you!";
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
