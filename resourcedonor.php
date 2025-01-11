<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Donation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
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
            color: #3E5879;
            font-size: 36px;
            margin-top: 50px;
        }
        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-size: 18px;
            color: #3E5879;
        }
        input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        .btn {
            background-color: #3E5879;
            padding: 14px 28px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            color: white;
            width: 100%;
            transition: background-color 0.3s ease;
            box-sizing: border-box;
        }
        .btn:hover {
            background-color: #4C6A85;
        }
        .btn:active {
            background-color: #2F4359;
        }
        .card p {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
        .form-group input, .form-group textarea {
            transition: border 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #3E5879;
            outline: none;
        }
        .form-group input[type="number"] {
            -moz-appearance: textfield;
        }
        .form-group input[type="number"]::-webkit-outer-spin-button,
        .form-group input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .form-group input, textarea {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Material Donation Form</h1>

        <div class="card">
            <p>Please provide the details of the materials you wish to donate.</p>
            <form action="thankyou.php" method="POST">

                <div class="form-group">
                    <label for="donation_item">What are you donating?</label>
                    <input type="text" id="donation_item" name="donation_item" placeholder="e.g. Books, Stationery, Clothes" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="e.g. 100 books" required min="1">
                </div>

                <div class="form-group">
                    <label for="donation_description">Description (optional)</label>
                    <textarea id="donation_description" name="donation_description" placeholder="Provide any additional details about your donation (optional)"></textarea>
                </div>

                <div class="form-group">
                    <label for="donor_name">Your Name</label>
                    <input type="text" id="donor_name" name="donor_name" placeholder="Your full name" required>
                </div>

                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" placeholder="Your phone number" required>
                </div>

                <div class="form-group">
                    <label for="donor_email">Your Email Address</label>
                    <input type="email" id="donor_email" name="donor_email" placeholder="Your email address" required>
                </div>

                <div class="form-group">
                    <label for="donor_address">Your Address</label>
                    <textarea id="donor_address" name="donor_address" placeholder="Provide your address where the items can be picked up/dropped off" required></textarea>
                </div>

                <button type="submit" class="btn">Submit Donation</button>

            </form>
        </div>
    </div>

</body>
</html>
