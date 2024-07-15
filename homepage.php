<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
</head>
<body>
    <?php
    if (isset($_POST["uname"]) && isset($_POST["password"])) {
        $_SESSION["uname"] = $_POST["uname"];
        $_SESSION["password"] = $_POST["password"];
    }

    if (isset($_SESSION["uname"]) && isset($_SESSION["password"])) {
        echo "Username: " . htmlspecialchars($_SESSION["uname"]) . "<br>";
        echo "Password: " . htmlspecialchars($_SESSION["password"]) . "<br>";
    } else {
        echo "No session data found.";
    }
    ?>
    <form action="index.php" method="POST">
        <input type="submit" value="Logout" name="logout" />
    </form>
    <?php
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
//        header("Location: index.php"); // Redirect to login page after logout
        exit();
    }
    ?>
</body>
</html>
