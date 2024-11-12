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
$first_name = isset($_POST['first_name']) ? sanitize_input($_POST['first_name']) : "";
$last_name = isset($_POST['last_name']) ? sanitize_input($_POST['last_name']) : "";
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : "";
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : "";
$address = isset($_POST['address']) ? sanitize_input($_POST['address']) : "";
$country = isset($_POST['country']) ? sanitize_input($_POST['country']) : "";
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : "";

// Compose email subject and body
$mail_subject = "New Contact Request from $first_name $last_name";
$body = "First Name: $first_name\n"
    . "Last Name: $last_name\n"
    . "Email: $email\n"
    . "Phone: $phone\n"
    . "Address: $address\n"
    . "Country: $country\n\n"
    . "Message:\n$message";

// Validate required fields
if ($first_name && $last_name && $email && $phone && $address && $country && $message) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: $first_name $last_name <$email>\r\n";
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
