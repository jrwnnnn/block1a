<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../profile.php');
    exit();
}

$email_error = '';
$username_error = '';
$password_error = '';
$success_message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../connect.php';

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $has_error = false;

    if ($password !== $confirm_password) {
        $password_error = "Passwords do not match.";
        $has_error = true;
    }

    $email_check_sql = "SELECT * FROM profiles WHERE email = ?";
    $email_stmt = mysqli_prepare($conn, $email_check_sql);
    mysqli_stmt_bind_param($email_stmt, "s", $email);
    mysqli_stmt_execute($email_stmt);
    $email_result = mysqli_stmt_get_result($email_stmt);


    if (mysqli_num_rows($email_result) > 0) {
        $email_error = "Email already exists.";
        $has_error = true;
    }

  
    // Check if username exists in the database
    $username_check_sql = "SELECT * FROM profiles WHERE username = ?";
    $username_stmt = mysqli_prepare($conn, $username_check_sql);
    mysqli_stmt_bind_param($username_stmt, "s", $username);
    mysqli_stmt_execute($username_stmt);
    $username_result = mysqli_stmt_get_result($username_stmt);


    if (mysqli_num_rows($username_result) > 0) {
        $username_error = "Username already exists.";
        $has_error = true;
    }


    if (!$has_error) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO profiles (email, username, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            $success_message = "Success! Logging you in...";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '../profile.php';
                }, 2000);
            </script>";
        } else {
            $password_error = "Signup failed. Please try again.";
        }
    }
}
?>


<!doctype html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../src/output.css" rel="stylesheet">
    <title>Block1A - Signup</title>
    </head>
    <body>
        <section class="bg-cover bg-center bg-no-repeat flex flex-col items-center justify-center min-h-screen md:px-30 px-5" style="background-image: url('../assets/2login-bg.jpg')">
            <div class="bg-[#1a202a] flex flex-col rounded-md p-8 w-full max-w-md">
                <div class="flex flex-row items-start justify-between pb-7">
                    <p class="text-white text-2xl font-bold">Create an Account</p>
                    <img src="../assets/cs1a.png" alt="logo" class="w-20">
                </div>
                <?php if ($success_message): ?>
        <div class="bg-green-600 text-white p-3 mb-4 rounded-md text-center font-semibold">
            <?= $success_message ?>
        </div>
        <?php endif; ?>
                <form id="loginForm" class="space-y-4" method="POST" action="signup.php">
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <?php if ($email_error): ?>
            <p class="text-red-600 text-sm mt-1 p-2 rounded"><?= $email_error ?></p>
            <?php endif; ?>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-white">Username</label>
                        <input type="username" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <?php if ($username_error): ?>
            <p class="text-red-600 text-sm mt-1 p-2 rounded"><?= $username_error ?></p>
            <?php endif; ?>

                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" id="password" name="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <?php if ($password_error): ?>
            <p class="text-red-600 text-sm mt-1 p-2 rounded"><?= $password_error ?></p>
            <?php endif; ?>
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-white">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border <?= $password_error ? 'border-red-500' : 'border-gray-600' ?> border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <?php if ($password_error): ?>
            <p class="text-red-600 text-sm mt-1 p-2 rounded"><?= $password_error ?></p>
            <?php endif; ?>
                    </div>
                    <div class="flex items-center justify-between">
                        
                        <a href="login.php" class="text-sm text-blue-500 hover:underline">Already have an account?</a>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Signup</button>
                </form>
            </div>
        </section>
    </body>
</html> 