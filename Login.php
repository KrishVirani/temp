<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form </title>
    
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <h2 class="t-center">Login</h2>
        <form action="">
            <div class="inputDiv">
                <label for="name" class="username">Username</label>
                <div class="userArea">
                    <i class="fa-solid fa-user"></i><input type="text" name="name" id="name"
                                                           placeholder="Type your username" required>
                </div>
                <hr>
            </div>
            <div class="inputDiv">
                <label for="password" class="username">Password</label>
                <div class="userArea">
                    <i class="fa-solid fa-key"></i><input type="password" minlength="8" name="password" id="password"
                        placeholder="Type your password" required >
                </div>
                <hr>
            </div>

           
            <button class="btn">Login</button>
             <div class="linkRow">
                <label class="forgotPassword">Forgot password</label>
                <label class="changePassword">Change password</label>
            </div>
            <div class="formBottom">
               
                <p class="signUp">Or Sign Up using</p>
               <a href="signup.php"><p id="signUp">Sign UP</p></a>
                
            </div>
        </form>
    </div>
    <!-- Login Form using HTML and CSS by raju_webdev -->
</body>
</html>