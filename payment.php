-- finaldonor.php --
<?php
session_start();
require_once 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_SESSION['user_id'] ?? null;
    $donation_type = $_POST['donation_type'];
    $amount = ($donation_type == 'financial') ? $_POST['amount'] : 0;
    $category = $_POST['category'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'] ?? 1;
    $status = 'pending';
    $date = date('Y-m-d H:i:s');

    // Handle file upload for resource donations
    $image_path = '';
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . '_' . basename($_FILES['item_image']['name']);
        if (move_uploaded_file($_FILES['item_image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        }
    }

    // Insert donation record
    $sql = "INSERT INTO donations (donor_id, donation_type, amount, category, description, 
            quantity, image_path, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdssisss", $donor_id, $donation_type, $amount, $category, 
                      $description, $quantity, $image_path, $status, $date);
    
    if ($stmt->execute()) {
        $_SESSION['success_msg'] = "Donation submitted successfully!";
        header("Location: finaldonor.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error submitting donation. Please try again.";
    }
}

// Fetch donation categories
$categories_query = "SELECT * FROM donation_categories";
$categories_result = $conn->query($categories_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Donation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Make a Donation</h1>
        
        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="alert success"><?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="alert error"><?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?></div>
        <?php endif; ?>

        <form action="finaldonor.php" method="POST" enctype="multipart/form-data" class="donation-form">
            <div class="form-group">
                <label>Donation Type:</label>
                <div class="radio-group">
                    <input type="radio" id="financial" name="donation_type" value="financial" checked>
                    <label for="financial">Financial Donation</label>
                    <input type="radio" id="resource" name="donation_type" value="resource">
                    <label for="resource">Resource Donation</label>
                </div>
            </div>

            <div class="form-group" id="amount-group">
                <label for="amount">Amount ($):</label>
                <input type="number" id="amount" name="amount" min="1" step="0.01">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <?php while($category = $categories_result->fetch_assoc()): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group" id="resource-details" style="display: none;">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1">
                
                <label for="item_image">Item Image:</label>
                <input type="file" id="item_image" name="item_image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit Donation</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="donation_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const isFinancial = this.value === 'financial';
                document.getElementById('amount-group').style.display = isFinancial ? 'block' : 'none';
                document.getElementById('resource-details').style.display = isFinancial ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>

-- payment_update.php --
<?php
session_start();
require_once 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donation_id = $_POST['donation_id'];
    $amount_used = $_POST['amount_used'];
    $usage_details = $_POST['usage_details'];
    $date = date('Y-m-d H:i:s');

    // Handle proof image upload
    $proof_image = '';
    if (isset($_FILES['proof_image']) && $_FILES['proof_image']['error'] == 0) {
        $target_dir = "uploads/proofs/";
        $target_file = $target_dir . time() . '_' . basename($_FILES['proof_image']['name']);
        if (move_uploaded_file($_FILES['proof_image']['tmp_name'], $target_file)) {
            $proof_image = $target_file;
        }
    }

    // Insert payment update
    $sql = "INSERT INTO payment_updates (donation_id, amount_used, usage_details, proof_image, created_at) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idsss", $donation_id, $amount_used, $usage_details, $proof_image, $date);
    
    if ($stmt->execute()) {
        // Update the remaining amount in donations table
        $update_sql = "UPDATE donations SET amount_remaining = amount_remaining - ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("di", $amount_used, $donation_id);
        $update_stmt->execute();

        $_SESSION['success_msg'] = "Payment update submitted successfully!";
    } else {
        $_SESSION['error_msg'] = "Error submitting update. Please try again.";
    }
}

// Fetch active donations
$donations_query = "SELECT d.*, dc.name as category_name 
                   FROM donations d 
                   JOIN donation_categories dc ON d.category = dc.id 
                   WHERE d.status != 'completed' 
                   ORDER BY d.created_at DESC";
$donations_result = $conn->query($donations_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Update</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Payment Update</h1>

        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="alert success"><?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="alert error"><?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?></div>
        <?php endif; ?>

        <!-- Payment Update Form -->
        <form action="payment_update.php" method="POST" enctype="multipart/form-data" class="update-form">
            <div class="form-group">
                <label for="donation_id">Select Donation:</label>
                <select id="donation_id" name="donation_id" required>
                    <option value="">Select Donation</option>
                    <?php while($donation = $donations_result->fetch_assoc()): ?>
                        <option value="<?php echo $donation['id']; ?>">
                            #<?php echo $donation['id']; ?> - 
                            <?php echo $donation['donation_type'] == 'financial' ? 
                                  '$' . $donation['amount'] : $donation['description']; ?> 
                            (<?php echo $donation['category_name']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group" id="amount-used-group">
                <label for="amount_used">Amount Used:</label>
                <input type="number" id="amount_used" name="amount_used" min="0.01" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="usage_details">Usage Details:</label>
                <textarea id="usage_details" name="usage_details" required></textarea>
            </div>

            <div class="form-group">
                <label for="proof_image">Proof of Usage:</label>
                <input type="file" id="proof_image" name="proof_image" accept="image/*" required>
            </div>

            <button type="submit" class="submit-btn">Submit Update</button>
        </form>

        <!-- Recent Updates Section -->
        <section class="recent-updates">
            <h2>Recent Updates</h2>
            <?php
            $updates_query = "SELECT pu.*, d.donation_type, d.description as donation_description 
                            FROM payment_updates pu 
                            JOIN donations d ON pu.donation_id = d.id 
                            ORDER BY pu.created_at DESC LIMIT 5";
            $updates_result = $conn->query($updates_query);
            ?>

            <div class="updates-list">
                <?php while($update = $updates_result->fetch_assoc()): ?>
                    <div class="update-card">
                        <div class="update-header">
                            <span class="donation-id">Donation #<?php echo $update['donation_id']; ?></span>
                            <span class="update-date"><?php echo date('M d, Y', strtotime($update['created_at'])); ?></span>
                        </div>
                        <div class="update-body">
                            <p class="amount-used">Amount Used: $<?php echo $update['amount_used']; ?></p>
                            <p class="usage-details"><?php echo htmlspecialchars($update['usage_details']); ?></p>
                            <?php if($update['proof_image']): ?>
                                <img src="<?php echo $update['proof_image']; ?>" alt="Proof of usage" class="proof-image">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </div>
</body>
</html>

-- styles.css --
/* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f5f7fa;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 2rem;
    font-size: 2.5rem;
}

h2 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
}

/* Form Styles */
.donation-form,
.update-form {
    background: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 600;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

.radio-group {
    display: flex;
    gap: 1.5rem;
    margin-top: 0.5rem;
}

.radio-group input[type="radio"] {
    margin-right: 0.5rem;
}

/* Button Styles */
.submit-btn {
    background: #3498db;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    width: 100%;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background: #2980b9;
}

/* Alert Styles */
.alert {
    padding: 1rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Recent Updates Section */
.recent-updates {
    margin-top: 3rem;
}

.updates-list {
    display: grid;
    gap: 1.5rem;
}

.update-card {
    background: #ffffff;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.update-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0