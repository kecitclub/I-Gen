<?php
// Include the navbar file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base Styles */
        :root {
            --primary-color: #3E5879;
            --secondary-color: #A1D1E4;
            --background-color: #f5f7fa;
            --card-bg: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border-radius: 10px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-button:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Mobile View */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-button span {
                display: none;
            }

            .nav-button i {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="home.php">NepalEdu Map</a>
            </div>
            <div class="nav-links">
                <a href="home.php" class="nav-button">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>
                <a href="about.php" class="nav-button">
                    <i class="fa-solid fa-info-circle"></i>
                    <span>About</span>
                </a>
                <a href="contribute.php" class="nav-button">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Contribute</span>
                </a>
                <a href="contact.php" class="nav-button">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
