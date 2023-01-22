<?php
    $is_invalid = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $mysqli = require __DIR__ . "/database.php";

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();
        
        if ($user){
            if (password_verify($_POST["password"], $user["password_hash"])){
                
            session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["id"];
                
                
                
                header('Location: ../main.html');
                
                session_start();
                exit;
                
            }
        }

        $is_invalid = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <style>
            html {
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;
            height: 100hv;
        }
            form {
                display: flex;
                flex-direction: column;
            }
        
        </style>
    </head>

    <body>
            <h1>Login</h1>
            <? isset($_SESSION[‘email’]) ?>
            <?php if ($is_invalid): ?>
                <em>Invalid login</em>
            <?php endif; ?>

            
            <form method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" required id="email" name="email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"> <!-- remember email when password is inavlid -->
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
              
                <button>Login</button>
            </form>
            <h3>Have any issue? <a href="signup.html"><b>Sign up!</b></a> </h3>
    </body>
</html>