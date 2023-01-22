<?php



if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    header('Refresh: 4; signup.html');
    die("Valid email is required! <br>");
    
}

if (strlen($_POST["password"]) < 8) {
    header('Refresh: 4; signup.html');
    die("Remember! Password must be at least 8 characters <br>");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    header('Refresh: 4; signup.html');
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    header('Refresh: 4; signup.html');
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    header('Refresh: 4; signup.html');
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user ( email, password_hash)
        VALUES (?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " .$mysqli->error);
}

$stmt->bind_param("ss",
                  $_POST["email"],
                  $password_hash);
      
                  
if ($stmt->execute()) {

   header("Location: signup-success.html");
   exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>

