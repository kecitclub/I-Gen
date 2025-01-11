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
    // Donor Registration
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $preferences = mysqli_real_escape_string($conn, $_POST['preferences']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);

    // Validate Data
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }
    if (!preg_match('/^\d{10}$/', $contact_number)) {
        die('Contact number must be 10 digits.');
    }
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Insert into `donor` and `login` tables
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password
    $donor_query = "INSERT INTO donor (name, email, preferences, contact_number) VALUES ('$name', '$email', '$preferences', '$contact_number')";
    $login_query = "INSERT INTO login (email, password, role) VALUES ('$email', '$hashed_password', 'donor')";

    if (mysqli_query($conn, $donor_query) && mysqli_query($conn, $login_query)) {
        header("Location: homepage.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_POST['register_receiver'])) {
    // Receiver Registration
    $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
    $registration_number = mysqli_real_escape_string($conn, $_POST['registration_number']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $needs = mysqli_real_escape_string($conn, $_POST['needs']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $bank_account = mysqli_real_escape_string($conn, $_POST['bank_account']);

    // Validate Data
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }
    if (!preg_match('/^\d{10}$/', $contact_number)) {
        die('Contact number must be 10 digits.');
    }
    if (!preg_match('/^\d{8,20}$/', $bank_account)) {
        die('Bank account number must be 8-20 digits.');
    }
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Insert into `receiver` and `login` tables
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password
    $receiver_query = "INSERT INTO receiver (school_name, registration_number, location, email, needs, contact_number, bank_account) VALUES ('$school_name', '$registration_number', '$location', '$email', '$needs', '$contact_number', '$bank_account')";
    $login_query = "INSERT INTO login (email, password, role) VALUES ('$email', '$hashed_password', 'receiver')";

    if (mysqli_query($conn, $receiver_query) && mysqli_query($conn, $login_query)) {
        header("Location: home.php");
    } else {
        echo "Error: " . mysqli_error($conn);
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
</head>

<body>
    <div class="container" style="padding: 36px; background-color: white;">
        <h2>Register</h2>
        <div class="role-select">
            <label>
                <input type="radio" name="role" value="donor"> I am a Donor
            </label>
            <label>
                <input type="radio" name="role" value="receiver"> I am a Receiver
            </label>
        </div>

        <form id="donor-form" class="form-section" method="POST" action="">
            <h3>Donor Registration</h3>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Re-enter Password" required>
            <textarea name="preferences" placeholder="Your donation preferences (e.g., books, money, etc.)" required></textarea>
            <button type="submit" name="register_donor">Register as Donor</button>
        </form>

        <form id="receiver-form" class="form-section" method="POST" action="">
            <h3>Receiver Registration</h3>
            <input type="text" name="school_name" placeholder="School Name" required>
            <input type="text" name="registration_number" placeholder="School Registration Number" required>
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <input type="text" name="bank_account" placeholder="Bank Account Number" required>
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
                    donorForm.style.display = 'block';
                    receiverForm.style.display = 'none';
                } else {
                    receiverForm.style.display = 'block';
                    donorForm.style.display = 'none';
                }  
            });
        });
        
    </script>
</body>

</html>