<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: ../profile.php');
        exit();
    }
    
    $user_error = '';
    $password_error = '';
    $success_message = '';

    $has_error = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../functions/connect.php';

        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM profiles WHERE username = ? OR email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $login, $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email']; 
                
                $success_message = "Welcome back " . htmlspecialchars($user['username']) . "!";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../profile.php';
                    }, 2000);
                </script>";
            } else {
                $password_error = "Incorrect password. Please try again.";
                $has_error = true;
            }
        } else {
            $user_error = "Email not found. Please try again.";
            $has_error = true;
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../src/output.css" rel="stylesheet">
        <title>Block1A - Login</title>
    </head>
    <body>
        <section class="bg-[url('../assets/auth-background.webp')] bg-cover bg-center bg-no-repeat flex flex-col items-center justify-center min-h-screen px-5 md:px-30">
            <div class="bg-[#1a202a] flex flex-col rounded-md p-8 w-full max-w-md">
                <div class="flex items-start justify-between pb-7">
                    <p class="text-white text-2xl font-bold">Login to Your Account</p>
                    <img src="../assets/cs1a.png" alt="logo" class="w-20">
                </div>

                <form id="loginForm" class="space-y-4" method="POST" action="login.php">
                    <?php if (!empty($password_error)): ?>
                        <div class="bg-red-600 text-white p-3 rounded-md text-center font-semibold">
                            <?= htmlspecialchars($password_error) ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($user_error)): ?>
                        <div class="bg-red-600 text-white p-3 rounded-md text-center font-semibold">
                            <?= htmlspecialchars($user_error) ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($success_message)): ?>
                        <div class="bg-green-600 text-white p-3 rounded-md text-center font-semibold">
                            <?= htmlspecialchars($success_message) ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <label for="login" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" id="login" name="login" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border <?= $has_error ? 'border-red-500' : 'border-gray-600' ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border <?= $has_error ? 'border-red-500' : 'border-gray-600' ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex items-center justify-between pb-5">
                        <div class="flex items-center gap-2 text-white text-sm">
                            <input type="checkbox" id="showPassword" class="" style="width: 16px; height: 16px; cursor: pointer;">
                            <label for="showPassword">Show Password</label>
                        </div>
                        <a href="../contact.php" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" <?= !empty($success_message) ? 'disabled' : '' ?>>
                        Login
                    </button>
                </form>

                <div class="mt-5 text-center">
                    <p class="text-sm text-white">Don't have an account?
                    <a href="signup.php" class="text-blue-500 hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </section>
        <script src="../script/login.js"></script>
    </body>
</html>