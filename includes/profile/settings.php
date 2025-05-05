<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    }
    if (empty($_SESSION['last_password_change'])) {
        $_SESSION['last_password_change'] = 'Never';
    }
    
?>

<div class="space-y-10 md:pr-100">    
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold e">Profile Settings</p>
        <!--// TODO : Add ability to update username and email, prevent email and username duplication. Show warnings. -->
        <form action=" method="POST" class="space-y-2">
            <div>
                <label for="username" class="block mb-2 text-gray-300">Username <span class="text-red-500">- Username is taken.</span></label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" value=<?= $_SESSION['username'] ?>>
            </div>
            <div>
                <label for="email" class="block mb-2 text-gray-300">Email <span class="text-red-500">- Email already exists.</span></label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" value=<?= $_SESSION['email'] ?>>
            </div>
            <button type="submit" class="px-4 py-2 mt-5 bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Save Changes</button>
        </form>
    </div>
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold">Password</p>
        <p>Please remember your password as there is currently no way to reset it.</p>
        <p class="mb-5 text-sm italic text-gray-300">Last changed: <?= htmlspecialchars($_SESSION['last_password_change'], ENT_QUOTES, 'UTF-8') ?></p>
        <button id="show-form" onclick="togglePasswordForm();" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Change Password</button>
        <!--// TODO : Add ability to update password, add pasword, strength check, add ability to toggle password visibility, password matching check. Show warnings. -->
        <form id="change-password-form" action="" method="POST" class="hidden space-y-2">
            <div class="mb-4">
                <label for="password_current" class="block mb-2 text-gray-300">Current Password <span class="text-red-500">- Incorrect password..</span></label>
                <input type="password" id="password_current" name="password_current" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-gray-300">New Password <span class="text-red-500">- Passwords do not match.</span></label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2 text-gray-300">Confirm New Password <span class="text-red-500">- Passwords do not match.</span></label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
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