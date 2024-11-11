<?php

// Define constants
define("RECIPIENT_NAME", "Wacafederation");
define("RECIPIENT_EMAIL", "info@wacafederation.com");

// Read the form values
$success = false;
$name = isset($_POST['name']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name']) : "";
$dateOfBirth = isset($_POST['date']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['date']) : "";
$phone = isset($_POST['Phone']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['Phone']) : "";
$gender = isset($_POST['gender']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['gender']) : "";
$country = isset($_POST['country']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['country']) : "";
$address = isset($_POST['Address']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['Address']) : "";
$event = isset($_POST['Event']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['Event']) : "";

// Compose email subject and body
$mail_subject = 'New Event Registration from ' . $name;

$body = 'Name: ' . $name . "\r\n";
$body .= 'Date of Birth: ' . $dateOfBirth . "\r\n";
$body .= 'Phone: ' . $phone . "\r\n";
$body .= 'Gender: ' . $gender . "\r\n";
$body .= 'Country: ' . $country . "\r\n";
$body .= 'Address: ' . $address . "\r\n";
$body .= 'Event: ' . $event . "\r\n";

// Send the email if all required fields are filled
if ($name && $phone && $event) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <no-reply@yourdomain.com>";
  $success = mail($recipient, $mail_subject, $body, $headers);

  if ($success) {
    echo "<div class='inner success'><p class='success'>Thanks for registering. We will contact you ASAP!</p></div>";
  } else {
    echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div>";
  }
} else {
  echo "<div class='inner error'><p class='error'>Please fill in all required fields.</p></div>";
}
