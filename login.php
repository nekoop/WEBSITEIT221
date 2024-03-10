<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("Location: index.php");
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.php">
</head>
<body>
    <div class="container">
    <?php
            if(isset($_POST["email"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
 
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
                if ($user) {
                    if(password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["users"] = $user["FirstName"];
                        header("Location: index.php");
                        die();
                    } else {  
                        echo "<div class= 'alert alert-danger'> Password does not match </div>";
                    }
                }else{
                    echo "<div class= 'alert alert-danger'> Email does not match </div>";
                }
            }
            ?>
 
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control"required placeholder="Enter your email">
                </div>
   
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                </div>
   
                <div class="form-btn">
                    <button type="submit" name="login" class="btn btn-primary">
                        Login
                        <span class="btn-icon"><i class="fas fa-download"></i></span>
                    </button>
                </div>
   
                <div class="form-footer">
                    <p>Not Registered yet? <a href="register.php">Register Here</a></p>
                </div>
            </form>
        </div>
    </body>
</html>
 