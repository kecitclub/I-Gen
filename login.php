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
    // Validate inputs
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to check if user exists
        $query = "SELECT * FROM login WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password']; // Hashed password in the database
            $role = $row['role']; // Role of the user (donor/receiver)

            // Verify the password
            if (password_verify($password, $stored_password)) {
                // Start a session and set session variables
                session_start();
                $_SESSION['username'] = $email;
                $_SESSION['role'] = $role;

                // Redirect based on user role
                header("Location: home.php");
                exit;
            } else {
                echo "<script>alert('Incorrect password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with this email.');</script>";
        }
    } else {
        echo "<script>alert('Both fields are required.');</script>";
    }
}

// Close the connection
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

<body style="background-color: #e4e6ea;">
    <div class="login-container" style="padding: 30px;">
        <form action="" method="POST" class="login-form">
            <h2>LOGIN</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <br><br>

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

            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <button style="padding: 5px 10px; font-size: 16px;">
                    <a href="register.php" style="text-decoration: none; color: inherit;">Don't have an account? Click here.</a>
                </button>
            </div>
        </form>
    </div>
    <div>
        <?
    </div>
</body>

</html>
