<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'edumap';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register_donor'])) {
    // Donor's registration
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $preferences = mysqli_real_escape_string($conn, $_POST['preferences']);
    
    // Debugging: Print the received data
    echo "Name: $name, Email: $email, Preferences: $preferences<br>";

    // Check if passwords match
    if ($password !== $confirm_password) {
        die('Passwords do not match. Please try again.');
    }

    // Insert donor data into the 'donor' table
    $donor_query = "INSERT INTO donor (name, email, preferences) VALUES ('$name', '$email', '$preferences')";
    
    // Insert login credentials into the 'login' table (email, password)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password before storing
    $login_query = "INSERT INTO login (email, password, role) VALUES ('$email', '$hashed_password', 'donor')";

    // Debugging: Check queries
    echo "Donor Query: $donor_query<br>";
    echo "Login Query: $login_query<br>";

    if (mysqli_query($conn, $donor_query) && mysqli_query($conn, $login_query)) {
        echo "Donor registered successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);  // Outputs any database error
    }

} elseif (isset($_POST['register_receiver'])) {
    // Receiver registration
    $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $needs = mysqli_real_escape_string($conn, $_POST['needs']);

    // Debugging: Print the received data
    echo "School Name: $school_name, Location: $location, Needs: $needs<br>";

    // Check if passwords match
    if ($password !== $confirm_password) {
        die('Passwords do not match. Please try again.');
    }

    // Insert receiver data into the 'receiver' table
    $receiver_query = "INSERT INTO receiver (school_name, location, email, needs) VALUES ('$school_name', '$location', '$email', '$needs')";
    
    // Insert login credentials into the 'login' table (email, password)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password before storing
    $login_query = "INSERT INTO login (email, password, role) VALUES ('$email', '$hashed_password', 'receiver')";

    // Debugging: Check queries
    echo "Receiver Query: $receiver_query<br>";
    echo "Login Query: $login_query<br>";

    if (mysqli_query($conn, $receiver_query) && mysqli_query($conn, $login_query)) {
        echo "Receiver registered successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);  // Outputs any database error
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/register.css">
    <style>
        body {
            background-image: url('login3.jpg');
            /* Path to your image */
            background-size: cover;
            /* Scales the image to cover the entire screen */
            background-repeat: no-repeat;
            /* Prevents tiling */
            background-position: center;
            /* Centers the image */
            height: 100vh;
            /* Ensures body covers full viewport height */
            margin: 0;
            /* Removes default margin */
        }
    </style>
</head>

<body>
    <div class="container" style="padding: 36px;background-color: white;");>
        <h2>Register</h2>
        <div class="role-select">

            <label>
                <input type="radio" name="role" value="donor"> I am a Donor
            </label>
            <label>
                <input type="radio" name="role" value="receiver"> I am a Receiver
            </label>
        </div>
        <form id="donor-form" class="form-section" method="POST" action="homepage.php">
            <h3>Donor Registration</h3>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Re-enter Password" required>
            <textarea name="preferences" placeholder="Your donation preferences (e.g., books, money, etc.)" required></textarea>
            <button type="submit" name="register_donor">Register as Donor</button>
        </form>
        <form id="receiver-form" class="form-section" method="POST" action="homepage.php">
            <h3>Receiver Registration</h3>
            <input type="text" name="school_name" placeholder="School Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="email" name="email" placeholder="School Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Re-enter Password" required>
            <textarea name="needs" placeholder="Describe the needs of your school" required></textarea>
            <button type="submit" name="register_receiver">Register as Receiver</button>
        </form>

    </div>

    <script>
        const roleRadios = document.querySelectorAll('input[name="role"]');
        const donorForm = document.getElementById('donor-form');
        const receiverForm = document.getElementById('receiver-form');

        roleRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'donor') {
                    donorForm.classList.add('active');
                    receiverForm.classList.remove('active');
                } else if (radio.value === 'receiver') {
                    receiverForm.classList.add('active');
                    donorForm.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>