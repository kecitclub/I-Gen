<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'edumap';

// Establish connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists in the login table
    $query = "SELECT * FROM login WHERE email = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password']; // Hashed password in the database
        $role = $row['role']; // Role of the user (donor/receiver)

        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Start a session and set session variables
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Redirect based on user role
            if ($role === 'donor') {
                header("Location: donor_dashboard.php");
            } elseif ($role === 'receiver') {
                header("Location: receiver_dashboard.php");
            }
            exit;
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "No account found with this email.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">

</head>

<body style="background-image: url('login3.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- login box -->
    <div class="login-container" style="padding: 30px;">
        <form action="login.php" method="POST" class="login-form">
            <h2>LOGIN</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <br> <br>

            <!-- login with google -->
            <script src="https://accounts.google.com/gsi/client" async></script>
            <div id="g_id_onload"
                data-client_id="YOUR_GOOGLE_CLIENT_ID"
                data-login_uri="https://your.domain/your_login_endpoint"
                data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                data-type="standard"
                data-size="large"
                data-theme="outline"
                data-text="sign_in_with"
                data-shape="rectangular"
                data-logo_alignment="left">
            </div>

        </form>
    </div>
</body>

</html>