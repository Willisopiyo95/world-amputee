<?php

// Define constants
define("RECIPIENT_NAME", "Wacafederation");
define("RECIPIENT_EMAIL", "info@wacafederation.com");

// Read the form values with case consistency and sanitization
$success = false;
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
$dateOfBirth = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : "";
$phone = isset($_POST['Phone']) ? htmlspecialchars($_POST['Phone']) : "";
$gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : "";
$country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : "";
$address = isset($_POST['Address']) ? htmlspecialchars($_POST['Address']) : "";
$event = isset($_POST['Event']) ? htmlspecialchars($_POST['Event']) : "";

// Compose email subject and body
$mail_subject = 'New Event Registration from ' . $name;
$body = "Name: $name\nDate of Birth: $dateOfBirth\nPhone: $phone\nGender: $gender\nCountry: $country\nAddress: $address\nEvent: $event\n";

// Send the email if all required fields are filled
if ($name && $phone && $event) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: no-reply@wacafederation.com";  // Use a valid email address from your domain

    $success = mail($recipient, $mail_subject, $body, $headers);

    if ($success) {
        echo "<div class='inner success'><p class='success'>Thanks for registering. We will co
