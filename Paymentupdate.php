<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";  
    $password = "";     
    $dbname = "edumap"; 
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $paymentMethod = $_POST['paymentMethod'];
    $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : NULL;
    $cardExpiry = isset($_POST['cardExpiry']) ? $_POST['cardExpiry'] : NULL;
    $cardCVV = isset($_POST['cardCVV']) ? $_POST['cardCVV'] : NULL;
    $bankName = isset($_POST['bankName']) ? $_POST['bankName'] : NULL;
    $accountNumber = isset($_POST['accountNumber']) ? $_POST['accountNumber'] : NULL;
    $walletID = isset($_POST['walletID']) ? $_POST['walletID'] : NULL;
    
    // Handle file upload
    $fileUpload = NULL;
    if (isset($_FILES['fileupload']) && $_FILES['fileupload']['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['fileupload']['name']);
        $fileUpload = $uploadDir . $fileName;

        // Check if the upload directory exists, if not create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $fileUpload)) {
            echo "File uploaded successfully: " . $fileUpload;
        } else {
            echo "Error: Unable to move the uploaded file.";
        }
    } else {
        echo "No file uploaded or error with file upload.";
    }

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO payment (payment_method, card_number, card_expiry, card_cvv, bank_name, account_number, wallet_id, file_upload) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $paymentMethod, $cardNumber, $cardExpiry, $cardCVV, $bankName, $accountNumber, $walletID, $fileUpload);
    
    // Execute the query
    if ($stmt->execute()) {
        echo "Payment details submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title class="title">Payment Method</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            box-sizing: border-box;
        }
        .div{
            
             display: flex;
             align-items: baseline;
             margin-bottom: 30px;
             justify-content: center;
         h1 {
             font-size: 2em;
             font-weight: bolder;
             margin-bottom: 30px;
             color: #5c6bc0;
             text-align: center;
}
        }
        .section {
            margin-bottom: 20px;
            align-self: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .hidden {
            display: none;
        }
        .img{
            align-items: self-end;
        }
        .hidden { display: none; }
        .section { margin-bottom: 20px; }
        
    </style>
    <!-- <link rel="stylesheet" href="payment.css"> -->
    <script>
        function togglePaymentDetails() {
            const method = document.getElementById('paymentMethod').value;
            document.querySelectorAll('.payment-details').forEach(section => section.classList.add('hidden'));

            // Yeslay chai selected payment method show garxa
            if (method === 'credit-card') {
                document.getElementById('creditCardDetails').classList.remove('hidden');
            } else if (method === 'bank-transfer') {
                document.getElementById('bankDetails').classList.remove('hidden');
            } else if (method === 'wallet') {
                document.getElementById('walletDetails').classList.remove('hidden');
            }
        }
    </script>
</head>
<body>
    <h1 style="font-weight: bolder;text-align: center;">Payment Method</h1>
    <div class="div">
    <img src="frame.png" class="image_container" style="width: 100px; height: 100px;align-content: end; margin-right: 5px;" alt="scan here" >
        
</div>
    <form action="thankyou.php" method="POST" enctype="multipart/form-data">
        <div class="section">
            <label for="paymentMethod">Select Payment Method</label>
            <select id="paymentMethod" name="paymentMethod" onchange="togglePaymentDetails()" required>
                <option value="" selected disabled>-- Select Payment Method --</option>
                <option value="credit-card">Credit/Debit Card</option>
                <option value="bank-transfer">Bank Transfer</option>
                <option value="wallet">Digital Wallet</option>
            </select>
        </div>

        <!-- Credit/Debit Card Details -->
        <div id="creditCardDetails" class="payment-details hidden">
            <div class="section">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456">
            </div>
            <div class="section">
                <label for="cardExpiry">Expiry Date</label>
                <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/YY">
            </div>
            <div class="section">
                <label for="cardCVV">CVV</label>
                <input type="text" id="cardCVV" name="cardCVV" placeholder="123">
            </div>
            <div class="section">
                <label for="fileupload">Upload Payment Details</label>
                <input type="file" id="fileupload" name="fileupload">
            </div>
        </div>

        <!-- Bank Transfer Details -->
        <div id="bankDetails" class="payment-details hidden">
            <div class="section">
                <label for="bankName">Bank Name</label>
                <input type="text" id="bankName" name="bankName" placeholder="Enter bank name">
            </div>
            <div class="section">
                <label for="accountNumber">Account Number</label>
                <input type="text" id="accountNumber" name="accountNumber" placeholder="Enter account number">
            </div>
            <div class="section">
                <label for="fileupload">Upload Payment Receipt</label>
                <input type="file" id="fileupload" name="fileupload">
            </div>
        </div>

        <!-- Digital Wallet Details -->
        <div id="walletDetails" class="payment-details hidden">
            <div class="section">
                <label for="walletID">Wallet ID</label>
                <input type="text" id="walletID" name="walletID" placeholder="Enter wallet ID">
            </div>
            <div class="section">
                <label for="fileupload">Upload Payment Receipt</label>
                <input type="file" id="fileupload" name="fileupload">
            </div>
        </div>

        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>