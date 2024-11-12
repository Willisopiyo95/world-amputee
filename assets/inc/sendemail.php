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
$date = isset($_POST['date']) ? sanitize_input($_POST['date']) : "";
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : "";
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : "";
$gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : "";
$country = isset($_POST['country']) ? sanitize_input($_POST['country']) : "";
$address = isset($_POST['address']) ? sanitize_input($_POST['address']) : "";
$event = isset($_POST['event']) ? sanitize_input($_POST['event']) : "";

// Compose email subject and body
$mail_subject = "New Event Registration from " . $name;
$body = "Name: $name\n"
  . "Date of Birth: $date\n"
  . "Email: $email\n"
  . "Phone: $phone\n"
  . "Gender: $gender\n"
  . "Country: $country\n"
  . "Address: $address\n"
  . "Event: $event\n";

// Validate required fields
if ($name && $date && $email && $phone && $gender && $country && $address && $event) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: no-reply@wacafederation.com\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  $success = mail($recipient, $mail_subject, $body, $headers);

  if ($success) {
    echo "<div class='inner success'><p class='success'>Thanks for registering! We will get back to you ASAP!</p></div>";
  } else {
    echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div>";
  }
} else {
  echo "<div class='inner error'><p class='error'>Please complete all required fields.</p></div>";
}
