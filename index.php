<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form action="homepage.php" method="post">
            <h1>Login</h1>
            <label>Username:</label>
            <input type="text" name="uname" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Submit" name="submit" />
        </form>
       
    </body>
</html>
<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname="test";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>*/

