<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 36px;
            margin-top: 50px;
        }
        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            background-color: lightblue;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #4CAF50;
            color: white;
        }
        .question {
            font-size: 20px;
            margin: 15px 0;
        }
        label {
            font-size: 18px;
            display: block;
            margin: 10px 0;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        .card p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to the Donation Portal</h1>

        <div class="card">
            <p class="question">Would you like to donate financially or donate materials</p>
            <form action="" method="POST">
                <label>
                    <input type="radio" name="donation_type" value="financial" required> Financial Donation
                </label>
                <label>
                    <input type="radio" name="donation_type" value="material" required> Material Donation
                </label><br><br>
                <button type="submit" class="btn">Continue</button>
            </form>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['donation_type'])) {
                $donation_type = $_POST['donation_type'];
                if ($donation_type == "financial") {
                    header("Location: paymentupdate.php");
                    exit();
                } else {
                    header("Location: resourcedonor.php");
                    exit();
                }
            }
        }
    ?>

</body>
</html>
