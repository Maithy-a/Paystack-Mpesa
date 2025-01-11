<?php
    // Include database connection file
    include 'includes/head.php';
    include 'includes/db.php';

    // Initialize variables
    $first_name = "";
    $last_name = "";
    $username = "";
    $email = "";
    $phone_number = "";
    $password = "";
    $confirm_password = "";
    $error_message = "";
    $success_message = "";

    // Check for form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Check if passwords match
        if ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            // Check if the username, email, or phone number already exists in the database
            $stmt = $conn->prepare("SELECT * FROM Customer WHERE username = ? OR email = ? OR phone_number = ?");
            $stmt->bind_param("sss", $username, $email, $phone_number);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Check which field is already taken
                $error_message = "User with these details already exists. Please proceed to login or reset your password.";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and bind statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO Customer (first_name, last_name, username, email, phone_number, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $phone_number, $hashed_password);

                // Execute statement
                if ($stmt->execute()) {
                    // Get the newly inserted customer's ID
                    $customer_id = $stmt->insert_id;

                    // Insert into the account table
                    $stmt_account = $conn->prepare("INSERT INTO account (customer_id, balance) VALUES (?, ?)");
                    $default_balance = 0.00;
                    $stmt_account->bind_param("id", $customer_id, $default_balance);

                    if ($stmt_account->execute()) {
                        $success_message = "Registration successful! Your account has been created. You can now log in.";
                    } else {
                        $error_message = "Error creating account: " . $stmt_account->error;
                    }

                    // Close account statement
                    $stmt_account->close();
                } else {
                    $error_message = "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    $conn->close();
    ?>

<body class="d-flex flex-column" data-bs-theme="dark">
    <div class="container container-tight py-4">
        <div class="card shadow-sm p-4 rounded-3">
            <form method="post" action="" autocomplete="off">

                <h2 class="card-title text-center mb-4">Create new account</h2>

                <!-- First Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        placeholder="Enter your first name" required>
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        placeholder="Enter your last name" required>
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                        placeholder="Create a username" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Enter your email address" required>
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                        placeholder="Enter your phone number">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter a strong password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                        placeholder="Re-enter your password" required>
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label">Agree to the <a href="./terms-of-service.html"
                                tabindex="-1">terms and policy</a>.</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" id="Cta" class="btn btn-primary">Create new account</button>
                </div>

                <!-- Login Link -->
                <div class="text-center text-secondary mt-3">
                    Already have an account? <a href="./index.php" tabindex="-1">Sign in</a>
                </div>

            </form>

        </div>
    </div>

    <!-- Notifications -->
    <script>
        <?php if (!empty($error_message)): ?>
            new Notify({
                status: 'error',
                title: 'Registration Error',
                text: '<?= htmlspecialchars($error_message); ?>',
                effect: 'slide',
                speed: 300,
                autoclose: true,
                autotimeout: 5000,
                showIcon: false,
                position: 'right top',
                notificationsGap: null,
                notificationsPadding: null,
            });
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            new Notify({
                status: 'success',
                title: 'Registration Successful',
                text: '<?= htmlspecialchars($success_message); ?>',
                effect: 'slide',
                speed: 300,
                autoclose: true,
                autotimeout: 5000,
                position: 'right top',
                notificationsGap: null,
                notificationsPadding: null,
            });
            // Redirect to login page after success
            setTimeout(function () {
                window.location.href = 'index.php';
            }, 6000);
        <?php endif; ?>

    </script>

</body>