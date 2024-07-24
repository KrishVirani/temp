<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        session_start();
        ?>
        <meta charset="UTF-8">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
              integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div class="container">
            <h2 class="t-center">Sign Up</h2>
            <form action="" method="post">
                <div class="inputRow">
                    <div class="inputDiv">
                        <label for="firstname" class="username">First Name</label>
                        <div class="userArea">
                            <i class="fa-solid fa-user"></i><input type="text" name="txtfirstname" id="firstname" placeholder="Type your first name" 
                                                                   <?php if (isset($_POST['txtfirstname'])) echo 'value="' . htmlspecialchars($_POST['txtfirstname']) . '"'; ?> required>
                        </div>
                        <hr>
                    </div>

                    <div class="inputDiv">
                        <label for="lastname" class="username">Last Name</label>
                        <div class="userArea">
                            <i class="fa-solid fa-user"></i><input type="text" name="txtlastname" id="lastname" placeholder="Type your last name" 
                                                                   <?php if (isset($_POST['txtlastname'])) echo 'value="' . htmlspecialchars($_POST['txtlastname']) . '"'; ?> required>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="inputRow">
                    <div class="inputDiv">
                        <label for="MobileNo" class="username">Mobile No</label>
                        <div class="userArea">
                            <i class="fa-solid fa-user"></i><input type="tel" name="txtMobileNo" id="MobileNo" placeholder="Type your Mobile No" pattern="[0-9]{10}" maxlength="10" 
                                                                   <?php if (isset($_POST['txtMobileNo'])) echo 'value="' . htmlspecialchars($_POST['txtMobileNo']) . '"'; ?> required>
                        </div>
                        <hr>
                    </div>

                    <div class="inputDiv">
                        <label for="dob" class="username">Date of Birth</label>
                        <div class="userArea">
                            <i class="fa-solid fa-calendar"></i><input class="adob" type="date" name="dob" id="dob"
                                                                       <?php if (isset($_POST['dob'])) echo 'value="' . htmlspecialchars($_POST['dob']) . '"'; ?>required>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="inputRow">
                    <div class="inputDiv">
                        <label for="email" class="username">Email Address</label>
                        <div class="userArea">
                            <i class="fa-solid fa-envelope"></i><input type="email" name="txtemail" id="email" placeholder="Type your Email Address"
                                                                       <?php if (isset($_POST['txtemail'])) echo 'value="' . htmlspecialchars($_POST['txtemail']) . '"'; ?> required>
                            <button type="submit" name="btnsend" class="SOTP" style="float: right;">Send OTP</button>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="inputRow">
                    <div class="inputDiv">
                        <label for="otp" class="username">Enter OTP</label>
                        <div class="userArea">
                            <i class="fa-solid fa-key"></i><input type="tel" name="otp" id="otp" placeholder="Type OTP Sent to your Email" pattern="[0-9]{6}" maxlength="6"
                                                                  <?php if (isset($_POST['otp'])) echo 'value="' . htmlspecialchars($_POST['otp']) . '"'; ?> >
                            <button type="submit" name="btnvarify" class="VOTP">VERIFY</button>
                            <button type="submit" name="btnResend" class="ROTP">Resend OTP</button>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="inputRow">
                    <div class="inputDiv">
                        <label for="password" class="username">Password</label>
                        <div class="userArea">
                            <i class="fa-solid fa-key"></i><input type="password" name="txtpassword" id="password" placeholder="Type your password"
                                                                  <?php if (isset($_POST['txtpassword'])) echo 'value="' . htmlspecialchars($_POST['txtpassword']) . '"'; ?> >
                        </div>
                        <hr>
                    </div>
                    <div class="inputDiv">
                        <label for="confirm_password" class="username">Confirm Password</label>
                        <div class="userArea">
                            <i class="fa-solid fa-key"></i><input type="password" name="txtconfirm_password" id="confirm_password" placeholder="Type your password"
                                                                  <?php if (isset($_POST['txtconfirm_password'])) echo 'value="' . htmlspecialchars($_POST['txtconfirm_password']) . '"'; ?> >
                        </div>
                        <hr>
                    </div>
                </div>
                <button class="btn" name="btnsignup">Sign Up</button>

                <div class="formBottom">
                    <p class="signUp">Or Login using</p>
                    <a href="Login.php"><p id="signUp">Login</p></a>
                </div>
            </form>
        </div>

        <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

// Check if session is not already started before calling session_start()
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['btnsend'])) {
                sendOTP();
            } elseif (isset($_POST['btnvarify'])) {
                verifyOTP();
            } elseif (isset($_POST['btnResend'])) {
                resendOTP();
            }
        }

        function sendOTP() {
            if (isset($_POST['txtemail'])) {
                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\PHPMailer.php';
                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\Exception.php';
                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\SMTP.php';

                try {
                    $recipient_email = $_POST['txtemail'];
                    $otp = mt_rand(100000, 999999);

                    $mail = new PHPMailer(true);

                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'hemilghori@gmail.com';
                    $mail->Password = 'nkagldxfrrntpzuz';
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

                    // Store OTP in session for verification
                    $_SESSION['otp'] = $otp;
                    $_SESSION['email'] = $recipient_email;

                    echo '<script>alert("OTP sent successfully");</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
                }
            }
        }

        function verifyOTP() {
            if (isset($_POST['otp'])) {
                $enteredOTP = $_POST['otp'];
                $storedOTP = $_SESSION['otp'];
                $email = $_SESSION['email'];

                if ($enteredOTP == $storedOTP) {
                    // OTP verification successful
                    echo '<script>alert("OTP verification successful for email: ' . $email . '");</script>';
                    $_SESSION['verifystatus'] = 1; // Store status in session
                } else {
                    // OTP verification failed
                    echo '<script>alert("OTP verification failed. Please try again.");</script>';
                    $_SESSION['verifystatus'] = 0; // Store status in session
                }
            }
        }

        function resendOTP() {
            if (isset($_SESSION['email'])) {
                $recipient_email = $_SESSION['email'];
                $otp = mt_rand(100000, 999999);

                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\PHPMailer.php';
                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\Exception.php';
                require 'C:\xampp\htdocs\Practice\PHPMailer-master\src\SMTP.php';

                try {
                    $mail = new PHPMailer(true);

                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'hemilghori@gmail.com';
                    $mail->Password = 'nkagldxfrrntpzuz';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Sender and recipient
                    $mail->setFrom('hemilghori@gmail.com', 'Hemil');
                    $mail->addAddress($recipient_email);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Email Varification OTP';
                    //$mail->Body = 'Your OTP is: ' . $otp;
                    $mail->Body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .header {
                background-color: #004f9f;
                color: #ffffff;
                padding: 10px;
                text-align: center;
            }
            .content {
                margin-top: 20px;
                text-align: center;
            }
            .footer {
                background-color: #f4f4f4;
                color: #666666;
                padding: 10px;
                text-align: center;
                font-size: 12px;
                border-top: 1px solid #ddd;
            }
            .otp-code {
                font-size: 24px;
                font-weight: bold;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>E-Auction System</h1>
            </div>
            <div class="content">
                <p>Dear User,</p>
                <p>Your One-Time Password (OTP) for email verification is:</p>
                <div class="otp-code">' . $otp . '</div>
                <p>Please use this OTP to verify your email address.</p>
                <p>If you did not request this OTP, please ignore this email.</p>
            </div>
            <div class="footer">
                <p>© 2024 E-Auction System. All rights reserved.</p>
                <p><a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a></p>
            </div>
        </div>
    </body>
    </html>
    ';

                    // Send email
                    $mail->send();

                    // Update the session with new OTP
                    $_SESSION['otp'] = $otp;

                    echo '<script>alert("OTP resent successfully to ' . $recipient_email . '");</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
                }
            } else {
                echo '<script>alert("No email address found in session.");</script>';
            }
        }

        if (isset($_POST['btnsignup'])) {
            if (isset($_POST['txtpassword']) && isset($_POST['txtconfirm_password'])) {
                $password = $_POST['txtpassword'];
                $confirmPassword = $_POST['txtconfirm_password'];
                $dob = $_POST['dob'];
                $passstatus = 0;
                $dobstatus = 0;

                // Debugging messages
                echo '<script>console.log("Checking passwords");</script>';

                if ($password !== $confirmPassword) {
                    echo '<script>alert("Passwords do not match. Please try again.");</script>';
                } else if ($password == null and $confirmPassword == null) {
                    echo '<script>alert("Password not valid.");</script>';
                } else {
                    $passstatus = 1;
                    echo '<script>console.log("Passwords match.");</script>';
                }

                $dobDate = new DateTime($dob);
                $now = new DateTime();
                $age = $now->diff($dobDate)->y;

                // Debugging messages
                echo '<script>console.log("Checking age");</script>';

                if ($age < 18) {
                    echo '<script>alert("You must be at least 18 years old to sign up.");</script>';
                } else {
                    $dobstatus = 1;
                    echo '<script>console.log("Age valid.");</script>';
                }

                // Debugging messages
                echo '<script>console.log("Checking verification status");</script>';

                if ($dobstatus == 1 && $passstatus == 1 && isset($_SESSION['verifystatus']) && $_SESSION['verifystatus'] == 1) {
                    echo '<script>alert("Welcome to home page");</script>';
                    session_abort();
                } else if (isset($_SESSION['verifystatus']) && $_SESSION['verifystatus'] == 0) {
                    echo '<script>alert("First complete email verification.");</script>';
                } else if ($dobstatus == 0) {
                    echo '<script>alert("You must be at least 18 years old to sign up.");</script>';
                } else if ($passstatus == 0) {
                    echo '<script>alert("Password not valid.");</script>';
                }
            }
        }
        ?>

    </body>

</html>
