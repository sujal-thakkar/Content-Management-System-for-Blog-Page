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
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            include("../connect.php");
            $sql = "SELECT * 
                    FROM users 
                    WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION["user"] = 'yes';
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password doesn't match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email doesn't exist</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" name="email" placeholder="Enter Email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div>
        </form>
        <div style="padding-top: 1rem;"><p>Not registered yet? <a href="registration.php">register here!</a></p></div>
    </div>

</body>

</html>