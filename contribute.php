<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'edumap');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch school data
$sql = "SELECT school_name, registration_number, location,  email, needs, created_at FROM receiver"; // Adjust table/column names as needed
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribute - NepalEdu Map</title>
    <link rel="stylesheet" href="contribute.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="home.php">NepalEdu Map</a>
            </div>
            <div class="nav-links">
                <a href="home.php" class="nav-button">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="about.php" class="nav-button">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
                <a href="map.php" class="nav-button">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Map</span>
                </a>
                <a href="contribute.php" class="nav-button active">
                    <i class="fas fa-hands-helping"></i>
                    <span>Contribute</span>
                </a>
                <a href="contact.php" class="nav-button">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>
        </div>
    </nav>

    <main>
        <div class="page-header">
            <h1>Support Schools in Need</h1>
            <p>Browse through schools seeking support and make a difference in education</p>
        </div>

        <div class="container">
            <div class="projects-grid">
              <!-- Fetch and display school data -->
<?php $i = 1; // Initialize the counter ?>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="project-card">
        <div class="card-image">
            <img src="images/schools/cont<?php echo $i; ?>.jpg" alt="School Image">
            <div class="card-overlay">
    <a href="details.php?reg_no=<?php echo urlencode($row['registration_number']); ?>">
        <button class="view-more">View Details</button>
    </a>
</div>

        </div>
        <div class="card-content">
            <h3><?php echo htmlspecialchars($row['school_name']); ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></p>
            <p class="description"><?php echo htmlspecialchars($row['needs']); ?></p>
            <div class="project-tags">
                <?php
                // Split tags into individual spans
                $tags = explode(',', $row['created_at']);
                foreach ($tags as $tag) {
                    echo '<span class="tag">' . htmlspecialchars(trim($tag)) . '</span>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php $i++; // Increment the counter ?>
<?php } ?>

            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 NepalEdu Map. All rights reserved.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
