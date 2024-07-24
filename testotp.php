<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home page</title>
    </head>
    <body>
        <?php
        // put your code here
//            $name=$_POST["name"];
//            $email=$_POST["email"];
//            echo "Welcome $name <br>";
//            echo "your email id is $email";
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        
        
        require 'C:\XAMPP\htdocs\PhpProject1\phpmailer\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
        require 'C:\XAMPP\htdocs\PhpProject1\phpmailer\PHPMailer-master\PHPMailer-master\src\Exception.php';
        require 'C:\XAMPP\htdocs\PhpProject1\phpmailer\PHPMailer-master\PHPMailer-master\src\SMTP.php';
        
       
            $mail=new PHPMailer(true);
            
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='22bmiit173@gmail.com';
            $mail->Password='gqlypafqnsxkqizb';
            $mail->SMTPSecure='ss1';
            $mail->Port=587;
            $mail->setFrom('22bmiit173@gmail.com');
            $mail->addAddress('22bmiit173@gmail.com'); //user address
            $mail->isHTML(true);
            $mail->Subject='OTP Transfer';
            $mail->Body='Hello World';
            
            $mail->send();
            echo 'sent successfully !!';
        
        ?>
    </body>
</html>