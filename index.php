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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $recipient_email = $_POST['email_Reset'];
        $otp = mt_rand(100000, 999999);

        $mail = new PHPMailer(true);

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create otp_table if not exists
        $createTableQuery = "CREATE TABLE IF NOT EXISTS otp_table (
        id VARCHAR(10) PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        otp INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
        $conn->exec($createTableQuery);
        
         // Check if the email exists in the Customer table
        $checkEmailQuery = "SELECT * FROM customers WHERE email = :email";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bindParam(':email', $recipient_email);
        $stmt->execute();

        // If the email exists, proceed with OTP generation
        if ($stmt->rowCount() > 0) {
          

            // Generate a custom identifier like "OT1," "OT2," etc.
            $stmt = $conn->query("SELECT MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)) as max_id FROM otp_table");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $nextId = 'OT' . ($result['max_id'] + 1);

            // Insert data into otp_table
            $insertQuery = "INSERT INTO otp_table (id, email, otp) VALUES (:id, :email, :otp)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bindParam(':id', $nextId);
            $stmt->bindParam(':email', $recipient_email);
            $stmt->bindParam(':otp', $otp);
            $stmt->execute();
            

// SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hemilghori@gmail.com';
        $mail->Password = 'nkagldxfrrntpzuz'; // Remove space at the end
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

        header("Location: OTPVerification.php");
        exit();
        }else{
            // Handle the case where the email is not found in the Customer table
            echo "<script>alert('Email is Not Register in DailyDeals.');</script>";
        }
    }
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