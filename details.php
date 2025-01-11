<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'edumap');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if registration number is provided
if (isset($_GET['reg_no'])) {
    $registration_number = mysqli_real_escape_string($conn, $_GET['reg_no']);

    // Fetch school data by registration number
    $sql = "SELECT school_name, registration_number, location, email, needs, contact_number, bank_account FROM receiver WHERE registration_number = '$registration_number'";
    $result = mysqli_query($conn, $sql);

    // Check if data exists
    if ($result && mysqli_num_rows($result) > 0) {
        $school = mysqli_fetch_assoc($result);
    } else {
        die("School not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($school['school_name']); ?> - Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #4CAF50;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo a {
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .container {
            padding: 2rem;
        }

        .details-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 2rem auto;
        }

        .details-card h1 {
            margin: 0 0 1rem;
            font-size: 2rem;
            color: #333;
        }

        .details-card p {
            margin: 0.5rem 0;
            color: #555;
        }

        .details-card p span {
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            color: #4CAF50;
            font-size: 1rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }
       .center-container {
        display: flex; /* Enable Flexbox */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 15vh; /* Make the container take full viewport height */
    }

    .redirect-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .redirect-button:hover {
        background-color: #45a049;
    }

    .redirect-button:active {
        background-color: #388e3c;
    }

    .redirect-button:focus {
        outline: none;
        box-shadow: 0 0 5px 2px rgba(72, 204, 128, 0.6);
    }

        
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php">NepalEdu Map</a>
        </div>
    </nav>

    <div class="container">
        <div class="details-card">
            <h1><?php echo htmlspecialchars($school['school_name']); ?></h1>
            <p><span>Registration Number:</span> <?php echo htmlspecialchars($school['registration_number']); ?></p>
            <p><span>Location:</span> <?php echo htmlspecialchars($school['location']); ?></p>
            <p><span>Email:</span> <?php echo htmlspecialchars($school['email']); ?></p>
            <p><span>Contact Number:</span> <?php echo htmlspecialchars($school['contact_number']); ?></p>
            <p><span>Bank Account:</span> <?php echo htmlspecialchars($school['bank_account']); ?></p>
            <p><span>Needs:</span> <?php echo htmlspecialchars($school['needs']); ?></p>
            <a href="contribute.php" class="back-link">&larr; Back to Contribute</a>
        </div>
    </div>
    <div class="center-container">
       <a href="FinalDonor.php"> <button class="redirect-button" >Donate</button></a>
    </div>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
