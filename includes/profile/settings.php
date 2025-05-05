<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once __DIR__ . '/../../functions/connect.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    }
    if (empty($_SESSION['last_password_change'])) {
        $_SESSION['last_password_change'] = 'Never';
    }

    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM user_data WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        die("User not found.");
    }
    
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    
    $errors = [];
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = !empty($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : $user['username'];
        $email = !empty($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : $user['email'];
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
    
        if ($username !== $user['username']) {
            $stmt = $conn->prepare("SELECT id FROM user_data WHERE username = ? AND id != ?");
            $stmt->bind_param("si", $username, $userId);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors['username'] = "Username is already taken.";
            }
        }
    
        if ($email !== $user['email']) {
            $stmt = $conn->prepare("SELECT id FROM user_data WHERE email = ? AND id != ?");
            $stmt->bind_param("si", $email, $userId);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors['email'] = "Email is already in use.";
            }
        }
    
        $hashedPassword = null;
        $updatePassword = false;
    
        if (!empty($newPassword)) {
            if (!password_verify($currentPassword, $user['password'])) {
                $errors['password'] = "Current password is incorrect. Try again.";
            } elseif ($newPassword !== $confirmPassword) {
                $errors['password'] = "New password do not match. Try again.";
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updatePassword = true;
            }
        }
    
        if (empty($errors)) {
            if ($updatePassword) {
                $stmt = $conn->prepare("UPDATE user_data SET username = ?, email = ?, password = ? WHERE id = ?");
                $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);
            } else {
                $stmt = $conn->prepare("UPDATE user_data SET username = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssi", $username, $email, $userId);
            }
    
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['success_message'] = "Profile updated successfully!";
                echo "<script>window.location.href = 'profile.php';</script>";
                exit();
            } else {
                $errors[] = "Error updating profile: " . $stmt->error;
            }
        }
    
        if (!empty($errors)) {
            foreach ($errors as $err) {
                echo "<p style='color:red;'>$err</p>";
            }
        }
    }
?>

<div class="space-y-10 md:pr-100">    
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold e">Profile Settings</p>
        <?php if (!empty($_SESSION['success_message'])): ?>
            <div class="p-3 font-semibold text-center text-white bg-green-600 rounded-md">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-2">
            <div>
            <label for="username" class="block mb-1 text-gray-300">Username </label>
                <input type="text" id="username" name="username"
                    class="w-full px-3 py-2 text-white bg-gray-800 border-2 rounded-lg focus:outline-none <?= !empty($errors['username']) ? 'border-red-500' : 'border-gray-600 focus:border-blue-500' ?>"
                    value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>">
                <?php if (!empty($errors['username'])): ?>
                    <p class="mt-1 text-sm text-red-500"><?= htmlspecialchars($errors['username']) ?></p>
                <?php endif; ?>
            </div>
            <div>
            <label for="email" class="block mb-1 text-gray-300">Email </label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 text-white bg-gray-800 border-2 rounded-lg focus:outline-none <?= !empty($errors['email']) ? 'border-red-500' : 'border-gray-600 focus:border-blue-500' ?>"
                    value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
                <?php if (!empty($errors['email'])): ?>
                    <p class="mt-1 text-sm text-red-500"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="px-4 py-2 mt-5 bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Save Changes</button>
        </form>
    </div>
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold">Password </p>
        <p>Please remember your password as there is currently no way to reset it.</p>
        <p class="mb-5 text-sm italic text-gray-300">Last changed: <?= htmlspecialchars($_SESSION['last_password_change'], ENT_QUOTES, 'UTF-8') ?></p>
        <button id="show-form" onclick="togglePasswordForm();" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Change Password</button>
        <form id="change-password-form" action="" method="POST" class="hidden space-y-2">
            <div class="mb-4">
                <label for="current_password" class="block mb-2 text-gray-300">Current Password </label>
                <input type="password" id="current_password" name="current_password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
                <?php if (!empty($errors['password'])): ?>
                    <p class="mt-1 text-sm text-red-500"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-gray-300">New Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 <?= !empty($errors['password']) ? 'border-red-500' : 'border-gray-600' ?> rounded-lg focus:outline-none focus:border-blue-500" required>            
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2 text-gray-300">Confirm New Password </label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 <?= !empty($errors['password']) ? 'border-red-500' : 'border-gray-600' ?> rounded-lg focus:outline-none focus:border-blue-500" required>            
            </div>
            <button type="submit" class="px-4 py-2 mt-5 text-white bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Change Password</button>
        </form>
    </div>
</div>

    <script>
        function togglePasswordForm() {
            const form = document.getElementById('change-password-form');
            const button = document.getElementById('show-form');
            form.classList.remove('hidden');
            button.classList.add('hidden');
        }
    </script>