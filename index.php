<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
        }
        .container h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 1em;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5em;
        }
        .form-group input {
            width: 100%;
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 1em;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Welcome</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

                if (empty($username)) {
                    echo '<div class="message">Please enter a username.</div>';
                } elseif (empty($password)) {
                    echo '<div class="message">Please enter a password.</div>';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<div class="message" style="color: green;">You are now registered.</div>';
                    } else {
                        echo '<div class="message">Error: ' . mysqli_error($conn) . '</div>';
                    }
                }
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
