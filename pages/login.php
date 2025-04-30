<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: ../profile.php');
        exit();
    }
    
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../connect.php';

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
                
                header("Location: ../profile.php");
                exit;
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "User not found. Please try again.";
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
                    <?php if (!empty($error_message)): ?>
                        <div class="bg-red-600 text-white p-3 rounded-md text-center font-semibold">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <label for="login" class="block text-sm font-medium text-white">Username or Email</label>
                        <input type="text" id="login" name="login" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="rememberMe" name="rememberMe" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded">
                            <label for="rememberMe" class="ml-2 block text-sm text-white">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <p class="text-sm text-white">
                        Don't have an account?
                        <a href="signup.php" class="text-blue-500 hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </section>
    </body>
</html>