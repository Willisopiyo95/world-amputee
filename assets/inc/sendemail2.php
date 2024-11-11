<?php

// Define constants for recipient information
define("RECIPIENT_NAME", "John Doe");  // Change to the recipient's name
define("RECIPIENT_EMAIL", "info@wacafederation.com");  // Change to the recipient's email address

// Read the form values
$success = false;
$name = isset($_POST['name']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name']) : "";
$senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
$phone = isset($_POST['Phone']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['Phone']) : "";
$subject = isset($_POST['Subject']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['Subject']) : "";
$message = isset($_POST['message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message']) : "";

// Email subject and body
$mail_subject = 'A contact request from ' . $name;
$body = 'Name: ' . $name . "\r\n";
$body .= 'Email: ' . $senderEmail . "\r\n";
if ($phone) {
  $body .= 'Phone: ' . $phone . "\r\n";
}
if ($subject) {
  $body .= 'Subject: ' . $subject . "\r\n";
}
$body .= 'Message: ' . "\r\n" . $message;

// If required values exist, send the email
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
