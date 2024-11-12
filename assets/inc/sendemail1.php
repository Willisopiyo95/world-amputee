<?php
// Define constants for recipient information
define("RECIPIENT_NAME", "wacafederation");
define("RECIPIENT_EMAIL", "info@wacafederation.com");

// Read the form values and sanitize them
$name = isset($_POST['name']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name']) : "";
$senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
$phone = isset($_POST['phone']) ? preg_replace("/[^\.\-0-9]/", "", $_POST['phone']) : "";
$message = isset($_POST['message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message']) : "";

// Compose email subject and body
$mail_subject = 'A contact request from ' . $name;
$body = "Name: $name\nEmail: $senderEmail\nPhone: $phone\nMessage:\n$message";

// Send the email if all required values exist
if ($name && $senderEmail && $message) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <" . $senderEmail . ">";
  $success = mail($recipient, $mail_subject, $body, $headers);

  if ($success) {
    echo "<div class='inner success'><p class='success'>Thanks for contacting us. We will get back to you ASAP!</p></div>";
  } else {
    echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div>";
  }
} else {
  echo "<div class='inner error'><p class='error'>Please complete all required fields.</p></div>";
}
