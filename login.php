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
        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password', '$token', '0')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_POST["signup_full_name"] = "";
            $_POST["signup_email"] = "";
            $_POST["signup_password"] = "";
            $_POST["signup_cpassword"] = "";

            if (mail($to,$subject,$message,$headers)) {
                echo "<script>alert('Registrering vellykket Fullført');</script>";
              } else {
                echo "<script>alert('E-posten eksisterer allerede i vår database');</script>";
              }
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
    <title>login
    </title>
</head>
<body>
    <div id="error"></div>
    <form id="form" action="" method="post">
        <div>
            <p id="login_text">Logg inn</p>
            <input type="text" name="email" id="login_name" placeholder="Epost" value="<?php echo $_POST['email']; ?>" required><br>
        </div>
        <div>
        <input type="password" id="login_password" name="password" placeholder="Passord" value="<?php echo $_POST['password']; ?>" required>
        </div>
        <button type="submit" name="signin" id="login_button">Logg inn</button><br>
        <a href="register.php" id="new_user_text">Lag ny bruker</a><br>
        <a href="index.html" id="forgot_password_text">Midlertidig inlogging</a>
        <img id="moomin_img" src="img/mummi.png">
    </form>
</body>
</html>