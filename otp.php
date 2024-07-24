<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {

   
        $recipient_email = $_POST['email_Reset'];
        $otp = mt_rand(100000, 999999);

        $mail = new PHPMailer(true);

       
// SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '22bmiit173@gmail.com';
        $mail->Password = 'oigaknydashiripd'; // Remove space at the end
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

// Sender and recipient
        $mail->setFrom('hemilghori@gmail.com', 'Hemil');
        $mail->addAddress($recipient_email);

// Email content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = 'Your OTP is: ' . $otp;
        

// Send email
        $mail->send();
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        //header("Location: OTPVerification.php");
       // exit();
        
    
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Forget Password</title>

        <!-- Font Icon -->
        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

        <!-- Main css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <div class="main">

            <!-- Sing in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title"> Password Verification</h2>
                            <form method="POST" class="register-form" id="reset-form" action="" required="">
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email_Reset" id="email" placeholder="Your Email" required=""/>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="reset-password" id="reset-password" class="form-submit" value="Generate OTP"/>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>

        </div>


        <!-- Include necessary scripts -->
        <!-- Add your script tags and include jQuery if needed -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="your_other_scripts.js"></script>

    </body>
</html>