<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        $errors = [];
        $emailError = $passwordError = $message = "";

        // Email validation
        if (empty($email)) {
            $emailError = "Email is required!";
            $errors[] = $emailError;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Email format is invalid!";
            $errors[] = $emailError;
        }

        // Password validation
        if (empty($password)) {
            $passwordError = "Password is required";
            $errors[] = $passwordError;
        } elseif (strlen($password) < 8) {
            $passwordError = "Password must be at least 8 characters";
            $errors[] = $passwordError;
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
        
            if (!$user || !password_verify($password, $user->password)) {
                $_SESSION['errorMessage'] = "Pengguna tidak ditemukan atau password salah";
                header('Location: login');
                exit;
            } else {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['role'] = $user->role;

                header("Location: ../home");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= defined('WEBNAME') ? WEBNAME : 'Website' ?> | Login</title>

    <!-- Font awesome 6.7.2 -->
    <link rel="stylesheet" href="<?= asset('fontawesome-6.7.2/css/all.min.css') ?>">
    <!-- Bootstrap 5.2.3 -->
    <link rel="stylesheet" type="text/css" href="<?= asset('bootstrap-5.2.3/css/bootstrap.min.css') ?>">
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="height: 100vh; background: linear-gradient(135deg, #6e7dff, #5560ea);">
        <div class="card shadow-lg" style="width: 30rem; border-radius: 15px; overflow: hidden;">
            <form method="post">
                <div class="card-body p-4 d-flex flex-column">
                    <h3 class="text-center my-5"
                        style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 2rem;">
                        <?= defined('WEBNAME') ? WEBNAME : 'Website' ?> | <span style="color:  #5560ea;">Login</span>
                    </h3>
                    
                    <?php if (!empty($_SESSION['errorMessage'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show flashMessage" role="alert">
                            <?= $_SESSION['errorMessage']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['errorMessage']);?>
                    <?php endif; ?>

                    <div class="form-floating my-3">
                        <input type="email" name="email" class="form-control <?= !empty($emailError) ? 'is-invalid' : '' ?>" id="floatingInput" placeholder="name@example.com" value="<?= htmlspecialchars($email ?? '') ?>">
                        <label for="floatingInput">Email address</label>
                        <div class="invalid-feedback">
                            <?= $emailError ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control <?= !empty($passwordError) ? 'is-invalid' : '' ?>" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <div class="invalid-feedback">
                            <?= $passwordError ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-4 flex-grow-1"
                        style="background-color: #5560ea; border: none; padding: 12px;">Sign in</button>
                
                    <!-- Divider -->
                    <div class="text-center my-3">
                        <hr style="border-color: #8c8c8c;">
                    </div>

                    <!-- Create an Account Link -->
                    <div class="text-center">
                        <p style="color: #8c8c8c; font-size: 1rem;">
                            Don't have an account? <a href="<?= url('auth/register') ?>" style="color: #5560ea;">Create one</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        window.onload = function() {
            var flashMessages = document.querySelectorAll(".flashMessage");
            flashMessages.forEach(function(flashMessage, index) {
                var delay = 3000 + (index * 500);

                setTimeout(function() {
                    flashMessage.classList.remove("show");
                    flashMessage.classList.add("fade");
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 500);
                }, delay); 
            });
        };
    </script>
</body>
</html>
