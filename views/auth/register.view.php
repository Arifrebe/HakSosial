<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim(htmlspecialchars($_POST['username']));
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $role = "user";

        // Array untuk menyimpan error
        $errors = [];
        $usernameError = $emailError = $passwordError = '';

        // Cek apakah username sudah ada di database
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $usernameError = "Username is already taken";
            $errors[] = $usernameError;
        }

        // Cek apakah email sudah ada di database
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $emailError = "Email is already registered";
            $errors[] = $emailError;
        }

        // Validasi username
        if (empty($username)) {
            $usernameError = "Username is required";
            $errors[] = $usernameError;
        } elseif (strlen($username) < 3) {
            $usernameError = "Username must be at least 3 characters";
            $errors[] = $usernameError;
        }

        // Validasi email
        if (empty($email)) {
            $emailError = "Email is required";
            $errors[] = $emailError;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $errors[] = $emailError;
        }

        // Validasi password
        if (empty($password)) {
            $passwordError = "Password is required";
            $errors[] = $passwordError;
        } elseif (strlen($password) < 8) {
            $passwordError = "Password must be at least 8 characters";
            $errors[] = $passwordError;
        }

        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $hashedPassword, $role]);

            header('Location: login');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= defined('WEBNAME') ? WEBNAME : 'Website' ?> | Register</title>

    <!-- Font awesome 6.7.2 -->
    <link rel="stylesheet" href="<?= asset('fontawesome-6.7.2/css/all.min.css') ?>">
    <!-- Bootstrap 5.2.3 -->
    <link rel="stylesheet" type="text/css" href="<?= asset('bootstrap-5.2.3/css/bootstrap.min.css') ?>">
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg, #6e7dff, #5560ea);">
        <div class="card shadow-lg" style="width: 30rem; border-radius: 15px; overflow: hidden;">
            <form method="post">
                <div class="card-body p-4 d-flex flex-column">
                    <h3 class="text-center my-5" style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 2rem;">
                        <?= defined('WEBNAME') ? WEBNAME : 'Website' ?> | <span style="color: #5560ea;">Register</span>
                    </h3>
                    
                    <!-- Username Input -->
                    <div class="form-floating my-3">
                        <input type="text" class="form-control <?= !empty($usernameError) ? 'is-invalid' : ''; ?>" name="username" id="floatingInput" placeholder="JhonDoe" required value="<?= htmlspecialchars($username ?? '') ?>">
                        <label for="floatingInput">Username</label>
                        <div class="invalid-feedback">
                            <?= $usernameError; ?>
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control <?= !empty($emailError) ? 'is-invalid' : ''; ?>" name="email" id="floatingInput" placeholder="name@example.com" required value="<?= htmlspecialchars($email ?? '') ?>">
                        <label for="floatingInput">Email address</label>
                        <div class="invalid-feedback">
                            <?= $emailError; ?>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control <?= !empty($passwordError) ? 'is-invalid' : ''; ?>" name="password" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                        <div class="invalid-feedback">
                            <?= $passwordError; ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-4 flex-grow-1" style="background-color: #5560ea; border: none; padding: 12px;">Create</button>

                    <!-- Divider -->
                    <div class="text-center my-3">
                        <hr style="border-color: #8c8c8c;">
                    </div>

                    <!-- Create an Account Link -->
                    <div class="text-center">
                        <p style="color: #8c8c8c; font-size: 1rem;">
                            Already have an account? <a href="<?= url('auth/login') ?>" style="color: #5560ea;">Login</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>
