<?php include 'supernav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map - EduMap Nepal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

    <header>
        <h1 style="color: #3E5879;">Explore the Map</h1>
        <p style="color: #2f3f54; text-align: center; font-size: 20px;">The Map Page provides an interactive and comprehensive view of schools across Nepal, highlighting those in remote and underserved areas. 
            The map is designed to help users identify schools that lack essential resources and infrastructure, fostering connections with organizations, 
            volunteers, and donors. This tool leverages geographic data to visually represent the location and status of schools, offering insights 
            into accessibility, facilities, and immediate needs. By navigating the map, users can explore detailed information about each school, including 
            its challenges, demographics, and opportunities for improvement.The Map Page serves as a bridge between communities and support networks, promoting 
            equitable education access and development in Nepal.
            </p>
            </header>

    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.064692359537!2d85.31232911545362!3d27.7083174324741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDQyJzI5LjkiTiA4NcKwMTgnNTYuNCJF!5e0!3m2!1sen!2snp!4v1614600647632!5m2!1sen!2snp" 
            width="100%" 
            height="500" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
<?php include 'footer.php'; ?>
  
    <script src="main.js"></script>
</body>
</html>
