<?php
// Define constants
define("RECIPIENT_NAME", "Wacafederation");
define("RECIPIENT_EMAIL", "info@wacafederation.com");

// Function to sanitize input data
function sanitize_input($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// Read the form values with case consistency and sanitization
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : "";
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : "";
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : "";
$subject = isset($_POST['subject']) ? sanitize_input($_POST['subject']) : "No Subject";
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : "";

// Compose email subject and body
$mail_subject = "New Contact Request from " . $name . " - " . $subject;
$body = "Name: $name\n"
    . "Email: $email\n"
    . "Phone: $phone\n"
    . "Subject: $subject\n\n"
    . "Message:\n$message";

// Validate required fields
if ($name && $email && $phone && $message) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    $success = mail($recipient, $mail_subject, $body, $headers);

    if ($success) {
        echo "<div class='inner success'><p class='success'>Thanks for contacting us! We will get back to you ASAP!</p></div>";
    } else {
        echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div>";
    }
} else {
    echo "<div class='inner error'><p class='error'>Please complete all required fields.</p></div>";
}
