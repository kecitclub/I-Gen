<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection setup
    $servername = "localhost";
    $username = "root";  
    $password = "";     
    $dbname = "edumap"; 
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if 'paymentMethod' is set in POST data
    if (isset($_POST['paymentMethod']) && !empty($_POST['paymentMethod'])) {
        $paymentMethod = $_POST['paymentMethod'];
    } else {
        // Do not output error here, it should only show after form submission
        $paymentMethodError = "Payment method not selected.";
    }

    // Sanitize and get other form data, handle null values
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

        // Check if the upload directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $fileUpload)) {
            // File uploaded successfully
            $uploadSuccess = true;
        } else {
            echo "Error: Unable to move the uploaded file.";
            exit;
        }
    }

    // Prepare and bind the SQL query to insert data into the database
    if (isset($paymentMethod) && !empty($paymentMethod)) {
        $stmt = $conn->prepare("INSERT INTO payment (payment_method, card_number, card_expiry, card_cvv, bank_name, account_number, wallet_id, file_upload) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $paymentMethod, $cardNumber, $cardExpiry, $cardCVV, $bankName, $accountNumber, $walletID, $fileUpload);
        
        // Execute the query
        if ($stmt->execute()) {
            $formSubmitSuccess = true;  // Flag for success message
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
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
        .section {
            margin-bottom: 20px;
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
        
        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .modal-header {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .modal-body {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 5px;
            right: 15px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function togglePaymentDetails() {
            const method = document.getElementById('paymentMethod').value;
            document.querySelectorAll('.payment-details').forEach(section => section.classList.add('hidden'));

            // Show payment method specific details
            if (method === 'credit-card') {
                document.getElementById('creditCardDetails').classList.remove('hidden');
            } else if (method === 'bank-transfer') {
                document.getElementById('bankDetails').classList.remove('hidden');
            } else if (method === 'wallet') {
                document.getElementById('walletDetails').classList.remove('hidden');
            }
        }

        // Show modal if payment was successfully submitted
        function showModal(message) {
            const modal = document.getElementById('successModal');
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = message;
            modal.style.display = "block";
        }

        // Close the modal
        function closeModal() {
            document.getElementById('successModal').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('successModal')) {
                closeModal();
            }
        }

        window.onload = function() {
            <?php if (isset($formSubmitSuccess) && $formSubmitSuccess) { ?>
                showModal("Payment details submitted successfully!");
            <?php } ?>
        }
    </script>
</head>
<body>
    <h1 style="font-weight: bolder;text-align: center;">Payment Method</h1>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="section">
            <label for="paymentMethod">Select Payment Method</label>
            <select id="paymentMethod" name="paymentMethod" onchange="togglePaymentDetails()" required>
                <option value="" selected disabled>-- Select Payment Method --</option>
                <option value="credit-card">Credit/Debit Card</option>
                <option value="bank-transfer">Bank Transfer</option>
                <option value="wallet">Digital Wallet</option>
            </select>
            <?php if (isset($paymentMethodError)) { echo "<p style='color:red;'>$paymentMethodError</p>"; } ?>
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
                <label for="fileupload">Upload Payment Details</label>
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
                <label for="fileupload">Upload Payment Details</label>
                <input type="file" id="fileupload" name="fileupload">
            </div>
        </div>

        <button type="submit">Submit Payment</button>
    </form>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>
</body>
</html>
