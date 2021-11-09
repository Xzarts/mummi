<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));

    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

    if ($password !== $cpassword) {
        echo "<script>alert('Passord stemte ikke');</script>";
    }
    elseif ($check_email > 0) {
        echo "<script>alert('Epost eksisterer fra før av');</script>";
    }
    else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_POST["signup_full_name"] = "";
            $_POST["signup_email"] = "";
            $_POST["signup_password"] = "";
            $_POST["signup_cpassword"] = "";
            echo "<script>alert('Registrering fullført');</script>";
        }
        else {
            echo "<script>alert('Registrering mislykket');</script>";
        }
    }
}

if (isset($_POST["signin"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

    $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND password='$password'");

    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
    
    if (mysqli_num_rows($check_email) > 0) {
        $row = mysqli_fetch_assoc($check_email);
        $_SESSION["user_id"] = $row['id'];
        header("Location: index.php");
    }

    else {
        echo "<script>alert('Feil inlogging info. Prøv igjen');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" typ="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <title>registrer
    </title>
</head>
<body>
    <div id="error"></div>
    <form id="form_register" action="" method="post">
        <div>
            <p id="login_text">Registrer</p>
            <input type="text" name="signup_full_name" id="register_name" placeholder="Navn" value="<?php echo $_POST["signup_full_name"] ?>" required>
        </div><br>
        <div>
        <input type="email" name="signup_email" id="register_email" placeholder="Epost" value="<?php echo $_POST["signup_email"] ?>" required>
        </div><br>
        <div>
            <input type="password" name="signup_password" id="register_password" placeholder="Passord" value="<?php echo $_POST["signup_password"] ?>" required>
        </div><br>  
        <div>
            <input type="password" name="signup_cpassword" id="register_password" placeholder="Passord igjen" value="<?php echo $_POST["signup_cpassword"] ?>" required>
        </div><br>  
        <a href="login.php" id="new_user_text">Har allerede bruker</a><br>
        <button type="submit" name="submit" id="login_button">Register</button><br>
        <img id="moomin_img" src="img/mummi.png">
    </form>
</body>
</html>