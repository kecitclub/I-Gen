<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Donating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        h1 {
            color: #3E5879;
            font-size: 36px;
            text-align: center;
        }
        .btn {
            background-color: #3E5879;
            padding: 14px 28px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            color: white;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #4C6A85;
        }
        .btn:active {
            background-color: #2F4359;
        }
    </style>
</head>
<body>

    <h1>Thank You for Donating!</h1>
    <p>Your generosity will make a difference in the lives of many.</p>
    <a href="home.php">
        <button class="btn">Go to Home Page</button>
    </a>

</body>
</html>
