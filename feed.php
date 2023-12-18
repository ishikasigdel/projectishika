<?php
include_once 'dbConnection.php';
$ref = @$_GET['q'];
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$id = uniqid();
$date = date("Y-m-d");
$time = date("h:i:sa");
$feedback = $_POST['feedback'];

$q = mysqli_query($con, "INSERT INTO feedback VALUES ('$id', '$name', '$email', '$subject', '$feedback', '$date', '$time')") or die ("Error");

$to = "ishikasigdel1818@gmail.com";
$subject = "New Feedback Received: $subject";
$message = "Hello,

You have received new feedback from a user of your platform. Here are the details:

Name: $name
Email: $email
Subject: $subject
Date: $date
Time: $time

Feedback:
$feedback

Thank you for providing a platform that encourages user engagement and feedback. Your dedication to improving the user experience is appreciated.

Best regards,
[quiz test center]
[student feedback]
[+9779805449777]";

$headers = "From: $email";

$mail_sent = mail($to, $subject, $message, $headers);

if ($mail_sent) {
    echo "mail send successfully";
    header("location:$ref?q=Thank you for your valuable feedback. An email notification has been sent.");
} else {
    header("location:$ref?q=Thank you for your valuable feedback. There was an issue sending the email notification.");
   
}
?>
