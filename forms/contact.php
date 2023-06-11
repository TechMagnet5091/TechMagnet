<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  // Validate inputs (you can add more validation if needed)
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "All fields are required.";
    exit;
  }

  // Set recipient email address
  $recipient = "pycoder122@gmail.com";

  // Set up email headers
  $headers = "From: $name <$email>" . "\r\n";
  $headers .= "Reply-To: $email" . "\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

  // Build the email content
  $emailContent = "Name: $name\n";
  $emailContent .= "Email: $email\n\n";
  $emailContent .= "Subject: $subject\n";
  $emailContent .= "Message:\n$message";

  // Attempt to send the email
  if (mail($recipient, $subject, $emailContent, $headers)) {
    http_response_code(200);
    echo "Your message has been sent. Thank you!";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }
} else {
  // Return an error if accessed directly
  http_response_code(403);
  echo "Forbidden";
}
?>
