<!-- <?php include 'supernav.php'; ?> -->
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NepalEdu Map</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

/* Body styling to ensure full-page height */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f9fc; /* Light background */
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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

/* Main content section */
/* Header Styling */
/* Header Styling */
/* Header Styling */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 60px 20px; /* Added more padding for spacing */
    background: linear-gradient(135deg,rgb(243, 243, 245),rgb(195, 213, 220)); /* Gradient background */
    border-radius: 15px; /* Rounded corners for a smoother look */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin-bottom: 40px; /* Space below header */
}

.header-left {
    max-width: 50%;/* Header Styling */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 60px 20px; /* Added more padding for spacing */
    background: linear-gradient(135deg, #3E5879, #A1D1E4); /* Gradient background */
    border-radius: 15px; /* Rounded corners for a smoother look */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin-bottom: 40px; /* Space below header */
}

.header-left {
    max-width: 50%;
    text-align: left;
}

.header-right {
    max-width: 50%;
    text-align: right;
}

.header-left h1 {
    font-size: 70px; /* Larger font for emphasis */
    color: white;
    font-weight: bold;
    letter-spacing: 2px; /* Adds spacing between letters */
    text-transform: uppercase; /* Capitalize letters for impact */
    margin-bottom: 15px;
}

.header-left .moto {
    font-size: 28px; /* Slightly larger than before */
    color: white;
    font-style: italic; /* Make it more elegant */
    letter-spacing: 1px;
}

.header-right img {
    width: 100%;
    max-width: 600px; /* Make the image larger */
    height: auto;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); /* Enhanced shadow for more depth */
    border-radius: 15px; /* Rounded corners */
    transition: transform 0.3s ease; /* Smooth hover effect */
}

.header-right img:hover {
    transform: scale(1.05); /* Slight zoom effect on hover */
}

    text-align: left;
}

.header-right {
    max-width: 50%;
    text-align: right;
}

.header-left h1 {
    font-size: 70px; /* Larger font for emphasis */
    color: white;
    font-weight: bold;
    letter-spacing: 2px; /* Adds spacing between letters */
    text-transform: uppercase; /* Capitalize letters for impact */
    margin-bottom: 15px;
}

.header-left .moto {
    font-size: 28px; /* Slightly larger than before */
    color: white;
    font-style: italic; /* Make it more elegant */
    letter-spacing: 1px;
}

.header-right img {
    width: 100%;
    max-width: 600px; /* Make the image larger */
    height: auto;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); /* Enhanced shadow for more depth */
    border-radius: 15px; /* Rounded corners */
    transition: transform 0.3s ease; /* Smooth hover effect */
}

.header-right img:hover {
    transform: scale(1.05); /* Slight zoom effect on hover */
}




.container {
    padding: 40px 20px;
    text-align: center;
    background-color: #ffffff;
}

.container2 {
    background-color: #e4e6ea;
    padding: 20px;
}

.container2 .center-image {
    text-align: center;
}

.container2 .center-image img {
    width: 100%;
    height: auto;
}

.container2 p {
    font-size: 25px;
    font-weight: bold;
    color: #3E5879;
}

/* Card Section */
.card-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

.card {
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 50px;
    margin-bottom: 15px;
}

.card h1 {
    font-size: 2.5rem;
    color: #007bff;
    margin: 0;
}

.card p {
    margin: 10px 0 0;
    font-size: 1rem;
    color: #555;
}

/* Footer styling */
footer {
    background-color: #3E5879;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: auto; /* Ensures footer is at the bottom */
}

/* Ensure footer stays at the bottom */
footer p {
    margin: 0;
}

/* Buttons */
.center-button {
    display: inline-block;
    background-color: #3E5879;
    color: white;
    font-size: 18px;
    padding: 12px 24px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
}

.center-button:hover {
    background-color: #A1D1E4;
}

/* Bottom of the page, this will ensure footer remains at the bottom */
footer {
    margin-top: auto;
}

    </style>
</head>

<body style="    background-color:#e4e6ea;">
<div class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="logo2.png">NepalEdu Map</a>
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
                <a href="login.php" class="nav-button">
                    <i class="fa-solid fa-envelope"></i>
                    <span>LOGIN</span>
                </a>
            </div>
        </div>
    </div>


    <div class="auth-button">
        <a href="login.php" class="button">Login</a>
    </div>
    </nav>
\    <header class="header">
    <div class="header-left">
        <h1 style="font-size: 55px; color: #3E5879;">EDUMAP NEPAL</h1>
        <p style="font-size: 25px; color: #3E5879;" class="moto">Mapping Unreached Schools</p>
    </div>
    <div class="header-right">
        <img src="school.jpg" alt="Education for All" style="width: 900px; height: auto;">
    </div>
</header>

    <section class="container" style="background-color: #e4e6ea;">
        <h3 style="color: #3E5879;">Welcome to EduMap Nepal</h3>
        <p>EduMap Nepal is a platform dedicated to identifying and mapping unreached schools across Nepal. By visualizing the educational landscape, we aim to bring awareness and resources to schools in need.</p>
    </section>
    </div>
    <div class="container2">
        <div class="center-image">
            <img src="poor2.jpg" alt="Education for All">
            <p style="font-size: 25; font-weight: bold; color: #3E5879;">Empowering Nepal through Education</p>
        </div>
    </div>
    <section class="description">
        <p>This is a platform designed to identify and connect unreached schools in Nepal with potential donors, organizations, and individuals who want to make a difference in education. Explore our platform to see how you can contribute and help build a brighter future for students in need.
            Our mission is to identify schools in Nepal that lack resources and highlight their needs. By working together, we can ensure every child has access to quality education. Navigate through our platform to explore the map, learn about our goals, and find ways to contribute.
        </p>
    </section>
    <div style="background-color: #e4e6ea;" class="center-cont">
    <a href="register.php">
    <button class="center-button">Become A Contributor Now</button>
</a>

    </div>
    <div class="card-container">
        <!-- Row 1: Card 1 -->
        <div class="card">
            <img src="document_1648040.png" alt="Icon">
            <h1>50</h1>
            <p>Projects Completed</p>
        </div>
        <!-- Row 1: Card 2 -->
        <div class="card">
            <img src="school_8074788.png" alt="Icon">
            <h1>38</h1>
            <p>School Impacted</p>
        </div>
        <!-- Row 1: Card 3 -->
        <div class="card">
            <img src="donation_872778.png" alt="Icon">
            <h1>621</h1>
            <p>Count Of Donation Received</p>
        </div>
        <!-- Row 2: Card 4 -->
        <div class="card">
            <img src="turnover_18559144.png" alt="Icon">
            <h1>309</h1>
            <p>Engage & Contributor</p>
        </div>
        <!-- Row 2: Card 5 -->
        <div class="card">
            <img src="teamwork_18549257.png" alt="Icon">
            <h1>75+</h1>
            <p>Partners,Volunteers & Collaborators</p>
        </div>
        <!-- Row 2: Card 6 -->
        <div class="card">
            <img src="money_8510562.png" alt="Icon">
            <h1>Rs.400000+</h1>
            <p>Aids Distributed</p>
        </div>
    </div>

    <?php include 'superfooter.php'; ?>

</body>

</html>