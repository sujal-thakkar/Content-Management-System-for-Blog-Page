<?php
    session_start();
    if(isset($_SESSION['user'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
<div class="container">
    <?php
        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat_password'];

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();
            
            if(empty($username) or empty($email) or empty($password) or empty($repeat_password)) {
                array_push($errors, "Please fill all the fields correctly");
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Please enter a valid Email");
            }
            else if(strlen($password) < 8) {
                array_push($errors, "Password must contain atleast 8 letters");
            }
            else if($password !== $repeat_password) {
                array_push($errors, "Password does not match with the original");
            }

            include("../connect.php");
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount > 0) {
                array_push($errors, "Email already exists!");
            }

            if(count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else {
                $sql = "INSERT INTO users
                        (username, email, password)
                        VALUES
                        (?, ?, ?)";

                $statement = mysqli_stmt_init($conn);
                $prepareStatement = mysqli_stmt_prepare($statement, $sql);
                
                if($prepareStatement) {
                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hash);
                    mysqli_stmt_execute($statement);
                    echo "<div class='alert alert-success'>You are registered successfully</div>";
                } else {
                    die("something went wrong");
                }
            }
        }
    ?>


    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" name="submit" value="Register">
        </div>
    </form>
    <div style="padding-top: 1rem;"><p>Already Registered? <a href="login.php">Login here!</a></p></div>
</div>
</body>

</html>