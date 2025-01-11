<?php
include 'includes/head.php';
include 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables
$username_or_email = $password = $error_message = "";

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST['username_or_email']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username_or_email) || empty($password)) {
        $error_message = "Please enter both username/email and password.";
    } else {
        // Query to find the user
        $stmt = $conn->prepare("SELECT * FROM Customer WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Store user details in session
                $_SESSION['customer_id'] = $user['customer_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['firstname'] = $user['first_name'];
                $_SESSION['lastname'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['success_message'] = "Welcome back, " . htmlspecialchars($user['first_name']) . " " . $user['last_name'] . "!";

                header("Location: home.php");
                exit();
            } else {
                $error_message = "You have entered the wrong password.";
            }
        } else {
            $error_message = "Account not found.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<body class="d-flex flex-column" data-bs-theme="light">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <form class="card card-md" action="/login" method="POST" autocomplete="off">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login to your account</h2>
                    <p class="text-secondary mb-4 text-muted">Please login to continue with your account</p>
                    <!-- Username or Email Input -->
                    <div class="mb-3">
                        <label for="username_or_email" class="form-label">Username or Email</label>
                        <input type="text" name="username_or_email" id="username_or_email" class="form-control" placeholder="Enter your username or email" required>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password
                            <span class="form-label-description">
                                <a href="./forgot_pass.php" >I forgot my password</a>
                            </span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="new-password" required>
                            <span class="input-group-text">
                                <i class="bi bi-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Remember me on this device</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Login</button>

                        <!-- Registration Link -->
                        <div class="text-center text-secondary mt-3">
                            Don't have an account yet? <a href="./registration.php">Sign up</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
    <!-- Login Error Notification -->
    <script>
        <?php if (!empty($error_message)): ?>
            new Notify({
                status: 'error',
                title: 'Login Error',
                text: '<?php echo htmlspecialchars($error_message); ?>',
                effect: 'slide',
                speed: 300,
                autoclose: true,
                autotimeout: 5000,
                position: 'right top'
            });
        <?php endif; ?>
    </script>
</body>
