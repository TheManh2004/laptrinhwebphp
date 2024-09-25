<?php
session_start();

$errors = [];
$first_name = $last_name = $email = $invoice_id = $additional_info = '';
$pay_for = [];
$file_upload = '';
$upload_success = false;

// Function to clean and sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate form input
    $_SESSION['first_name'] = $first_name = test_input($_POST['first_name']);
    $_SESSION['last_name'] = $last_name = test_input($_POST['last_name']);
    $_SESSION['email'] = $email = test_input($_POST['email']);
    $_SESSION['invoice_id'] = $invoice_id = test_input($_POST['invoice_id']);
    $_SESSION['pay_for'] = $pay_for = $_POST['pay_for'] ?? [];
    $_SESSION['additional_info'] = $additional_info = test_input($_POST['additional_info']);

    // Validate first name
    if (empty($first_name)) {
        $errors['first_name'] = "First Name is required.";
    }

    // Validate last name
    if (empty($last_name)) {
        $errors['last_name'] = "Last Name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate invoice ID
    if (empty($invoice_id)) {
        $errors['invoice_id'] = "Invoice ID is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $invoice_id)) {
        $errors['invoice_id'] = "Invoice ID can only contain letters and numbers.";
    }

    // Validate pay for
    if (empty($pay_for)) {
        $errors['pay_for'] = "Please select at least one item from 'Pay For'.";
    }

    // Validate file upload
    if ($_FILES['payment_receipt']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors['file'] = "Please upload your payment receipt.";
    } else {
        $file = $_FILES['payment_receipt'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_file_size = 1048576; // 1MB in bytes

        if (!in_array($file['type'], $allowed_types)) {
            $errors['file'] = "Only JPG, PNG, and GIF files are allowed.";
        } elseif ($file['size'] > $max_file_size) {
            $errors['file'] = "File size must not exceed 1MB.";
        } else {
            // Ensure upload directory exists and is writable
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Create directory if it doesn't exist
            }

            $target_file = $upload_dir . basename($_FILES["payment_receipt"]["name"]);

            // Check and move file
            if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
                $_SESSION['file_upload'] = $file_upload = $target_file;
            } else {
                $errors['file'] = "An error occurred during file upload.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: max-content;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            color: #8f8f8f;
        }

        .checkbox-group label {
            width: 48%;
            margin-bottom: 10px;
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group.small {
            margin-bottom: 0;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .submitted-data {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9f7ef;
            border-radius: 5px;
            border: 1px solid #d4e9d5;
        }

        .submitted-data img {
            max-width: 300px;
            display: block;
            margin-top: 10px;
        }

        .submitted-data p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Payment Receipt Upload Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="input-row">
                <div class="form-group small">
                    <label>First Name:</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($_SESSION['first_name'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['first_name'] ?? ''; ?></span>
                </div>
                <div class="form-group small">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($_SESSION['last_name'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['last_name'] ?? ''; ?></span>
                </div>
            </div>
            <br>
            <div class="input-row">
                <div class="form-group small">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
                </div>
                <div class="form-group small">
                    <label>Invoice ID:</label>
                    <input type="text" name="invoice_id" value="<?php echo htmlspecialchars($_SESSION['invoice_id'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['invoice_id'] ?? ''; ?></span>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label>Pay For:</label>
                <div class="checkbox-group">
                    <?php
                    $items = [
                        "15K Category",
                        "35K Category",
                        "55K Category",
                        "75K Category",
                        "116K Category",
                        "Shuttle Two Ways",
                        "Shuttle One Way",
                        "Compressport T-Shirt Merchandise",
                        "Training Cap Merchandise",
                        "Buf Merchandise",
                        "Other"
                    ];
                    $session_pay_for = $_SESSION['pay_for'] ?? [];
                    foreach ($items as $item) {
                        $checked = in_array($item, $session_pay_for) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='pay_for[]' value='$item' $checked> $item</label>";
                    }
                    ?>
                </div>
                <span class="error"><?php echo $errors['pay_for'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Please upload your payment receipt:</label>
                <input type="file" name="payment_receipt">
                <span class="error"><?php echo $errors['file'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Additional Information:</label>
                <textarea name="additional_info"><?php echo htmlspecialchars($_SESSION['additional_info'] ?? ''); ?></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>

        <!-- Display submitted data -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
            <div class="submitted-data">
                <h3>Submitted Information:</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($_SESSION['invoice_id']); ?></p>
                <p><strong>Items Paid For:</strong> <?php echo implode(', ', $_SESSION['pay_for']); ?></p>
                <p><strong>Additional Information:</strong> <?php echo htmlspecialchars($_SESSION['additional_info']); ?></p>

                <?php if ($_SESSION['file_upload']): ?>
                    <p><strong>Uploaded Receipt:</strong></p>
                    <img src="<?php echo $_SESSION['file_upload']; ?>" alt="Payment Receipt">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>