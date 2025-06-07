<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $server_type = htmlspecialchars($_POST['server-type']);
    $message = htmlspecialchars($_POST['message']);

    // 2. Prepare email
    $to = "513thfrogs@gmail.com"; // Replace with your actual email address
    $subject = "New Server Rental Inquiry from " . $name;
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email_body = "
        <h2>New Server Rental Inquiry</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Desired Server Type:</strong> {$server_type}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    // 3. Send email
    if (mail($to, $subject, $email_body, $headers)) {
        // Email sent successfully, redirect to a success page
        header("Location: thank_you.html"); // Redirect to a different page
        exit(); // Stop script execution after redirect
    } else {
        // Email sending failed
        header("Location: error_page.html"); // Redirect to an error page
        exit();
    }
} else {
    // If someone tries to access this page directly without POSTing the form
    header("Location: index.html"); // Redirect them back to the form page
    exit();
}
?>